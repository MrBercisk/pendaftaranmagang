<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\PendaftaranModel;
use App\Models\LaporanModel;
use App\Models\JadwalModel;
use Config\Services;
use CodeIgniter\API\ResponseTrait;

class LaporanMagang extends BaseController
{
    use ResponseTrait;
    protected $encrypter;
    protected $form_validation;
    protected $M_user;
    protected $M_pendaftaran;
    protected $M_jadwal;
    protected $LaporanModel;
    protected $session;
    protected $request;
    protected $model;
    protected $nama_peserta;
    protected $db;


    public function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
        $this->request = Services::request();
        $this->encrypter = \Config\Services::encrypter();
        $this->form_validation =  \Config\Services::validation();
        $this->M_user = new UserModel();
        $this->M_pendaftaran = new PendaftaranModel($this->request);
        $this->M_jadwal = new JadwalModel($this->request);
        $this->session = \Config\Services::session();
        $this->db = \Config\Database::connect();
        $this->session->start();

        // Set nama_peserta dari data pendaftaran
        $user_id = $this->session->get('id');
        $builder = $this->db->table('tbl_pendaftaran');
        $builder->select('tbl_pendaftaran.nama_peserta, tbl_pendaftaran.foto, tbl_user.nama');
        $builder->join('tbl_user', 'tbl_user.id = tbl_pendaftaran.user_id');
        $builder->where('tbl_pendaftaran.user_id', $user_id);
        $query = $builder->get();
        $data['pendaftaran'] = $query->getRow();
    }

    public function index()
    {
        // periksa apakah session masih ada atau tidak
        if (!$this->session->has('nama') || !$this->session->has('email')) {
            return redirect()->to('/login');
        }
        $data['nama']   = $this->session->get('nama');
        $data['email']   = $this->session->get('email');

        //Cek pendaftaran berdasarkan user_id
        $user_id = $this->session->get('id');
        $pendaftaran = $this->M_pendaftaran->where('user_id', $user_id)->first();

        // megambil data dari tbl_pendaftaran dan tbl_user
        $builder = $this->db->table('tbl_pendaftaran');
        $builder->select('tbl_pendaftaran.nama_peserta, tbl_pendaftaran.foto, tbl_user.nama, tbl_jadwal.tanggal_mulai, tbl_jadwal.tanggal_selesai');
        $builder->join('tbl_user', 'tbl_user.id = tbl_pendaftaran.user_id');
        $builder->join('tbl_jadwal', 'tbl_jadwal.pendaftaran_id = tbl_pendaftaran.id', 'left');
        $builder->where('tbl_pendaftaran.user_id', $user_id);
        $query = $builder->get();
        $data['pendaftaran'] = $query->getRow();

        // pengambilan data dari tbl_pendaftaran & tbl_user
        $data['nama_peserta'] = $data['pendaftaran']->nama_peserta;
        $data['foto'] = $data['pendaftaran']->foto;
        $data['email']   = $this->session->get('email');
        $data['tanggal_mulai'] = $data['pendaftaran']->tanggal_mulai;
        $data['tanggal_selesai'] = $data['pendaftaran']->tanggal_selesai;
        // mengambil data id pada tbl_user
        $builder = $this->db->table('tbl_user');
        $builder->where('tbl_user.id', $user_id);
        $query = $builder->get();
        $data['user'] = $query->getRow();

        // ambil data chat yang terkait dengan user yang sedang login
        $builder = $this->db->table('chat');
        $builder->select('chat.*, tbl_user.role_id, tbl_user.nama as pengirim_nama');
        $builder->join('tbl_user', 'tbl_user.id = chat.pengirim');
        $builder->orderBy('waktu_kirim', 'DESC'); // Mengubah pengurutan menjadi DESC
        $builder->where('chat.kategori_id', $data['user']->kategori_id);
        $query = $builder->get();
        $data['chat'] = $query->getResult();


        $currentUser = $this->session->get('id');
        // Periksa apakah ada pesan baru yang belum dibaca
        $chatBaru = false;
        foreach ($data['chat'] as $chat) {
            if (!$chat->dibaca && $chat->pengirim !== $currentUser) {
                $chatBaru = true;
                break;
            }
        }

        // Jika chat dibuka atau halaman diskusiforum diakses oleh penerima pesan,
        // set nilai 'dibaca' menjadi true untuk pesan yang dikirim oleh pengirim.
        if ($chatBaru) {
            $this->db->table('chat')
                ->where('kategori_id', $data['user']->kategori_id)
                ->where('pengirim', $chat->pengirim); // Hanya untuk pesan yang dikirim oleh pengirim
        }

        // Filter chat yang belum dibaca oleh pengirim
        $filteredChat = array_filter($data['chat'], function ($chat) use ($currentUser) {
            // Memeriksa apakah chat belum dibaca dan bukan dikirim oleh pengirim
            return !$chat->dibaca && $chat->pengirim !== $currentUser;
        });
        $data['chat_baru'] = count($filteredChat);
        // Menampilkan data
        $data['title']   = "SI AMANG | Laporan";
        $data['judul']   = "Untuk memantau kegiatan peserta magang, Silahkan upload laporan harian anda dalam format PDF";
        $data['page']   = "laporan";
        $data['events'] = $this->M_jadwal->getEvents();
        $laporan = new LaporanModel();
        $where = ['user_id' => $user_id];
        $data['laporan'] = $laporan->where($where)->first();
        if ($data['laporan']) {
            $data['keterangan_laporan'] = "Anda Sudah Upload Laporan";
        } else {
            $data['keterangan_laporan'] = "Anda Belum Upload Laporan";
        }

        // Periksa apakah tanggal saat ini sudah melewati tanggal_mulai atau belum
        $tanggal_sekarang = date('Y-m-d');
        if ($tanggal_sekarang < $data['tanggal_mulai']) {
            $pesan = "Maaf, Halaman ini hanya dapat diakses setelah waktu magang dimulai. Silahkan cek jadwal magang untuk mengetahui waktu mulai magang Anda.";
            $this->session->setFlashdata('pesan_error', $pesan);
            return redirect()->back();
        }

        // Periksa apakah tanggal saat ini sudah melewati tanggal_selesai atau belum
        if ($tanggal_sekarang > $data['tanggal_selesai']) {
            // Beri kesempatan waktu lebih dari 3 hari dari tanggal_selesai untuk upload laporan
            $batas_waktu_upload = date('Y-m-d', strtotime('+3 days', strtotime($data['tanggal_selesai'])));
            if ($tanggal_sekarang > $batas_waktu_upload) {
                if ($data['keterangan_laporan'] == 'Anda Belum Upload Laporan') {
                    $pesan = "Maaf, Batas waktu untuk mengunggah laporan telah lewat. Kami memberikan waktu tambahan selama 3 hari setelah tanggal selesai untuk mengunggah laporan. Silahkan hubungi mentor anda untuk informasi lebih lanjut.";
                    $this->session->setFlashdata('pesan_error', $pesan);
                    return redirect()->back();
                } else {
                    $pesan = "Anda sudah upload laporan silahkan cek halaman file selesai magang.";
                    $this->session->setFlashdata('pesan_error', $pesan);
                    return redirect()->back();
                }
            } else {
                $pesan = "Silahkan upload laporan anda (Kesempatan upload laporan magang dan upload revisi H+3 tanggal selesai)";
                $this->session->setFlashdata('pesan_notif', $pesan);
                return view('v_laporan/index', $data);
            }
        }
        return view('v_laporan/index', $data);
    }

    // upload data
    public function create()
    {
        $model = new LaporanModel();
        $form_nilai = $this->request->getFile('form_nilai');

        // Menentukan maksimum ukuran file yang diperbolehkan (2 MB)
        $max_size = 2 * 1024 * 1024;

        // Validasi file nilai
        if (!$form_nilai->isValid() || $form_nilai->getSize() > $max_size || $form_nilai->getClientMimeType() != 'application/pdf') {
            return redirect()->back()->with('error', 'Form nilai harus berukuran kurang dari 2 MB dan berformat PDF');
        }
        $user_id = session()->get('id'); // mengambil user_id dari session
        $nama_peserta = session()->get('nama'); // mengambil user_id dari session

        // Memindahkan file form nilai ke folder uploads/form-nilai
        $nama_form_nilai = $user_id . '_' . $nama_peserta . '_' . 'Laporan_Magang.' . pathinfo($form_nilai->getName(), PATHINFO_EXTENSION);

        $form_nilai->move('file_peserta/laporan', $nama_form_nilai);

        $data = [
            'user_id' => $user_id,
            'judul_laporan' => $this->request->getPost('judul_laporan'),
            'link_drive' => $this->request->getPost('link_drive'),
            'form_nilai' => $nama_form_nilai,
        ];

        if (!$model->insertLaporan($data)) {
            return redirect()->back()->with('error', 'Gagal menyimpan laporan');
        }

        return redirect()->to('/LaporanMagang')->with('success', 'Laporan berhasil disimpan');
    }
}
