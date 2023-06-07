<?php

namespace App\Controllers;

use App\Models\BidangModel;
use App\Models\KategoriModel;
use App\Models\PendaftaranModel;
use App\Models\JadwalModel;
use App\Models\UserModel;
use Config\Services;

class DataKategori extends BaseController
{
	protected $M_bidang;
	protected $M_kategori;
	protected $M_pendaftaran;
	protected $M_jadwal;
	protected $M_user;
	protected $request;
	protected $form_validation;
	protected $session;

	public function __construct()
	{
		$this->request = Services::request();
		$this->M_bidang = new BidangModel($this->request);
		$this->M_kategori = new KategoriModel($this->request);
		$this->M_pendaftaran = new PendaftaranModel($this->request);
		$this->M_user = new UserModel($this->request);
		$this->M_jadwal = new JadwalModel($this->request);
		$this->form_validation =  \Config\Services::validation();
		$this->session = \Config\Services::session();
	}

	// Tombol Aksi Pada Tabel Data Kategori
	private function _action($idKategori)
	{
		$link = "
			<a data-toggle='tooltip' data-placement='top' class='btn-editKategori' title='Update' value='" . $idKategori . "'>
	      		<button type='button' class='btn btn-outline-success btn-xs' data-toggle='modal' data-target='#modalEdit'><i class='fa fa-edit'></i></button>
	      	</a>
	      
	      	<a href='" . base_url('dataKategori/delete/' . $idKategori) . "' class='btn-deleteKategori' data-toggle='tooltip' data-placement='top' title='Delete'>
	      		<button type='button' class='btn btn-outline-danger btn-xs'><i class='fa fa-trash'></i></button>
	      	</a>
	    ";
		return $link;
	}

	// Halaman Data Kategori
	public function index($idBidang)
	{
		$data['title']  = "SI AMANG | Data Kategori";
		$data['page']   = "datakategori";

		// periksa apakah session masih ada atau tidak
		if (!$this->session->has('nama') || !$this->session->has('email')) {
			return redirect()->to('/login');
		}
		$data['nama']   = $this->session->get('nama');
		$data['email']   = $this->session->get('email');

		$data['tbl_pendaftaran'] = $this->M_pendaftaran->where('status_verifikasi', 'Belum Verifikasi')
			->orderBy('created_at', 'DESC')
			->findAll();
		$data['jumlah_pendaftaran'] = count($data['tbl_pendaftaran']);

		//Cek Data Bidang Berdasarkan Id Bidang
		$cekBidang = $this->M_bidang->where('id', $idBidang)->first();
		$data['nama_bidang']   = $cekBidang['nama_bidang'];
		$data['id_bidang'] = $cekBidang['id'];

		$data['events'] = $this->M_jadwal->getEvents();

		//Jika Data Bidang ada
		if ($cekBidang) {
			return view('v_dataKategori/index', $data);
		} else {
			return view('v_dataKategori/error', $data);
		}
	}

	// Add Data Kategori
	public function add()
	{
		$bidang_id = $this->request->getPost('bidang_id');
		$nama_kategori = ucwords($this->request->getPost('nama_kategori'));
		$syarat = ucwords($this->request->getPost('syarat'));
		$tugas = ucwords($this->request->getPost('tugas'));
		$fitur = ucwords($this->request->getPost('fitur'));

		//Data kategori
		$data = [
			'bidang_id' => $bidang_id,
			'nama_kategori' => $nama_kategori,
			'syarat' => $syarat,
			'tugas' => $tugas,
			'fitur' => $fitur
		];

		//Cek Validasi Data kategori, Jika Data Tidak Valid 
		if ($this->form_validation->run($data, 'kategori') == FALSE) {

			$validasi = [
				'error'   => true,
				'nama_kategori_error' => $this->form_validation->getErrors('nama_kategori'),
				'syarat_error' => $this->form_validation->getErrors('syarat'),
				'tugas_error' => $this->form_validation->getErrors('tugas'),
				'fitur_error' => $this->form_validation->getErrors('fitur'),
			];
			echo json_encode($validasi);
		}

		//Data Valid
		else {
			//Simpan Data kategori
			$this->M_kategori->save($data);

			$validasi = [
				'success'   => true
			];
			echo json_encode($validasi);
		}
	}

	// Menampilkan Data kategori Pada Modal Edit Data kategori
	public function ajaxUpdate($idKategori)
	{
		$data = $this->M_kategori->find($idKategori);
		echo json_encode($data);
	}

	// Update Data Kategori
	public function update()
	{
		$id = $this->request->getPost('idKategori');
		$nama_kategori = ucwords($this->request->getPost('nama_kategori2'));
		$syarat = ucwords($this->request->getPost('syarat2'));
		$tugas = ucwords($this->request->getPost('tugas2'));
		$fitur = ucwords($this->request->getPost('fitur2'));

		//Data bidang
		$data = [
			'nama_kategori' => $nama_kategori,
			'syarat' => $syarat,
			'tugas' => $tugas,
			'fitur' => $fitur,
		];

		//Cek Validasi Data bidang, Jika Data Tidak Valid 
		if ($this->form_validation->run($data, 'kategori') == FALSE) {

			$validasi = [
				'error'   => true,
				'nama_kategori2_error' => $this->form_validation->getErrors('nama_kategori'),
				'syarat2_error' => $this->form_validation->getErrors('syarat'),
				'tugas2_error' => $this->form_validation->getErrors('tugas'),
				'fitur2_error' => $this->form_validation->getErrors('fitur')
			];
			echo json_encode($validasi);
		}

		//Data Valid
		else {
			//Update Data bidang
			$this->M_kategori->update($id, $data);

			$validasi = [
				'success'   => true
			];
			echo json_encode($validasi);
		}
	}

	// Delete Data kategori
	public function delete($id)
	{
		$this->M_kategori->delete($id);
	}

	// Datatable server side
	public function ajaxDataKategori($idBidang)
	{

		if ($this->request->getMethod(true) == 'POST') {
			$lists = $this->M_kategori->get_datatables($idBidang);
			$data = [];
			$no = $this->request->getPost("start");
			foreach ($lists as $list) {
				$no++;
				$row = [];
				$row[] = $no;
				$row[] = $list->nama_kategori;
				$row[] = $list->syarat;
				$row[] = $list->tugas;
				$row[] = $list->fitur;
				$row[] = $this->_action($list->id);
				$data[] = $row;
			}
			$output = [
				"draw" 				=> $this->request->getPost('draw'),
				"recordsTotal" 		=> $this->M_kategori->count_all($idBidang),
				"recordsFiltered" 	=> $this->M_kategori->count_filtered($idBidang),
				"data" 				=> $data
			];
			echo json_encode($output);
		}
	}
}
