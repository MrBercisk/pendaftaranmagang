<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\PendaftaranModel;
use App\Models\BidangModel;
use App\Models\KategoriModel;
use App\Models\InformasiModel;
use App\Models\KampusModel;
use App\Models\MentorModel;
use Config\Services;

class Pendaftaran extends BaseController
{
	protected $encrypter;
	protected $form_validation;
	protected $M_user;
	protected $M_pendaftaran;
	protected $M_bidang;
	protected $M_kategori;
	protected $M_informasi;
	protected $M_mentor;
	protected $M_kampus;
	protected $session;
	protected $request;

	public function __construct()
	{
		date_default_timezone_set('Asia/Jakarta');
		$this->request = Services::request();
		$this->encrypter = \Config\Services::encrypter();
		$this->form_validation =  \Config\Services::validation();
		$this->M_user = new UserModel();
		$this->M_pendaftaran = new PendaftaranModel($this->request);
		$this->M_bidang = new BidangModel($this->request);
		$this->M_kategori = new KategoriModel($this->request);
		$this->M_informasi = new InformasiModel($this->request);
		$this->M_mentor = new MentorModel($this->request);
		$this->M_kampus = new KampusModel($this->request);
		$this->session = \Config\Services::session();
	}

	// Input data pendaftaran saat pembuatan akun
	private function _inputPendaftaran()
	{
		//Cek Maksimal ID User
		$max = $this->M_user->selectMax('id')->first();
		$idUser = $max['id'];

		//Cek Nomor Pendaftaran
		$maxPendaftaran = $this->M_pendaftaran->selectMax('nomor_pendaftaran')->first();
		if ($maxPendaftaran['nomor_pendaftaran'] == "") {
			$nomor_pendaftaran = 202212001;
		} else {
			$nomor_pendaftaran = $maxPendaftaran['nomor_pendaftaran'] + 1;
		}


		$data = [
			'user_id' => $idUser,
			'nomor_pendaftaran' => $nomor_pendaftaran,
			'tanggal_lahir' => date('Y-m-d'),
			'tahap_satu' => 'Belum',
			'tahap_dua' => 'Belum',
			'tahap_tiga' => 'Belum',
			'status_pendaftaran' => 'Belum Selesai'
		];

		//Simpan Data Pendaftaran
		$this->M_pendaftaran->save($data);
	}

	// Halaman pendaftaran - buat akun
	public function index()
	{
		$data['title']   = "SI AMANG | Pendaftaran";
		$data['tanggal'] = $this->M_informasi->first();

		//Cek tanggal pendaftaran
		$tanggal = $this->M_informasi->first();
		$sekarang = date('Y-m-d');

		$data['tgl_buka']   = $tanggal['tgl_buka'];
		$data['tgl_tutup']   = $tanggal['tgl_tutup'];

		if ($sekarang < $tanggal['tgl_buka']) {
			return view('v_pendaftaran/belum', $data);
		} else if ($sekarang >= $tanggal['tgl_buka'] && $sekarang <= $tanggal['tgl_tutup']) {
			return view('v_pendaftaran/index', $data);
		} else {
			return view('v_pendaftaran/tutup', $data);
		}
	}

	public function daftarAkun()
	{
		$nama 		= $this->request->getPost('nama');
		$email	 	= $this->request->getPost('email');
		$password	= $this->request->getPost('password');
		$confirm_password	= $this->request->getPost('confirm_password');

		//Validasi daftar akun pendaftaran
		$cek_validasi = [
			'nama' => $nama,
			'email' => $email,
			'password' => $password,
			'confirm_password' => $confirm_password
		];

		//Cek Validasi, Jika Data Tidak Valid 
		if ($this->form_validation->run($cek_validasi, 'daftar_akun') == FALSE) {

			$validasi = [
				'error'   => true,
				'daftar_akun_error' => $this->form_validation->getErrors()
			];
			echo json_encode($validasi);
		}

		//Data Valid
		else {
			//Data User
			$data = [
				'role_id' => 3,
				'nama' => strtoupper($nama),
				'email' => $email,
				'password' => base64_encode($this->encrypter->encrypt($password))
			];
			//Simpan Data User
			$this->M_user->save($data);

			//Input data pendaftaran
			$this->_inputPendaftaran();

			$validasi = [
				'success'   => true,
				'link'   => base_url('login')
			];
			echo json_encode($validasi);
		}
	}

	public function cekStatusPendaftaran()
	{
		$user_id = $this->session->get('id');
		// Cek pendaftaran berdasarkan user_id
		$cekStatus = $this->M_pendaftaran->where('user_id', $user_id)->first();

		// Jika status pendaftaran selesai dan status verifikasi diterima
		if ($cekStatus['status_pendaftaran'] == "Selesai" && $cekStatus['status_verifikasi'] == "Diterima") {
			return redirect()->to('/updateProfile'); // Ganti dengan link yang sesuai untuk updateProfile
		}

		// Jika status pendaftaran selesai
		if ($cekStatus['status_pendaftaran'] == "Selesai") {
			return redirect()->to('/pendaftaran/dashboard');
		}

		// Jika status pendaftaran resume
		if ($cekStatus['status_pendaftaran'] == "Resume") {
			return redirect()->to('/pendaftaran/tahapempat');
		}

		// Jika status pendaftaran belum selesai
		return redirect()->to('/pendaftaran/tahapsatu');
	}


	// Halaman pendaftaran tahap satu (Biodata Peserta)
	public function tahapSatu()
	{
		$data['title']   = "SI AMANG | Pendaftaran Tahap 1";

		//Cek pendaftaran tahap satu berdasarkan user_id
		$user_id = $this->session->get('id');
		$cekTahapSatu = $this->M_pendaftaran->where('user_id', $user_id)->first();

		$data['cekTahapSatu'] = $cekTahapSatu;
		$data['nama_kampus'] = $this->M_kampus->get_nama_kampus();

		return view('v_pendaftaran/tahap_1', $data);
	}

	// Simpan pendaftaran tahap satu
	public function saveTahapSatu()
	{
		$id 			= $this->request->getPost('idPendaftaran');
		$nama_peserta 	= $this->request->getPost('nama_peserta');
		$keahlian 	= $this->request->getPost('keahlian');
		$tools 	= $this->request->getPost('tools');
		$no_hp			= $this->request->getPost('no_hp');
		$nim			= $this->request->getPost('nim');
		$nama_kampus	= $this->request->getPost('nama_kampus');
		$prodi	= $this->request->getPost('prodi');
		$judul	= $this->request->getPost('judul');
		$alamat_peserta	= $this->request->getPost('alamat_peserta');
		$jenis_permohonan	= $this->request->getPost('jenis_permohonan');
		$status_permohonan	= $this->request->getPost('status_permohonan');
		$nama_anggota_1	= $this->request->getPost('nama_anggota_1');
		$nama_anggota_2	= $this->request->getPost('nama_anggota_2');

		//Validasi pendaftaran tahap satu
		$validasi_tahap_satu = [
			'nama_peserta' => $nama_peserta,
			'keahlian' => $keahlian,
			'tools' => $tools,
			'no_hp' => $no_hp,
			'nim' => $nim,
			'alamat_peserta' => $alamat_peserta,
			'nama_kampus' => $nama_kampus,
			'prodi' => $prodi,
			'judul' => $judul,
			'jenis_permohonan' => $jenis_permohonan,
			'status_permohonan' => $status_permohonan,
			'nama_anggota_1' => $nama_anggota_1,
			'nama_anggota_2' => $nama_anggota_2,
		];

		//Cek Validasi pendaftaran tahap satu, Jika Data Tidak Valid 
		if ($this->form_validation->run($validasi_tahap_satu, 'tahap_satu') == FALSE) {

			$validasi = [
				'error'   => true,
				'tahap_satu_error' => $this->form_validation->getErrors()
			];
			echo json_encode($validasi);
		}

		//Data Valid
		else {
			//Data pendaftaran tahap satu
			$data_tahap_satu = [
				'nama_peserta' => strtoupper($nama_peserta),
				'keahlian' => $keahlian,
				'tools' => $tools,
				'no_hp' => $no_hp,
				'nim' => $nim,
				'alamat_peserta' => $alamat_peserta,
				'nama_kampus' => strtoupper($nama_kampus),
				'prodi' => $prodi,
				'judul' => $judul,
				'jenis_permohonan' => $jenis_permohonan,
				'status_permohonan' => $status_permohonan,
				'nama_anggota_1' => strtoupper($nama_anggota_1),
				'nama_anggota_2' => strtoupper($nama_anggota_2),
				'tahap_satu'  => "Selesai"
			];
			//Simpan pendaftaran tahap satu
			$this->M_pendaftaran->update($id, $data_tahap_satu);

			$validasi = [
				'success'   => true,
				'link'   => base_url('pendaftaran/tahapdua')
			];
			echo json_encode($validasi);
		}
	}

	// Halaman pendaftaran tahap dua (Pilih Bidang Dan Kategori)
	public function tahapDua()
	{
		$data['title'] = "SI AMANG | Pendaftaran Tahap 2";
		$data['bidang'] = $this->M_bidang->findAll();
		$data['kategori'] = $this->M_kategori->findAll();

		//Cek bidang dan Kategori Peserta pada pendaftaran tahap dua berdasarkan user_id
		$user_id = $this->session->get('id');
		$cekTahapDua = $this->M_pendaftaran->where('user_id', $user_id)->first();
		$bidang_id = $cekTahapDua['bidang_id'];
		$kategori_id = $cekTahapDua['kategori_id'];


		$data['idPendaftaran'] = $cekTahapDua['id'];
		$data['tahap_dua'] = $cekTahapDua['tahap_dua'];

		//Jika $bidang_id == 0 dan $kategori_id == 0
		if ($bidang_id == 0 && $kategori_id == 0) {
			$data['IdBidang'] = "";
			$data['nama_bidang'] = "--Bidang--";
			$data['IdKategori'] = "";
			$data['nama_kategori'] = "--Kategori--";
		}
		//Dan jika tidak
		else {
			//Bidang
			$data['IdBidang'] = $bidang_id;
			$cekBidang = $this->M_bidang->where('id', $bidang_id)->first();
			$data['nama_bidang'] = $cekBidang['nama_bidang'];
			//Kategori
			$data['IdKategori'] = $kategori_id;
			$cekKategori = $this->M_kategori->where('id', $kategori_id)->first();
			$data['nama_kategori'] = $cekKategori['nama_kategori'];
		}

		// Menampilkan pilihan mentor berdasarkan kategori_id
		$data['mentor'] = $this->M_user->where('role_id', 2)->where('kategori_id', $kategori_id)->findAll();

		return view('v_pendaftaran/tahap_2', $data);
	}

	// Menampilkan pilihan kategori berdasarkan bidang pada Halaman pendaftaran tahap dua 
	public function ajaxPilihanKategori()
	{
		$bidang_id = $this->request->getPost('id');
		$data = $this->M_kategori->where('bidang_id', $bidang_id)->findAll();
		echo json_encode($data);
	}

	// Simpan pendaftaran tahap dua
	public function saveTahapDua()
	{
		$id 		= $this->request->getPost('idPendaftaran');
		$bidang 	= $this->request->getPost('bidang');
		$kategori 	= $this->request->getPost('kategori');
		$mentor 	= $this->request->getPost('mentor');

		// Data pendaftaran tahap dua
		$data_tahap_dua = [
			'bidang_id' => $bidang,
			'kategori_id' => $kategori,
			'mentor_id' => $mentor,
			'tahap_dua'  => "Selesai"
		];

		// Cek Validasi pendaftaran tahap dua, Jika Data Tidak Valid 
		if ($this->form_validation->run($data_tahap_dua, 'tahap_dua') == FALSE) {

			$validasi = [
				'error'   => true,
				'tahap_dua_error' => $this->form_validation->getErrors()
			];
			echo json_encode($validasi);
		}

		// Data Valid
		else {
			// Simpan pendaftaran tahap dua
			$this->M_pendaftaran->update($id, $data_tahap_dua);

			// Update kategori_id pada tbl_user
			$user_id = $this->session->get('id');
			$user = $this->M_user->where('id', $user_id)->first();
			$data_user = [
				'bidang_id' => $bidang,
				'kategori_id' => $kategori
			];
			$this->M_user->update($user_id, $data_user);

			$validasi = [
				'success'   => true,
				'link'   => base_url('pendaftaran/tahaptiga')
			];
			echo json_encode($validasi);
		}
	}

	// Halaman pendaftaran tahap tiga (Upload Berkas Pendaftaran)
	public function tahapTiga()
	{
		$data['title']   = "SI AMANG | Pendaftaran Tahap 3";

		//Cek Foto dan Berkas Peserta pada pendaftaran tahap tiga berdasarkan user_id
		$user_id = $this->session->get('id');
		$cekTahapTiga = $this->M_pendaftaran->where('user_id', $user_id)->first();
		$foto_peserta = $cekTahapTiga['foto'];
		$berkas_peserta = $cekTahapTiga['berkas'];
		$nda = $cekTahapTiga['nda'];
		$surat_permohonan = $cekTahapTiga['surat_permohonan'];
		$video_perkenalan = $cekTahapTiga['video_perkenalan'];

		//Jika foto_peserta == "" dan berkas_peserta == ""
		if ($foto_peserta == "" && $berkas_peserta == "") {
			$data['foto_peserta'] = "Pilih foto..";
			$data['berkas_peserta'] = "Pilih berkas..";
			$data['nda'] = "Pilih file..";
			$data['lokasi_foto'] = "/file_peserta/default.jpg";
			$data['surat_permohonan'] = "Pilih file..";
			$data['video_perkenalan'] = "Pilih file..";
		}
		//Jika tidak
		else {
			$data['foto_peserta'] = $foto_peserta;
			$data['berkas_peserta'] = $berkas_peserta;
			$data['nda'] = $nda;
			$data['surat_permohonan'] = $surat_permohonan;
			$data['video_perkenalan'] = $video_perkenalan;
			$data['lokasi_foto'] = "/file_peserta/" . $foto_peserta;
		}

		$data['idPendaftaran']   = $cekTahapTiga['id'];
		$data['tahap_tiga']   = $cekTahapTiga['tahap_tiga'];

		return view('v_pendaftaran/tahap_3', $data);
	}

	// Simpan pendaftran tahap tiga
	public function saveTahapTiga()
	{
		$id 	= $this->request->getPost('idPendaftaran');
		$foto  	= $this->request->getFile('foto');
		$berkas = $this->request->getFile('berkas');
		$nda = $this->request->getFile('nda');
		$surat_permohonan = $this->request->getFile('surat_permohonan');
		$video_perkenalan = $this->request->getFile('video_perkenalan');

		//Validasi pendaftaran tahap tiga
		$validasi_tahap_tiga = [
			'foto' => $foto,
			'berkas' => $berkas,
			'nda' => $nda,
			'surat_permohonan' => $surat_permohonan,
			'video_perkenalan' => $video_perkenalan
		];

		//Cek Validasi pendaftaran tahap tiga, Jika Data Tidak Valid 
		if ($this->form_validation->run($validasi_tahap_tiga, 'tahap_tiga') == FALSE) {

			$validasi = [
				'error'   => true,
				'tahap_tiga_error' => $this->form_validation->getErrors()
			];
			echo json_encode($validasi);
		}

		//Data Valid
		else {
			//Pindahkan file foto peserta ke direktori public/file_peserta
			$nama_foto = $foto->getRandomName();
			$foto->move('file_peserta', $nama_foto);

			//Pindahkan file berkas pendaftaran peserta ke direktori public/file_peserta
			$nama_berkas = $berkas->getRandomName();
			$berkas->move('file_peserta', $nama_berkas);

			$nama_surat = $surat_permohonan->getRandomName();
			$surat_permohonan->move('file_peserta', $nama_surat);

			$nama_nda = $nda->getRandomName();
			$nda->move('file_peserta', $nama_nda);

			$nama_video = $video_perkenalan->getRandomName();
			$video_perkenalan->move('file_peserta', $nama_video);

			$data_tahap_tiga = [
				'foto'   	=> $nama_foto,
				'berkas'   	=> $nama_berkas,
				'nda'   	=> $nama_nda,
				'surat_permohonan'   	=> $nama_surat,
				'video_perkenalan'   	=> $nama_video,
				'tahap_tiga'  => "Selesai",
				'status_pendaftaran'   	=> "Resume"
			];

			//Simpan pendaftaran tahap tiga
			$this->M_pendaftaran->update($id, $data_tahap_tiga);

			$validasi = [
				'success'   => true,
				'link'   => base_url('pendaftaran/tahapempat')
			];
			echo json_encode($validasi);
		}
	}

	// Halaman pendaftaran tahap empat (Resume Pendaftaran)
	public function tahapEmpat()
	{
		$data['title']   = "SI AMANG | Pendaftaran Tahap 4";

		//Cek Resume pendaftaran berdasarkan user_id
		$user_id = $this->session->get('id');
		$cekTahapEmpat = $this->M_pendaftaran->where('user_id', $user_id)->first();
		$bidang_id 	= $cekTahapEmpat['bidang_id'];
		$kategori_id 		= $cekTahapEmpat['kategori_id'];

		$data['resume']   = $cekTahapEmpat;

		//bidang
		$cekBidang = $this->M_bidang->where('id', $bidang_id)->first();
		$data['nama_bidang']   = $cekBidang['nama_bidang'];

		//kategori
		$cekKategori = $this->M_kategori->where('id', $kategori_id)->first();
		$data['nama_kategori']   = $cekKategori['nama_kategori'];

		//mentor

		// Menampilkan pilihan mentor berdasarkan kategori_id
		$data['mentor'] = $this->M_user->where('role_id', 2)->where('kategori_id', $kategori_id)->findAll();

		return view('v_pendaftaran/tahap_4', $data);
	}

	// Finalisasi Pendaftaran
	public function finalisasiPendaftaran()
	{
		$id = $this->request->getPost('idPendaftaran');

		//Finalisasi
		$finalisasi = [
			'tanggal_pendaftaran' => date('Y-m-d'),
			'status_pendaftaran' => "Selesai",
			'status_verifikasi'  => "Belum Verifikasi"
		];

		//Simpan Finalisasi Pendaftaran
		$this->M_pendaftaran->update($id, $finalisasi);

		$validasi = [
			'success'   => true,
			'link'   => base_url('pendaftaran/dashboard')
		];
		echo json_encode($validasi);
	}

	// Halaman dashboard peserta yang sudah melakukan pendaftaran
	public function dashboard()
	{
		$data['title']   = "SI AMANG | Dashboard Peserta";

		//Cek pendaftaran berdasarkan user_id
		$user_id = $this->session->get('id');
		$pendaftaran = $this->M_pendaftaran->where('user_id', $user_id)->first();
		$bidang_id 	= $pendaftaran['bidang_id'];
		$kategori_id 		= $pendaftaran['kategori_id'];

		$data['pendaftaran']   = $pendaftaran;

		//bidang
		$cekBidang = $this->M_bidang->where('id', $bidang_id)->first();
		$data['nama_bidang']   = $cekBidang['nama_bidang'];

		//kategori
		$cekKategori = $this->M_kategori->where('id', $kategori_id)->first();
		$data['nama_kategori']   = $cekKategori['nama_kategori'];

		// Menampilkan pilihan mentor berdasarkan kategori_id
		$data['mentor'] = $this->M_user->where('role_id', 2)->where('kategori_id', $kategori_id)->findAll();
		//Cek tanggal in	formasi pendaftaran
		$cekInfo = $this->M_informasi->first();
		$data['tgl_pengumuman'] = $cekInfo['tgl_pengumuman'];

		$data['tgl_sekarang'] = date('Y-m-d');

		return view('v_pendaftaran/dashboard', $data);
	}


	// Cetak NDE
	public function nda()
	{
		//Cetak dengan dompdf
		$dompdf = new \Dompdf\Dompdf();
		$options = new \Dompdf\Options();
		$options->setIsRemoteEnabled(true);

		$dompdf->setOptions($options);
		$dompdf->output();
		$dompdf->loadHtml(view('v_pendaftaran/nda'));
		$dompdf->setPaper('A4', 'portrait');
		$dompdf->render();
		$dompdf->stream('nda.pdf', array("Attachment" => false));
	}
	// Cetak NDE
	public function nda_login()
	{

		//Cek bukti Pendaftaran berdasarkan user_id
		$user_id = $this->session->get('id');
		$ndaLogin = $this->M_pendaftaran->where('user_id', $user_id)->first();
		$bidang_id 	= $ndaLogin['bidang_id'];
		$kategori_id 		= $ndaLogin['kategori_id'];

		$data['ndaLogin']   = $ndaLogin;

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
		$dompdf->loadHtml(view('v_pendaftaran/nda_login', $data));
		$dompdf->setPaper('A4', 'portrait');
		$dompdf->render();
		$dompdf->stream('nda.pdf', array("Attachment" => false));
	}

	// Logout
	public function logout()
	{
		$this->session->destroy();
		return redirect()->to('/');
	}
}
