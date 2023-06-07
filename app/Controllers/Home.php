<?php

namespace App\Controllers;

use App\Models\InformasiModel;
use App\Models\KategoriModel;
use App\Models\PendaftaranModel;
use Config\Services;

class Home extends BaseController
{
	protected $M_informasi;
	protected $M_kategori;
	protected $M_pendaftaran;
	protected $request;

	public function __construct()
	{
		date_default_timezone_set('Asia/Jakarta');
		$this->request = Services::request();
		$this->M_informasi = new InformasiModel($this->request);
		$this->M_kategori = new KategoriModel($this->request);
		$this->M_pendaftaran = new PendaftaranModel($this->request);
	}

	// Halaman utama aplikasi
	public function index()
	{
		$data['title']   = "SI AMANG | Sistem Informasi Aplikasi Magang";
		$data['tanggal'] = $this->M_informasi->first();
		$data['tanggal'] = $this->M_informasi->first();
		$data['kategori'] = $this->M_kategori->getKategori();
		$data['pendaftaran'] = $this->M_pendaftaran->where('status_verifikasi', 'Diterima')
		->orderBy('created_at', 'DESC')
		->findAll();

		return view('v_home/index', $data);
	}
}
