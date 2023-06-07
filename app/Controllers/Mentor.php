<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\PendaftaranModel;
use App\Models\KategoriModel;
use App\Models\JadwalModel;
use App\Models\ProfileModel;

class Mentor extends BaseController
{
	protected $encrypter;
	protected $form_validation;
	protected $session;
	protected $request;
	protected $M_user;
	protected $M_kategori;
	protected $M_jadwal;
	protected $M_pendaftaran;
	protected $ProfileModel;
	protected $db;

	public function __construct()
	{
		$this->session = \Config\Services::session();
		$this->encrypter = \Config\Services::encrypter();
		$this->form_validation =  \Config\Services::validation();
		$this->M_user = new UserModel();
		$this->M_pendaftaran = new PendaftaranModel($this->request);
		$this->M_kategori = new KategoriModel($this->request);
		$this->M_jadwal = new JadwalModel($this->request);
		$this->db = \Config\Database::connect();
		$this->session->start();
	}

	// Halaman Dashboard Magang
	public function index()
	{
		$data['title']  = "SI AMANG | Mentor";
		$data['page']   = "mentor";
		// Ambil data pendaftar dari model
		$pendaftaranModel = new PendaftaranModel($this->request);
		$dataPendaftar = $pendaftaranModel->get_pendaftar_by_kampus();

		// Siapkan data untuk digunakan dalam diagram batang
		$labels = [];
		$diterima = [];
		$tidak_diterima = [];
		foreach ($dataPendaftar as $pendaftar) {

			array_push($diterima, $pendaftar['Diterima']);
			array_push($labels, $pendaftar['nama_kampus']);
			array_push($tidak_diterima, $pendaftar['Tidak Diterima']);
		}


		$data['labels'] = $labels;
		$data['diterima'] = $diterima;
		$data['tidak_diterima'] = $tidak_diterima;
		// periksa apakah session masih ada atau tidak
		if (!$this->session->has('nama') || !$this->session->has('email')) {
			return redirect()->to('/login');
		}

		$data['nama']   = $this->session->get('nama');
		$data['email']   = $this->session->get('email');
		$data['events'] = $this->M_jadwal->getEvents();
		//Cek pendaftaran berdasarkan user_id
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
		
		// Ambil data pendaftaran yang terbaru dan belum diterima
		$data['tbl_pendaftaran'] = $this->M_pendaftaran->where('status_verifikasi', 'Belum Verifikasi')
			->orderBy('created_at', 'DESC')
			->findAll();
		$data['jumlah_pendaftaran'] = count($data['tbl_pendaftaran']);
		return view('v_mentor/index', $data);
	}

	public function updateProfile()
	{
		$data['nama']   = $this->session->get('nama');
		$data['email']   = $this->session->get('email');
		// menampilkan data title, link dan view
		$data['title']   = "SI AMANG | Update Profile";
		$data['judul']   = "Silahkan Perbarui Profile Anda Kemudian, Demi keamanan dimohon untuk selalu ganti password secara berkala";
		$data['page']   = "magang";
		$data['events'] = $this->M_jadwal->getEvents();

		// Ambil data pendaftaran yang terbaru dan belum diterima
		$data['tbl_pendaftaran'] = $this->M_pendaftaran->where('status_verifikasi', 'Belum Verifikasi')
			->orderBy('created_at', 'DESC')
			->findAll();
		$data['jumlah_pendaftaran'] = count($data['tbl_pendaftaran']);
		return view('v_mentor/profil', $data);
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
		return view('v_mentor/profil', $data);
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

		return redirect()->to(base_url('mentor/updateprofile'))->with('success', 'Password berhasil diupdate!');
	}



	// Logout
	public function logout()
	{
		$this->session->destroy();
		return redirect()->to('/');
	}
}
