<?php

namespace App\Controllers;

use App\Models\PendaftaranModel;
use App\Models\BidangModel;
use App\Models\KategoriModel;
use App\Models\MentorModel;
use App\Models\UserModel;
use App\Models\JadwalModel;
use Config\Services;
use CodeIgniter\Email\Email;

class DataPendaftaran extends BaseController
{
	protected $session;
	protected $M_pendaftaran;
	protected $M_bidang;
	protected $M_kategori;
	protected $M_mentor;
	protected $M_jadwal;
	protected $M_user;
	protected $form_validation;
	protected $request;

	public function __construct()
	{
		$this->request = Services::request();
		$this->M_pendaftaran = new PendaftaranModel($this->request);
		$this->M_bidang = new BidangModel($this->request);
		$this->M_kategori = new KategoriModel($this->request);
		$this->M_jadwal = new JadwalModel($this->request);
		$this->M_mentor = new MentorModel($this->request);
		$this->M_user = new UserModel($this->request);
		$this->form_validation =  \Config\Services::validation();
		$this->session = \Config\Services::session();

	}

	// Tombol Aksi Pada Tabel Data Pendaftaran
	private function _action($idPendaftaran, $statusVerifikasi)
	{
		if ($statusVerifikasi == "Diterima" || $statusVerifikasi == "Tidak Diterima") {
			$link = "
		      	<a href='" . base_url('datapendaftaran/view/' . $idPendaftaran) . "' class='btn-viewPendaftaran' data-toggle='tooltip' data-placement='top' title='View'>
		      		<button type='button' class='btn btn-outline-primary btn-xs'><i class='far fa-eye'></i></button>
		      	</a>
				<a href='" . base_url('datapendaftaran/ubah/' . $idPendaftaran) . "' class='btn-ubahPendaftaran' data-toggle='tooltip' data-placement='top' title='Ubah Status'>
				  <button type='button' class='btn btn-outline-warning btn-xs'><i class='fas fa-edit'></i></button>
			    </a>
		    ";
			return $link;
		} else {
			$link = "
		      	<a href='" . base_url('datapendaftaran/view/' . $idPendaftaran) . "' class='btn-viewPendaftaran' data-toggle='tooltip' data-placement='top' title='View'>
		      		<button type='button' class='btn btn-outline-primary btn-xs'><i class='far fa-eye'></i></button>
		      	</a>

		      	<a href='" . base_url('datapendaftaran/diterima/' . $idPendaftaran) . "' class='btn-diterimaPendaftaran' data-toggle='tooltip' data-placement='top' title='Diterima'>
		      		<button type='button' class='btn btn-outline-success btn-xs'><i class='fas fa-check'></i></button>
		      	</a>
				
				<a href='" . base_url('datapendaftaran/tidakditerima/' . $idPendaftaran) . "' class='btn-tidakDiterimaPendaftaran' data-toggle='tooltip' data-placement='top' title='Tidak Diterima'>
				  <button type='button' class='btn btn-outline-danger btn-xs'><i class='fas fa-times'></i></button>
				</a>
		    ";
			return $link;
		}
	}

	// Halaman Data Pendaftaran
	public function index()
	{
		$data['title']   = "SI AMANG | Data Pendaftaran";
		$data['page']    = "datapendaftaran";

		// periksa apakah session masih ada atau tidak
		if (!$this->session->has('nama') || !$this->session->has('email')) {
			return redirect()->to('/login');
		}

		$data['nama']   = $this->session->get('nama');
		$data['email']   = $this->session->get('email');

		// Ambil data pendaftaran yang terbaru dan belum diterima
		$tbl_pendaftaran = $this->M_pendaftaran->where('status_verifikasi', 'Belum Verifikasi')
			->orderBy('created_at', 'DESC')
			->findAll();
		$data['tbl_pendaftaran'] = $tbl_pendaftaran;
		$data['jumlah_pendaftaran'] = count($tbl_pendaftaran);

		if ($data['jumlah_pendaftaran'] > 0) {
			$email = service('email');
			$email->setTo('asal'); // ganti dengan email admin
			$email->setFrom('noreply@si amang.com', 'SI AMANG');
			$email->setSubject('Pendaftaran Magang Baru');

			$emailMessage = '<html><head><style>';
			$emailMessage .= 'h1 {color: #292929; font-family: Arial, sans-serif; font-size: 28px;}';
			$emailMessage .= 'a {color: #fff; text-decoration: none; background-color: #007bff; padding: 10px 20px; border-radius: 5px;}';
			$emailMessage .= 'a:hover {background-color: #0069d9;}';
			$emailMessage .= '</style></head><body>';
			$emailMessage .= '<h1>Pendaftaran Magang Baru</h1>';
			$emailMessage .= '<p>Halo Admin,</p>';
			$emailMessage .= '<p>Terdapat <strong>' . $data['jumlah_pendaftaran'] . '</strong> pendaftaran magang baru yang perlu diverifikasi.</p>';
			$emailMessage .= '<p>Silakan klik button di bawah ini untuk login dan masuk ke sistem</p>';
			$emailMessage .= '<a href="' . base_url() . '/login">Login</a>';
			$emailMessage .= '<p>Terima kasih,</p>';
			$emailMessage .= '<p>SI AMANG</p>';
			$emailMessage .= '</body></html>';

			$email->setMessage($emailMessage);
			$email->setMailType('html');
			$email->send();
			
		}
		$data['events'] = $this->M_jadwal->getEvents();
		return view('v_dataPendaftaran/index', $data);
	}


	// Halaman View Pendaftaran
	public function view($id)
	{
		$data['title']   = "SI AMANG | View Data Pendaftaran";
		$data['page']    = "datapendaftaran";
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

				return view('v_dataPendaftaran/view', $data);
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

	public function diterima($id)
	{
		// Data pendaftaran
		$data = [
			'status_verifikasi' => "Diterima",
			'keterangan' => null // reset kolom keterangan menjadi null
		];

		// Update Data pendaftaran
		$this->M_pendaftaran->update($id, $data);

		// Mengambil data email
		$emailAddress = $this->M_pendaftaran->getEmailById($id);

		// Mengirim email
		$email = \Config\Services::email();
		$email->setFrom('noreply@si amang.com', 'SI AMANG');
		$email->setTo($emailAddress);
		$email->setSubject('Pendaftaran Magang SI AMANG');
		$email->setMessage('
<html>
<head>
	<style>
		body {
			font-family: Arial, sans-serif;
			background-color: #f2f2f2;
			color: #333;
			padding: 20px;
			font-size: 16px;
			line-height: 1.5;
		}
		h1 {
			color: #0072c6;
			font-size: 28px;
			font-weight: bold;
			margin-top: 0;
			margin-bottom: 20px;
		}
		img {
			max-width: 100%;
			height: auto;
			margin-bottom: 20px;
		}
		.btn {
			display: inline-block;
			padding: 10px 20px;
			background-color: #0072c6;
			color: #fff;
			font-size: 18px;
			font-weight: bold;
			text-align: center;
			text-decoration: none;
			border-radius: 5px;
			transition: background-color 0.3s ease-in-out;
		}
		.btn:hover {
			background-color: #005ea2;
		}
	</style>
</head>
<body>
	<h1>Selamat Pendaftaran Anda Kami Terima!</h1>
	<p>Terima kasih telah mendaftar untuk program magang di SI AMANG. Anda akan segera mendapatkan informasi lebih lanjut mengenai jadwal dan tugas magang.</p>
	<p>Untuk saat ini, silakan login terlebih dahulu dan cek jadwal magang Anda dengan cara klik tautan berikut:</p>
	<a href="' . base_url('updateProfile') . '" class="btn btn-primary">Masuk Halaman Magang</a>
	<p>Jangan ragu untuk menghubungi kami jika Anda memiliki pertanyaan atau kekhawatiran. Kami berharap Anda dapat memperoleh pengalaman magang yang bermanfaat di DISKOMINFOSAN Kota Yogyakarta.</p>
	
	</body>
	');
		$email->setAltMessage('Selamat Pendaftaran Anda Kami Terima! Silahkan login dan cek jadwal magang anda dengan cara klik tautan berikut: ' . base_url('Login'));

		if ($email->send()) {
			return json_encode([
				'email' => $emailAddress,
				'id' => $id,
				'status' => 'Email berhasil dikirim'
			]);
		} else {
			return json_encode([
				'email' => $emailAddress,
				'id' => $id,
				'status' => 'Gagal mengirim email'
			]);
		}
	}


	public function tidakditerima($id)
	{
		$data['title'] = "SI AMANG | Tidak Diterima";
		$data['page'] = "datapendaftaran";
		$data['nama'] = $this->session->get('nama');
		$data['email'] = $this->session->get('email');
		$data['events'] = $this->M_jadwal->getEvents();

		// Ambil data pendaftaran berdasarkan id
		$data['tbl_pendaftaran'] = $this->M_pendaftaran->find($id);

		// Form validation
		$validation = \Config\Services::validation();

		if ($this->request->getMethod() === 'post') {
			// Set rules form validation
			$validation->setRules([
				'keterangan' => [
					'label' => 'Keterangan',
					'rules' => 'max_length[255]',
				],
			]);

			// Check validation
			if ($validation->withRequest($this->request)->run()) {
				$data = [
					'status_verifikasi' => 'Tidak Diterima',
					'keterangan' => $this->request->getPost('keterangan')
				];

				if ($this->M_pendaftaran->update($id, $data)) {
					// Mengambil data email
					$emailAddress = $this->M_pendaftaran->getEmailById($id);

					// Mengirim email
					$email = \Config\Services::email();
					$email->setFrom('noreply@si amang.com', 'SI AMANG');
					$email->setSubject('Pendaftaran Magang SI AMANG');
					$email->setTo($emailAddress);
					$emailContent = '<html><body style="background-color:#f2f2f2; font-family: Arial, sans-serif; font-size: 16px; line-height: 1.5; padding: 20px;">';
					$emailContent .= '<h1>Maaf, Pendaftaran Anda Tidak Diterima</h1>';
					$emailContent .= '<p>Mohon maaf, pendaftaran Anda untuk program magang di SI AMANG tidak dapat kami terima.</p>';
					$emailContent .= '<p>Berikut adalah keterangan dari pihak kami mengenai penolakan pendaftaran Anda:</p>';
					$emailContent .= '<p style="font-weight:bold;">' . $this->request->getPost('keterangan') . '</p>';
					$emailContent .= '</body></html>';

					$email->setMessage($emailContent);
					$email->setAltMessage('Mohon maaf, pendaftaran Anda tidak diterima dengan keterangan: ' . $this->request->getPost('keterangan'));

					if ($email->send()) {
						$this->session->setFlashdata('success_message', 'Data berhasil diubah dan email berhasil dikirim.');
					} else {
						$this->session->setFlashdata('success_message', 'Data berhasil diubah tetapi email gagal dikirim.');
					}

					return redirect()->to(base_url('datapendaftaran'));
				} else {
					$this->session->setFlashdata('error_message', 'Data gagal diubah.');
				}
			} else {
				$this->session->setFlashdata('error_message', 'Terjadi kesalahan saat memproses data.');
			}
		}
		return view('v_dataPendaftaran/tidakditerima', $data);
	}


	public function ubah($id)
	{
		$data['title']   = "SI AMANG | Ubah Status Verifikasi";
		$data['page']    = "ubahstatus";
		$data['nama']    = $this->session->get('nama');
		$data['email']   = $this->session->get('email');
		// Ambil data pendaftaran yang terbaru dan belum diterima
		$data['tbl_pendaftaran'] = $this->M_pendaftaran->where('status_verifikasi', 'Diterima')
			->orderBy('created_at', 'DESC')
			->findAll();
		$data['jumlah_pendaftaran'] = count($data['tbl_pendaftaran']);
		$data['events'] = $this->M_jadwal->getEvents();
		$data['pendaftaran'] = $this->M_pendaftaran->find($id);

		if (empty($data['pendaftaran'])) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException('Data Pendaftaran tidak ditemukan.');
		}

		if ($this->request->getMethod() == 'post' && $this->validate([
			'nama_peserta' => 'required',
			'status_verifikasi' => 'required',
		])) {
			$data = [
				'nama_peserta' => $this->request->getPost('nama_peserta'),
				'status_verifikasi' => $this->request->getPost('status_verifikasi'),
				'keterangan' => $this->request->getPost('keterangan')
			];

			$this->M_pendaftaran->update($id, $data);

			// Tambahkan notifikasi Sweet Alert
			session()->setFlashdata('success', 'Data berhasil diubah!');

			return redirect()->to(base_url('datapendaftaran'));
		}

		return view('v_dataPendaftaran/edit', $data);
	}



	public function update($id)
	{
		if ($this->request->getMethod() == 'post' && $this->validate([
			'status_verifikasi' => 'required',
		])) {
			$data = [
				'status_verifikasi' => $this->request->getPost('status_verifikasi'),
				'keterangan' => $this->request->getPost('keterangan')
			];
			if ($this->request->getPost('status_verifikasi') == 'Diterima' || $this->request->getPost('status_verifikasi') == 'Belum Verifikasi') {
				$data['keterangan'] = '';
			} else if ($this->request->getPost('status_verifikasi') == 'Tidak Diterima') {
				$data['keterangan'] = $this->request->getPost('keterangan');
			}

			$this->M_pendaftaran->update($id, $data);

			// redirect ke halaman sebelumnya
			return redirect()->to(base_url('datapendaftaran'));
		}
	}
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
		$data['page'] = "datapendaftaran";

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
		return view('v_dataPendaftaran/filter', $data);
	}

	// Datatable server side
	public function ajaxDataPendaftaran()
	{
		if ($this->request->getMethod(true) == 'POST') {
			$lists = $this->M_pendaftaran->get_datatables();
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
				"draw" => $this->request->getPost('draw'),
				"recordsTotal" => $this->M_pendaftaran->count_all(),
				"recordsFiltered" => $this->M_pendaftaran->count_filtered(),
				"data" => $data
			];
			echo json_encode($output);
		}
	}
}
