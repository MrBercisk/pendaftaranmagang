<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\PendaftaranModel;
use App\Models\LaporanModel;
use App\Models\JadwalModel;
use App\Models\ChatModel;
use Config\Services;
use CodeIgniter\API\ResponseTrait;

class DiskusiForum extends BaseController
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
    protected $ChatModel;

    public function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
        $this->request = Services::request();
        $this->encrypter = \Config\Services::encrypter();
        $this->form_validation =  \Config\Services::validation();
        $this->M_user = new UserModel();
        $this->M_pendaftaran = new PendaftaranModel($this->request);
        $this->M_jadwal = new JadwalModel($this->request);
        $this->ChatModel = new ChatModel();
        $this->session = \Config\Services::session();
        $this->db = \Config\Database::connect();
        $this->session->start();
    }


    public function index()
    {
        // periksa apakah session masih ada atau tidak
        if (!$this->session->has('nama') || !$this->session->has('email')) {
            return redirect()->to('/login');
        }
        $data['nama'] = $this->session->get('nama');
        $data['email'] = $this->session->get('email');

        // Cek pendaftaran berdasarkan user_id
        $user_id = $this->session->get('id');
        $pendaftaran = $this->M_pendaftaran->where('user_id', $user_id)->first();
        $user = $this->M_user->where('id', $user_id)->first();

        // join table pendaftaran berdasarkan user_id
        $builder = $this->db->table('tbl_user');
        $builder->select('tbl_pendaftaran.nama_peserta, tbl_pendaftaran.foto, tbl_pendaftaran.bidang_id, tbl_pendaftaran.kategori_id, tbl_user.nama, tbl_jadwal.tanggal_mulai, tbl_jadwal.tanggal_selesai');
        $builder->join('tbl_pendaftaran', 'tbl_user.id = tbl_pendaftaran.user_id', 'left');
        $builder->join('tbl_jadwal', 'tbl_jadwal.pendaftaran_id = tbl_pendaftaran.id', 'left');
        $builder->where('tbl_user.id', $user_id);
        $query = $builder->get();
        $data['pendaftaran'] = $query->getRow();

        // mengambil data id pada tbl_user
        $builder = $this->db->table('tbl_user');
        $builder->where('tbl_user.id', $user_id);
        $query = $builder->get();
        $data['user'] = $query->getRow();

        // ambil data chat yang terkait dengan user yang sedang login
        $builder = $this->db->table('chat');
        $builder->select('chat.*, tbl_user.role_id, IF(tbl_user.role_id = 3, tbl_pendaftaran.nama_peserta, tbl_user.nama) as pengirim_nama');
        $builder->join('tbl_user', 'tbl_user.id = chat.pengirim');
        $builder->join('tbl_pendaftaran', 'tbl_user.id = tbl_pendaftaran.user_id', 'left');
        $builder->orderBy('waktu_kirim', 'DESC'); // Mengubah pengurutan menjadi DESC
        $builder->where('chat.kategori_id', $data['user']->kategori_id);
        $query = $builder->get();
        $data['chat'] = $query->getResult();

        // pengambilan data dari tbl_pendaftaran & tbl_user
        $data['nama_peserta'] = $data['pendaftaran']->nama_peserta;
        $data['nama'] = ($user['role_id'] == 3) ? $data['nama_peserta'] : $data['pendaftaran']->nama;
        $data['foto'] = $data['pendaftaran']->foto ?? '';
        $data['kategori_id'] = $data['pendaftaran']->kategori_id ?? '';
        $data['tanggal_mulai'] = $data['pendaftaran']->tanggal_mulai ?? '';
        $data['tanggal_selesai'] = $data['pendaftaran']->tanggal_selesai ?? '';

        $data['title'] = "SI AMANG | Diskusi";
        $data['page'] = "Diskusi";
        $data['judul'] = "Forum Diskusi";
        $data['events'] = $this->M_jadwal->getEvents();
        $laporan = new LaporanModel();
        $where = ['user_id' => $user_id];
        $data['laporan'] = $laporan->where($where)->first();
        $data['keterangan_laporan'] = $data['laporan'] ? "Anda Sudah Upload Laporan" : "Anda Belum Upload Laporan";

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
                ->where('pengirim', $chat->pengirim) // Hanya untuk pesan yang dikirim oleh pengirim
                ->update(['dibaca' => true]);
        }

        // Filter chat yang belum dibaca oleh pengirim
        $filteredChat = array_filter($data['chat'], function ($chat) use ($currentUser) {
            // Memeriksa apakah chat belum dibaca dan bukan dikirim oleh pengirim
            return !$chat->dibaca && $chat->pengirim !== $currentUser;
        });
        $data['chat_baru'] = count($filteredChat);
        // Periksa apakah tanggal saat ini sudah melewati tanggal_mulai atau belum
        $tanggal_sekarang = date('Y-m-d');
        if ($tanggal_sekarang < $data['tanggal_mulai']) {
            $pesan = "Maaf, Halaman ini hanya dapat diakses setelah waktu magang dimulai. Silahkan cek jadwal magang untuk mengetahui waktu mulai magang Anda.";
            $this->session->setFlashdata('pesan_error', $pesan);
            return redirect()->back();
        }
        
        // logika untuk menampilkan view chat untuk halaman mahasiswa dan mentor dengan logika role_id
        if ($user['role_id'] == "3") {
            return view('v_diskusi/index', $data);
        } else {
            // Ambil data pendaftaran yang terbaru dan belum diterima
            $data['tbl_pendaftaran'] = $this->M_pendaftaran->where('status_verifikasi', 'Belum Verifikasi')
                ->orderBy('created_at', 'DESC')
                ->findAll();
            $data['jumlah_pendaftaran'] = count($data['tbl_pendaftaran']);

            return view('v_diskusi/diskusimentor', $data);
        }
    }


    public function sendChat()
    {
        // ambil data pesan yang dikirim melalui form
        $pesan = $this->request->getPost('pesan');
        $pengirim = $this->session->get('id');

        // cek apakah pesan tidak kosong
        if (!empty($pesan)) {

            $builder = $this->db->table('tbl_user');
            $builder->where('tbl_user.id', $pengirim);
            $query = $builder->get();
            $data['pendaftaran'] = $query->getRow();

            // simpan data pesan ke database
            $data = [
                'kategori_id' => $data['pendaftaran']->kategori_id,
                'pesan' => $pesan,
                'pengirim' => $pengirim,
                'waktu_kirim' => date('Y-m-d H:i:s'),
            ];
            $this->ChatModel->insert($data);

            return redirect()->to('index');
        }
    }
}
