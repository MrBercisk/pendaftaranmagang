<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\PendaftaranModel;
use App\Models\JadwalModel;
use App\Models\BidangModel;
use App\Models\KategoriModel;
use App\Models\InformasiModel;
use App\Models\LaporanModel;
use App\Models\ProgresMagangModel;
use App\Models\SosialMediaModel;
use Config\Services;
use App\Models\ProfileModel;


class Profile extends BaseController
{

    protected $encrypter;
    protected $form_validation;
    protected $M_user;
    protected $M_jadwal;
    protected $M_pendaftaran;
    protected $M_bidang;
    protected $M_kategori;
    protected $M_informasi;
    protected $M_laporan;
    protected $M_progres;
    protected $M_profile;
    protected $M_sosmed;
    protected $session;
    protected $request;
    protected $ProfileModel;
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
        $this->M_bidang = new BidangModel($this->request);
        $this->M_kategori = new KategoriModel($this->request);
        $this->M_informasi = new InformasiModel($this->request);
        $this->M_laporan = new LaporanModel($this->request);
        $this->M_sosmed = new SosialMediaModel();
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

        // menampilkan data title, link dan view
        $data['title'] = "SI AMANG | Profile";
        $data['judul'] = "Silahkan Perbarui Foto Profile Anda Kemudian, Demi kemanan dimohon untuk selalu ganti password secara berkala";
        $data['page'] = "Profil";
        $data['events'] = $this->M_jadwal->getEvents();
        $data['nama'] = $this->session->get('nama');
        $data['email'] = $this->session->get('email');

        // Cek pendaftaran berdasarkan user_id
        $user_id = $this->session->get('id');
        $pendaftaran = $this->M_pendaftaran->where('user_id', $user_id)->first();

        // megambil data dari tbl_pendaftaran, tbl_jadwal dan tbl_user
        $builder = $this->db->table('tbl_pendaftaran');
        $builder->select('tbl_pendaftaran.nama_peserta, tbl_pendaftaran.nim, tbl_pendaftaran.alamat_peserta, tbl_pendaftaran.judul, tbl_pendaftaran.keahlian, tbl_pendaftaran.nomor_pendaftaran, tbl_pendaftaran.nama_kampus, tbl_pendaftaran.no_hp, tbl_pendaftaran.foto, tbl_pendaftaran.status_permohonan, tbl_pendaftaran.nama_anggota_1, tbl_pendaftaran.nama_anggota_2, tbl_user.nama, tbl_jadwal.tanggal_mulai, tbl_jadwal.tanggal_selesai');
        $builder->join('tbl_user', 'tbl_user.id = tbl_pendaftaran.user_id');
        $builder->join('tbl_jadwal', 'tbl_jadwal.pendaftaran_id = tbl_pendaftaran.id', 'left');
        $builder->where('tbl_pendaftaran.user_id', $user_id);
        $query = $builder->get();
        $data['pendaftaran'] = $query->getRow();

        // pengambilan data dari tbl_pendaftaran & tbl_user
        $data['nama_peserta'] = $data['pendaftaran']->nama_peserta;
        $data['nim'] = $data['pendaftaran']->nim;
        $data['keahlian'] = $data['pendaftaran']->keahlian;
        $data['foto'] = $data['pendaftaran']->foto;
        $data['no_hp'] = $data['pendaftaran']->no_hp;
        $data['judul'] = $data['pendaftaran']->judul;
        $data['alamat_peserta'] = $data['pendaftaran']->alamat_peserta;
        $data['nama_kampus'] = $data['pendaftaran']->nama_kampus;
        $data['tanggal_mulai'] = $data['pendaftaran']->tanggal_mulai;
        $data['tanggal_selesai'] = $data['pendaftaran']->tanggal_selesai;
        $data['status_permohonan'] = $data['pendaftaran']->status_permohonan;
        $data['nama_anggota_1'] = $data['pendaftaran']->nama_anggota_1;
        $data['nama_anggota_2'] = $data['pendaftaran']->nama_anggota_2;

        $laporan = new LaporanModel();
        $where = ['user_id' => $user_id];
        $data['laporan'] = $laporan->where($where)->first();

        // Mengambil data progres magang dari tabel tbl_progresmagang
        $progresMagangModel = new ProgresMagangModel();
        $progresMagang = $progresMagangModel->where('user_id', $user_id)->countAllResults();
        $progressMagang = $progresMagang * 20;
        $progressMagang = min($progressMagang, 80); // Maksimal 80%

        $data['progressMagang'] = $progressMagang;

        // Periksa apakah laporan sudah diupload atau belum
        if ($data['laporan']) {
            $data['keterangan_laporan'] = "Anda Sudah Upload Laporan";
            $data['status_magang'] = "Selesai";
            $data['progressLaporan'] = 100; // Set progress laporan ke 100 jika laporan sudah diupload
            $data['progressMagang'] = 100; // Set progress magang ke 100 jika laporan sudah diupload
        } else {
            $data['keterangan_laporan'] = "Anda Belum Upload Laporan";
            // Periksa apakah tanggal saat ini sudah melewati batas_waktu_upload
            $tanggal_sekarang = date('Y-m-d');
            $batas_waktu_upload = date('Y-m-d', strtotime('+3 days', strtotime($data['tanggal_selesai'])));
            if ($tanggal_sekarang > $batas_waktu_upload) {
                $data['status_magang'] = "Tidak Selesai (Tidak Upload Laporan Melebihi Batas Waktu Upload Laporan)"; // Ubah status_magang menjadi "Tidak Selesai" jika melebihi batas_waktu_upload
            } else {
                $data['status_magang'] = "Belum Selesai";
                $data['progressLaporan'] = ($progressMagang >= 100) ? 100 : 0; // Set progress laporan ke 80% jika laporan belum diupload, kecuali jika progress magang sudah mencapai 100%
            }
        }

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

        return view('v_magang/profile', $data);
    }
   
}
