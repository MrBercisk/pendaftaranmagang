<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\BidangModel;
use App\Models\JadwalModel;
use App\Models\PendaftaranModel;
use Config\Services;

class DataBidang extends BaseController
{
	protected $M_pendaftaran;
	protected $M_jadwal;
	protected $M_bidang;
	protected $request;
	protected $form_validation;
	protected $session;

	public function __construct()
	{
		$this->request = Services::request();
		$this->M_bidang = new BidangModel($this->request);
		$this->M_pendaftaran = new PendaftaranModel($this->request);
		$this->form_validation =  \Config\Services::validation();
		$this->M_jadwal = new JadwalModel($this->request);
		$this->session = \Config\Services::session();
	}

	// Tombol Aksi Pada Tabel Data Bidang
	private function _action($idBidang)
	{
		$link = "
			<a data-toggle='tooltip' data-placement='top' class='btn-editBidang' title='Update' value='" . $idBidang . "'>
	      		<button type='button' class='btn btn-outline-success btn-xs' data-toggle='modal' data-target='#modalEdit'><i class='fa fa-edit'></i></button>
	      	</a>
	      
	      	<a href='" . base_url('dataBidang/delete/' . $idBidang) . "' class='btn-deleteBidang' data-toggle='tooltip' data-placement='top' title='Delete'>
	      		<button type='button' class='btn btn-outline-danger btn-xs'><i class='fa fa-trash'></i></button>
	      	</a>
	    ";
		return $link;
	}

	// Halaman Data Bidang
	public function index()
	{
		$data['title']  = "SI AMANG | Data Bidang";
		$data['page']   = "databidang";

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
		// Add the events data to the view
		$data['events'] = $this->M_jadwal->getEvents();
		return view('v_dataBidang/index', $data);
	}

	// Add Data Bidang
	public function add()
	{

		$nama_bidang = ucwords($this->request->getPost('nama_bidang'));

		//Data bidang
		$data = [
			'nama_bidang' => $nama_bidang
		];

		//Cek Validasi Data bidang, Jika Data Tidak Valid 
		if ($this->form_validation->run($data, 'bidang') == FALSE) {

			$validasi = [
				'error'   => true,
				'nama_bidang_error' => $this->form_validation->getErrors('nama_bidang')
			];
			echo json_encode($validasi);
		}

		//Data Valid
		else {
			//Simpan Data bidang
			$this->M_bidang->save($data);

			$validasi = [
				'success'   => true
			];
			echo json_encode($validasi);
		}
	}

	// Menampilkan Data bidang Pada Modal Edit Data bidang
	public function ajaxUpdate($idBidang)
	{
		$data = $this->M_bidang->find($idBidang);
		echo json_encode($data);
	}

	// Update Data Bidang
	public function update()
	{
		$id = $this->request->getPost('idBidang');
		$nama_bidang = ucwords($this->request->getPost('nama_bidang2'));

		//Data bidang
		$data = [
			'nama_bidang' => $nama_bidang
		];

		//Cek Validasi Data bidang, Jika Data Tidak Valid 
		if ($this->form_validation->run($data, 'bidang') == FALSE) {

			$validasi = [
				'error'   => true,
				'nama_bidang_error' => $this->form_validation->getErrors('nama_bidang')
			];
			echo json_encode($validasi);
		}

		//Data Valid
		else {
			//Update Data bidang
			$this->M_bidang->update($id, $data);

			$validasi = [
				'success'   => true
			];
			echo json_encode($validasi);
		}
	}

	// Delete Data bidang
	public function delete($id)
	{
		$this->M_bidang->delete($id);
	}

	// Datatable server side
	public function ajaxDataBidang()
	{

		if ($this->request->getMethod(true) == 'POST') {
			$lists = $this->M_bidang->get_datatables();
			$data = [];
			$no = $this->request->getPost("start");
			foreach ($lists as $list) {
				$no++;
				$row = [];
				$row[] = $no;
				$row[] = $list->nama_bidang;
				$row[] = $this->_action($list->id);
				$data[] = $row;
			}
			$output = [
				"draw" 				=> $this->request->getPost('draw'),
				"recordsTotal" 		=> $this->M_bidang->count_all(),
				"recordsFiltered" 	=> $this->M_bidang->count_filtered(),
				"data" 				=> $data
			];
			echo json_encode($output);
		}
	}
}
