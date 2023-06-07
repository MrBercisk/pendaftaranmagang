<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\PendaftaranModel;
use App\Models\JadwalModel;
use App\Models\LaporanModel;
use Config\Services;
use App\Models\ProgresMagangModel;

class Kalender extends BaseController
{
    protected $encrypter;
    protected $form_validation;
    protected $M_user;
    protected $M_pendaftaran;
    protected $M_jadwal;
    protected $M_laporan;
    protected $session;
    protected $request;
    protected $db;
    protected $model;
    protected $nama_peserta;
    protected $M_progres;

    public function __construct()
    {

        $this->request = Services::request();
        $this->encrypter = \Config\Services::encrypter();
        $this->form_validation =  \Config\Services::validation();
        $this->M_user = new UserModel($this->request);
        $this->M_pendaftaran = new PendaftaranModel($this->request);
        $this->M_progres = new ProgresMagangModel($this->request);
        $this->M_jadwal = new JadwalModel($this->request);
        $this->M_laporan = new LaporanModel($this->request);
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
        $data['email']   = $this->session->get('email');
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
        // menampilkan data title
        $data['title']   = "SI AMANG | Jadwal Magang";
        $data['judul']   = "Mahasiswa Dapat Melihat Jadwal Bimbingan Magang Pada Kalender Yang Tersedia";
        $data['page']   = "jadwalbimbingan";
        $data['events'] = $this->M_jadwal->getEvents();
        $laporan = new LaporanModel();
        $where = ['user_id' => $user_id];
        $data['laporan'] = $laporan->where($where)->first();
        if ($data['laporan']) {
            $data['keterangan_laporan'] = "Anda Sudah Upload Laporan";
        } else {
            $data['keterangan_laporan'] = "Anda Belum Upload Laporan";
        }

        return view('v_magang/kalender', $data);
    }
}
