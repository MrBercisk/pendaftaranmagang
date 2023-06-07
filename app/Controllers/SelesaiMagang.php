<?php

namespace App\Controllers;

use App\Models\BidangModel;
use App\Models\KategoriModel;
use App\Models\PendaftaranModel;
use App\Models\LaporanModel;
use App\Models\JadwalModel;
use App\Models\NilaiModel;
use App\Models\UserModel;
use Config\Services;

class SelesaiMagang extends BaseController
{
    protected $M_pendaftaran;
    protected $M_bidang;
    protected $M_kategori;
    protected $M_laporan;
    protected $M_jadwal;
    protected $M_nilai;
    protected $M_user;
    protected $request;
    protected $nama_peserta;
    protected $form_validation;
    protected $session;
    protected $db;

    public function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
        $this->request = Services::request();
        $this->M_bidang = new BidangModel($this->request);
        $this->M_kategori = new KategoriModel($this->request);
        $this->M_pendaftaran = new PendaftaranModel($this->request);
        $this->M_laporan = new LaporanModel($this->request);
        $this->M_jadwal = new JadwalModel($this->request);
        $this->M_nilai = new NilaiModel($this->request);
        $this->M_user = new UserModel($this->request);
        $this->form_validation =  \Config\Services::validation();
        $this->session = \Config\Services::session();
        $this->db = \Config\Database::connect();

        // Set nama_peserta dari data pendaftaran
        $user_id = $this->session->get('id');
        $builder = $this->db->table('tbl_pendaftaran');
        $builder->select('tbl_pendaftaran.nama_peserta, tbl_pendaftaran.foto, tbl_pendaftaran.judul, tbl_user.nama, tbl_jadwal.tanggal_mulai, tbl_jadwal.tanggal_selesai');
        $builder->join('tbl_user', 'tbl_user.id = tbl_pendaftaran.user_id');
        $builder->join('tbl_jadwal', 'tbl_jadwal.pendaftaran_id = tbl_pendaftaran.id', 'left');
        $builder->where('tbl_pendaftaran.user_id', $user_id);
        $query = $builder->get();
        $data['pendaftaran'] = $query->getRow();
    }


    // Halaman Data Laporan
    public function index()
    {
        $data['title']  = "SI AMANG | Dokumen Akhir";
        $data['page']   = "selesai";

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
        $builder->select('tbl_pendaftaran.nama_peserta, tbl_pendaftaran.foto, tbl_pendaftaran.judul, tbl_user.nama, tbl_jadwal.tanggal_mulai, tbl_jadwal.tanggal_selesai');
        $builder->join('tbl_user', 'tbl_user.id = tbl_pendaftaran.user_id');
        $builder->join('tbl_jadwal', 'tbl_jadwal.pendaftaran_id = tbl_pendaftaran.id', 'left');
        $builder->where('tbl_pendaftaran.user_id', $user_id);
        $query = $builder->get();
        $data['pendaftaran'] = $query->getRow();
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
        // pengambilan data dari tbl_pendaftaran & tbl_user
        $data['nama_peserta'] = $data['pendaftaran']->nama_peserta;
        $data['foto'] = $data['pendaftaran']->foto;
        $data['judul']   = "Silahkan Download File Selesai Magang Anda Jika Sudah Selesai Melakukan Magang";
        $data['tanggal_mulai'] = $data['pendaftaran']->tanggal_mulai;
        $data['tanggal_selesai'] = $data['pendaftaran']->tanggal_selesai;
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
        if ($tanggal_sekarang < $data['tanggal_selesai'] || $data['keterangan_laporan'] != 'Anda Sudah Upload Laporan') {
            $pesan = "Anda Sudah upload laporan, Silahkan akses halaman saat anda telah selesai magang";
            $this->session->setFlashdata('pesan_error', $pesan);
            return redirect()->back();
        }
        if ($tanggal_sekarang > $data['tanggal_selesai'] && $data['keterangan_laporan'] == 'Anda Sudah Upload Laporan') {
            $pesan = "Terima kasih anda telah menyelesaikan magang anda, Silahkan download file-file yang sudah tersedia";
            $this->session->setFlashdata('pesan_sukses', $pesan);
        } else {
            $pesan = "Maaf, Halaman Tidak bisa diakses karena anda belum mengisi laporan magang melebihi tanggal selesai magang jadi sistem menganggap bahwa anda tidak menyelesaikan magang anda";
            $this->session->setFlashdata('pesan_error', $pesan);
            return redirect()->back();
        }

        // Ambil data pendaftaran yang terbaru dan belum diterima
        $data['tbl_pendaftaran'] = $this->M_pendaftaran->where('status_verifikasi', 'Belum Verifikasi')
            ->orderBy('created_at', 'DESC')
            ->findAll();
        $data['jumlah_pendaftaran'] = count($data['tbl_pendaftaran']);
        $data['events'] = $this->M_jadwal->getEvents();
        // Cek bukti Pendaftaran berdasarkan user_id
        $user_id = $this->session->get('id');
        $form_nilai = $this->M_pendaftaran->where('user_id', $user_id)->first();
        // Ambil data nilai dari M_nilai
        $nilai = $this->M_nilai->where('pendaftaran_id', $form_nilai['id'])->first();
        $jadwal = $this->M_jadwal->where('pendaftaran_id', $form_nilai['id'])->first();

        $data['nilai'] = $nilai;
        $data['jadwal'] = $jadwal;

        // Cek apakah nilai sudah dinilai
        $keterangan_nilai = '';
        if (!empty($nilai)) {
            $keterangan_nilai = 'Form Sudah Dinilai';
        } else {
            $keterangan_nilai = 'Form Belum Dinilai';
        }

        $data['keterangan_nilai'] = $keterangan_nilai;

        return view('v_laporan/selesai', $data);
    }

    public function form_nilai()
    {
        // Cek bukti Pendaftaran berdasarkan user_id
        $user_id = $this->session->get('id');
        $form_nilai = $this->M_pendaftaran->where('user_id', $user_id)->first();
        $bidang_id = $form_nilai['bidang_id'];

        // Menampilkan pilihan mentor berdasarkan kategori_id
        $kategori_id = $form_nilai['kategori_id'];
        $tanggal_sekarang = date('Y-m-d');
        $data['mentor'] = $this->M_user->where('role_id', 2)->where('kategori_id', $kategori_id)->findAll();
        $data['form_nilai'] = $form_nilai;
        $data['tanggal_sekarang'] = $tanggal_sekarang;

        // Ambil data nilai dari M_nilai
        $nilai = $this->M_nilai->where('pendaftaran_id', $form_nilai['id'])->first();
        $jadwal = $this->M_jadwal->where('pendaftaran_id', $form_nilai['id'])->first();
        $data['nilai'] = $nilai;
        $data['jadwal'] = $jadwal;

        // Bidang
        $cekBidang = $this->M_bidang->where('id', $bidang_id)->first();
        $data['nama_bidang'] = $cekBidang['nama_bidang'];

        // Kategori
        $cekKategori = $this->M_kategori->where('id', $kategori_id)->first();
        $data['nama_kategori'] = $cekKategori['nama_kategori'];


        // Cetak dengan dompdf
        $dompdf = new \Dompdf\Dompdf();
        $options = new \Dompdf\Options();
        $options->setIsRemoteEnabled(true);

        $dompdf->setOptions($options);
        $dompdf->loadHtml(view('v_laporan/form_nilai', $data));
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream('form_nilai.pdf', array("Attachment" => false));
    }



    public function surat_selesai()
    {
        //Cek bukti Pendaftaran berdasarkan user_id
        $user_id = $this->session->get('id');
        $surat_selesai = $this->M_pendaftaran->where('user_id', $user_id)->first();
        $bidang_id     = $surat_selesai['bidang_id'];
        $kategori_id         = $surat_selesai['kategori_id'];
        $tanggal_sekarang = date('Y-m-d');
        $ubah_tanggal = tgl_indonesia($tanggal_sekarang);
        /* $mentor_id 		= $buktiPendaftaran['mentor_id']; */
        // Ambil data nilai dari M_nilai
        $jadwal = $this->M_jadwal->where('pendaftaran_id', $surat_selesai['id'])->first();

        $data['jadwal']   = $jadwal;

        $data['ubah_tanggal'] = $ubah_tanggal;

        $data['surat_selesai']   = $surat_selesai;

        //bidang
        $cekBidang = $this->M_bidang->where('id', $bidang_id)->first();
        $data['nama_bidang']   = $cekBidang['nama_bidang'];

        //kategori
        $cekKategori = $this->M_kategori->where('id', $kategori_id)->first();
        $data['nama_kategori']   = $cekKategori['nama_kategori'];

        //mentor
        /* $cekMentor = $this->M_mentor->where('id', $mentor_id)->first();
		$data['nama_mentor']   = $cekMentor['nama_mentor']; */

        //Cetak dengan dompdf
        $dompdf = new \Dompdf\Dompdf();
        $options = new \Dompdf\Options();
        $options->setIsRemoteEnabled(true);

        $dompdf->setOptions($options);
        $dompdf->output();
        $dompdf->loadHtml(view('v_laporan/surat_selesai', $data));
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream('surat_selesai.pdf', array("Attachment" => false));
    }
}
