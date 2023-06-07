<?php

namespace App\Controllers;

use App\Models\PendaftaranModel;
use App\Models\BidangModel;
use App\Models\KategoriModel;
use App\Models\MentorModel;
use App\Models\JadwalModel;
use Config\Services;

class Dashboard extends BaseController
{
	protected $session;
	protected $M_pendaftaran;
	protected $M_bidang;
	protected $M_kategori;
	protected $M_mentor;
	protected $M_jadwal;
	protected $request;


	public function __construct()
	{
		$this->session = \Config\Services::session();
		$this->request = Services::request();
		$this->M_pendaftaran = new PendaftaranModel($this->request);
		$this->M_bidang = new BidangModel($this->request);
		$this->M_kategori = new KategoriModel($this->request);
		$this->M_mentor = new MentorModel($this->request);
		$this->M_kategori = new KategoriModel($this->request);
		$this->M_jadwal = new JadwalModel($this->request);
	}

	
	public function index()
	{
		$data['title']  = "SI AMANG | Dashboard";
		$data['page']   = "dashboard";

		// Siapkan kategori kampus yang akan ditampilkan
		// $categories = ['UBSI', 'UGM', 'UNY', 'UMY', 'UAD', 'UPN', 'STPMD', 'AMIKOM'];

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
		// var_dump($labels);
		// var_dump($jumlah);
		// die();

		// periksa apakah session masih ada atau tidak
		if (!$this->session->has('nama') || !$this->session->has('email')) {
			return redirect()->to('/login');
		}

		$data['nama']   = $this->session->get('nama');
		$data['email']   = $this->session->get('email');

		// Ambil data pendaftaran yang terbaru dan belum diterima
		$data['tbl_pendaftaran'] = $this->M_pendaftaran->where('status_verifikasi', 'Belum Verifikasi')
			->orderBy('created_at', 'DESC')
			->findAll();
		$data['jumlah_pendaftaran'] = count($data['tbl_pendaftaran']);
		$data['events'] = $this->M_jadwal->getEvents();

		// var_dump($data);
		// die();

		return view('v_dashboard/index', $data);
	}
	

	// Logout
	public function logout()
	{
		$this->session->destroy();
		return redirect()->to('/');
	}
}
