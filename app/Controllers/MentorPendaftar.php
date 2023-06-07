<?php

namespace App\Controllers;

use App\Models\PendaftaranModel;
use App\Models\MentorPendaftarModel;
use App\Models\BidangModel;
use App\Models\KategoriModel;
use App\Models\JadwalModel;
use App\Models\UserModel;
use Config\Services;

class MentorPendaftar extends BaseController
{
	protected $session;
	protected $M_pendaftaran;
	protected $M_bidang;
	protected $M_kategori;
	protected $M_jadwal;
	protected $M_user;
	protected $M_mentorpendaftar;
	protected $request;
	protected $db;

	public function __construct()
	{
		$this->request = Services::request();
		$this->M_pendaftaran = new PendaftaranModel($this->request);
		$this->M_bidang = new BidangModel($this->request);
		$this->M_kategori = new KategoriModel($this->request);
		$this->M_jadwal = new JadwalModel($this->request);
		$this->M_user = new UserModel($this->request);
		$this->M_mentorpendaftar = new MentorPendaftarModel($this->request);
		$this->session = \Config\Services::session();
		$this->db = \Config\Database::connect();
	}

	// Tombol Aksi Pada Tabel Data Pendaftaran
	private function _action($idPendaftaran, $statusVerifikasi)
	{
		if ($statusVerifikasi == "Diterima" || $statusVerifikasi == "Tidak Diterima") {
			$link = "
		      	<a href='" . base_url('mentorpendaftar/view/' . $idPendaftaran) . "' class='btn-viewMentor' data-toggle='tooltip' data-placement='top' title='View'>
		      		<button type='button' class='btn btn-outline-primary btn-xs'><i class='far fa-eye'></i></button>
		      	</a>
		    ";
			return $link;
		} else {
			$link = "
		      	<a href='" . base_url('mentorpendaftar/view/' . $idPendaftaran) . "' class='btn-viewMentor' data-toggle='tooltip' data-placement='top' title='View'>
		      		<button type='button' class='btn btn-outline-primary btn-xs'><i class='far fa-eye'></i></button>
		      	</a>

		    ";
			return $link;
		}
	}
	public function index()
	{
		$data['title'] = "SI AMANG | Data Pendaftaran";
		$data['page'] = "pendaftaranmentor";

		// Periksa apakah session masih ada atau tidak
		if (!$this->session->has('nama') || !$this->session->has('email')) {
			return redirect()->to('/login');
		}

		$data['nama'] = $this->session->get('nama');
		$data['email'] = $this->session->get('email');
		$data['events'] = $this->M_jadwal->getEvents();
		//Cek pendaftaran berdasarkan user_id
		$user_id = $this->session->get('id');
		$pendaftaran = $this->M_pendaftaran->where('user_id', $user_id)->first();
		$user = $this->M_user->where('id', $user_id)->first();
		// join table pendaftaran berdasarkan user_id
		$builder = $this->db->table('tbl_user');
		$builder->select('tbl_pendaftaran.nama_peserta, tbl_pendaftaran.foto, tbl_pendaftaran.bidang_id, tbl_pendaftaran.kategori_id, tbl_user.nama, tbl_jadwal.tanggal_mulai, tbl_jadwal.tanggal_selesai, tbl_pendaftaran.keterangan');
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

		// Ambil data pendaftaran yang terbaru dan belum diterima dengan bidang_id yang sama
		$data['tbl_pendaftaran'] = $this->M_pendaftaran->where('status_verifikasi', 'Belum Verifikasi')
			->orderBy('created_at', 'DESC')
			->findAll();
		$data['jumlah_pendaftaran'] = count($data['tbl_pendaftaran']);

		return view('v_mentor/daftarmhs', $data);
	}

	// Halaman View Pendaftaran
	public function view($id)
	{
		$data['title']   = "SI AMANG | View Data Pendaftaran";
		$data['page']    = "mentorpendaftar";
		$data['nama']   = $this->session->get('nama');
		$data['email']   = $this->session->get('email');

		// Ambil data pendaftaran yang terbaru dan belum diterima
		$tbl_pendaftaran = $this->M_pendaftaran->where('status_verifikasi', 'Belum Verifikasi')
			->orderBy('created_at', 'DESC')
			->findAll();
		$data['tbl_pendaftaran'] = $tbl_pendaftaran;
		$data['jumlah_pendaftaran'] = count($tbl_pendaftaran);
		$data['events'] = $this->M_jadwal->getEvents();

		//Cek pendaftaran berdasarkan id pendaftaran
		$cekPendaftaran = $this->M_pendaftaran->where('id', $id)->first();
		$status_pendaftaran = $cekPendaftaran['status_pendaftaran'];
		$bidang_id 	= $cekPendaftaran['bidang_id'];
		$kategori_id 		= $cekPendaftaran['kategori_id'];

		//Jika Data pendaftaran ada
		if ($cekPendaftaran) {
			//Jika pendaftaran sudah selesai
			if ($status_pendaftaran == "Selesai") {
				$data['pendaftaran'] = $cekPendaftaran;

				//bidang
				$cekBidang = $this->M_bidang->where('id', $bidang_id)->first();
				$data['nama_bidang']   = $cekBidang['nama_bidang'];

				//Kategori
				$cekKategori = $this->M_kategori->where('id', $kategori_id)->first();
				$data['nama_kategori']   = $cekKategori['nama_kategori'];

				return view('v_mentor/view', $data);
			}
			//Pendaftaran belum selesai 
			else {
				return view('v_dataPendaftaran/error', $data);
			}
		}
		//Data pendaftaran tidak ada 
		else {
			return view('v_dataPendaftaran/error', $data);
		}
	}
	/* public function move($idPendaftaran)
	{
		$pendaftaranModel = new PendaftaranModel($this->request);
		$pendaftaran = $pendaftaranModel->find($idPendaftaran);
		$namaPeserta = $pendaftaran['nama_peserta'];
		//kirim pesan ke admin
		$adminEmail = 'admin@si-amang.com'; //alamat email admin
		$subject = 'Perubahan Kategori/Bidang Pendaftaran';
		$message = 'Halo Admin, terdapat perubahan kategori/bidang untuk pendaftaran dengan nama peserta ' . $namaPeserta . '. Silahkan cek halaman admin untuk lebih detailnya.';
		$email = \Config\Services::email();
		$email->setFrom('noreply@si-amang.com', 'SI AMANG');
		$email->setTo($adminEmail);
		$email->setSubject($subject);
		$email->setMessage($message);
		if ($email->send()) {
			$kategori = $this->request->getVar('kategori');
			//simpan perubahan kategori/bidang pada pendaftaran dengan idPendaftaran
			$pendaftaranModel->update($idPendaftaran, ['kategori' => $kategori]);
			return redirect()->to(base_url('mentorpendaftar'));
		} else {
			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		}
	} */
	public function filterData()
	{
		$nama_peserta = $this->request->getVar('nama_peserta');
		$status_verifikasi = $this->request->getVar('status_verifikasi');

		$data = [];

		$db = \Config\Database::connect();
		$builder = $db->table('tbl_pendaftaran');

		$builder->select('*')->join('tbl_kategori', 'tbl_kategori.id = tbl_pendaftaran.kategori_id', 'left');
		
		if (!empty($nama_peserta)) {
			$builder->like('nama_peserta', $nama_peserta, 'both');
		}

		if (!empty($status_verifikasi)) {
			$builder->where('status_verifikasi', $status_verifikasi);
		}

		$results = $builder->get()->getResultArray();

		$data['results'] = $results; // Menggunakan key 'results' untuk menyimpan hasil query

		$data['title'] = "SI AMANG | Data Pendaftaran";
		$data['page'] = "mentorpendaftar";

		// Periksa apakah session masih ada atau tidak
		if (!$this->session->has('nama') || !$this->session->has('email')) {
			return redirect()->to('/login');
		}

		$data['nama'] = $this->session->get('nama');
		$data['email'] = $this->session->get('email');

		// Ambil data pendaftaran yang terbaru dan belum diterima
		$tbl_pendaftaran = $this->M_pendaftaran->where('status_verifikasi', 'Belum Verifikasi')
			->orderBy('created_at', 'DESC')
			->findAll();
		$data['tbl_pendaftaran'] = $tbl_pendaftaran;
		$data['jumlah_pendaftaran'] = count($tbl_pendaftaran);
		$data['events'] = $this->M_jadwal->getEvents();
		return view('v_mentor/filter', $data);
	}
	
	// Datatable server side
	public function ajaxDataPendaftaran()
	{

		if ($this->request->getMethod(true) == 'POST') {
			$lists = $this->M_mentorpendaftar->get_datatables();
			$data = [];
			$no = $this->request->getPost("start");
			foreach ($lists as $list) {
				$no++;
				$row = [];
				$row[] = $no;
				$row[] = '<img class="circle-img" src="/file_peserta/' . $list->foto . '">';
				$row[] = $list->nomor_pendaftaran;
				$row[] = $list->nama_peserta;
				$row[] = $list->nama_kategori;
				$row[] = tgl_indonesia($list->tanggal_pendaftaran);
				// Pengecekan jadwal pada M_jadwal
				$jadwalExists = $this->M_jadwal->checkExistData($list->id);
				//Jika status diterima dan data jadwal sudah ada maka akan menampilkan sudah ada jadwal atau belum
				if ($list->status_verifikasi == 'Diterima') {
					if ($jadwalExists) {
						$row[] = '<div class="status-oval diterima"><span class="status-text">' . $list->status_verifikasi . ' (Sudah ada jadwal)</span></div>';
					} else {
						$row[] = '<div class="status-oval diterima"><span class="status-text">' . $list->status_verifikasi . ' (Belum ada jadwal)</span></div>';
					}
				} else if ($list->status_verifikasi == 'Tidak Diterima') {
					$row[] = '<div class="status-oval ditolak"><span class="status-text">' . $list->status_verifikasi . '</span></div>';
				} else if ($list->status_verifikasi == 'Belum Verifikasi') {
					$row[] = '<div class="status-oval belum-verifikasi"><span class="status-text">' . $list->status_verifikasi . '</span></div>';
				} else {
					$row[] = $list->status_verifikasi;
				}
				$row[] = $list->keterangan;
				$row[] = $this->_action($list->id, $list->status_verifikasi);
				$data[] = $row;
			}
			$output = [
				"draw" 				=> $this->request->getPost('draw'),
				"recordsTotal" 		=> $this->M_mentorpendaftar->count_all(),
				"recordsFiltered" 	=> $this->M_mentorpendaftar->count_filtered(),
				"data" 				=> $data
			];
			echo json_encode($output);
		}
	}
}
