<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\PendaftaranModel;
use App\Models\JadwalModel;
use App\Models\BidangModel;
use App\Models\KategoriModel;
use App\Models\InformasiModel;
use App\Models\LaporanModel;
use Config\Services;
use App\Models\ProfileModel;


class UpdateProfile extends BaseController
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
        // menampilkan data title, link, dan view
        $data['title']   = "SI AMANG | Dashboard";
        $data['judul']   = "Silahkan Perbarui Foto Profile Anda Kemudian, Demi kemanan dimohon untuk selalu ganti password secara berkala";
        $data['page']   = "magang";
        $data['events'] = $this->M_jadwal->getEvents();
        $data['nama']   = $this->session->get('nama');
        $data['email']   = $this->session->get('email');
    
        //Cek pendaftaran berdasarkan user_id
        $user_id = $this->session->get('id');
        $pendaftaran = $this->M_pendaftaran->where('user_id', $user_id)->first();
    
        // megambil data dari tbl_pendaftaran, tbl_jadwal, dan tbl_user
        $builder = $this->db->table('tbl_pendaftaran');
        $builder->select('tbl_pendaftaran.nama_peserta, tbl_pendaftaran.nim, tbl_pendaftaran.keahlian, tbl_pendaftaran.foto, tbl_user.nama, tbl_jadwal.tanggal_mulai, tbl_jadwal.tanggal_selesai');
        $builder->join('tbl_user', 'tbl_user.id = tbl_pendaftaran.user_id');
        $builder->join('tbl_jadwal', 'tbl_jadwal.pendaftaran_id = tbl_pendaftaran.id', 'left');
        $builder->where('tbl_pendaftaran.user_id', $user_id);
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
        $data['keahlian'] = $data['pendaftaran']->keahlian;
        $data['nim'] = $data['pendaftaran']->nim;
        $data['foto'] = $data['pendaftaran']->foto;
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
        
        return view('v_magang/index', $data);
    }
    


    // update foto
    public function update()
    {
        $userId = session()->get('id');

        // validasi form upload foto
        $rules = [
            'foto' => [
                'uploaded[foto]',
                'mime_in[foto,image/jpg,image/jpeg,image/gif,image/png]',
                'max_size[foto,4096]',
            ]
        ];

        $errors = [
            'foto' => [
                'uploaded' => 'Silahkan pilih file foto terlebih dahulu',
                'mime_in' => 'Format file tidak sesuai. Format yang diperbolehkan adalah jpg, jpeg, gif, atau png',
                'max_size' => 'Ukuran file terlalu besar. Maksimal ukuran file adalah 4 MB',
            ]
        ];

        if (!$this->validate($rules, $errors)) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back();
        }

        $file = $this->request->getFile('foto');

        if ($file->isValid() && !$file->hasMoved()) {
            $fileName = $file->getRandomName();
            $file->move('file_peserta', $fileName);

            $model = new ProfileModel();
            $model->updateProfile($userId, $fileName);

            return redirect()->back()->with('success', 'Foto berhasil diupdate');
        } else {
            session()->setFlashdata('error', $file->getErrorString());
            return redirect()->back();
        }
    }


    // update password
    // method untuk menampilkan form update password
    public function updatePasswordForm()
    {
        // cek apakah user telah login atau belum
        if (!$this->session->has('id')) {
            return redirect()->to(base_url('login'));
        }
        $data['title'] = 'SI AMANG | Update Profile';
        return view('v_magang/index', $data);
    }

    // method untuk mengupdate password
    public function updatePassword()
    {
        // cek apakah user telah login atau belum
        if (!$this->session->has('id')) {
            return redirect()->to(base_url('login'));
        }

        // ambil data dari form input
        $old_password = $this->request->getPost('old_password');
        $new_password = $this->request->getPost('new_password');
        $confirm_password = $this->request->getPost('confirm_password');
        $user_id = $this->session->get('id');

        // validasi form input
        $rules = [
            'old_password' => 'required',
            'new_password' => 'required|min_length[6]',
            'confirm_password' => 'matches[new_password]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        // cek password lama yang dimasukkan
        $user = $this->M_user->find($user_id);
        $ciphertext = $user['password'];
        $password = $this->encrypter->decrypt(base64_decode($ciphertext));

        if ($old_password != $password) {
            return redirect()->back()->withInput()->with('error', 'Password lama salah!');
        }

        // update password baru
        $new_ciphertext = base64_encode($this->encrypter->encrypt($new_password));
        $data = [
            'password' => $new_ciphertext
        ];
        $this->M_user->update($user_id, $data);

        return redirect()->to(base_url('updateprofile'))->with('success', 'Password berhasil diupdate!');
    }

    // Cetak bukti pendaftaran
    public function buktiPendaftaran()
    {
        //Cek bukti Pendaftaran berdasarkan user_id
        $user_id = $this->session->get('id');
        $buktiPendaftaran = $this->M_pendaftaran->where('user_id', $user_id)->first();
        $bidang_id     = $buktiPendaftaran['bidang_id'];
        $kategori_id         = $buktiPendaftaran['kategori_id'];
        $data['mentor'] = $this->M_user->where('role_id', 2)->where('kategori_id', $kategori_id)->findAll();
        $tanggal_sekarang = date('Y-m-d');
        $data['buktiPendaftaran']   = $buktiPendaftaran;
        $data['tanggal_sekarang'] = $tanggal_sekarang;

        $jadwal = $this->M_jadwal->where('pendaftaran_id', $buktiPendaftaran['id'])->first();
        $data['jadwal']   = $jadwal;
        //bidang
        $cekBidang = $this->M_bidang->where('id', $bidang_id)->first();
        $data['nama_bidang']   = $cekBidang['nama_bidang'];

        //kategori
        $cekKategori = $this->M_kategori->where('id', $kategori_id)->first();
        $data['nama_kategori']   = $cekKategori['nama_kategori'];

        //Cek tanggal informasi pendaftaran
        $cekInfo = $this->M_informasi->first();
        $data['tgl_pengumuman'] = $cekInfo['tgl_pengumuman'];

        $data['tgl_sekarang'] = date('Y-m-d');

        //Cetak dengan dompdf
        $dompdf = new \Dompdf\Dompdf();
        $options = new \Dompdf\Options();
        $options->setIsRemoteEnabled(true);

        $dompdf->setOptions($options);
        $dompdf->output();
        $dompdf->loadHtml(view('v_pendaftaran/bukti_pendaftaran', $data));
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream('surat_diterima_magang.pdf', array("Attachment" => false));
    }
}
