<?php

namespace App\Controllers;

use App\Models\BidangModel;
use App\Models\MentorModel;
use Config\Services;

class DataMentor extends BaseController
{
	protected $M_bidang;
	protected $M_mentor;
	protected $request;
	protected $form_validation;
	protected $session;

	public function __construct()
	{
		$this->request = Services::request();
		$this->M_bidang = new BidangModel($this->request);
		$this->M_mentor = new MentorModel($this->request);
		$this->form_validation =  \Config\Services::validation();
		$this->session = \Config\Services::session();
	}

	// Tombol Aksi Pada Tabel Data Mentor
	private function _action($idMentor)
	{
		$link = "
			<a data-toggle='tooltip' data-placement='top' class='btn-editMentor' title='Update' value='" . $idMentor . "'>
	      		<button type='button' class='btn btn-outline-success btn-xs' data-toggle='modal' data-target='#modalEdit'><i class='fa fa-edit'></i></button>
	      	</a>
	      
	      	<a href='" . base_url('dataMentor/delete/' . $idMentor) . "' class='btn-deleteMentor' data-toggle='tooltip' data-placement='top' title='Delete'>
	      		<button type='button' class='btn btn-outline-danger btn-xs'><i class='fa fa-trash'></i></button>
	      	</a>
	    ";
		return $link;
	}

	// Halaman Data Mentor
	public function index($idBidang)
	{
		$data['title']  = "E-Magang | Data Mentor";
		$data['page']   = "datamentor";
		$data['nama']   = $this->session->get('nama');
		$data['email']   = $this->session->get('email');


		//Cek Data Bidang Berdasarkan Id Bidang
		$cekBidang = $this->M_bidang->where('id', $idBidang)->first();
		$data['nama_bidang']   = $cekBidang['nama_bidang'];
		$data['id_bidang'] = $cekBidang['id'];

		//Jika Data Bidang ada
		if ($cekBidang) {
			return view('v_dataMentor/index', $data);
		} else {
			return view('v_dataMentor/error', $data);
		}
	}

	// Add Data Mentor
	public function add()
	{
		$bidang_id = $this->request->getPost('bidang_id');
		$nama_mentor = ucwords($this->request->getPost('nama_mentor'));


		//Data Bidang
		$data = [
			'bidang_id' => $bidang_id,
			'nama_mentor' => $nama_mentor
		];

		//Cek Validasi Data Mentor, Jika Data Tidak Valid 
		if ($this->form_validation->run($data, 'mentor') == FALSE) {

			$validasi = [
				'error'   => true,
				'nama_mentor_error' => $this->form_validation->getErrors('nama_mentor'),
			];
			echo json_encode($validasi);
		}

		//Data Valid
		else {
			//Simpan Data Mentor
			$this->M_mentor->save($data);

			$validasi = [
				'success'   => true
			];
			echo json_encode($validasi);
		}
	}

	// Menampilkan Data Mentor Pada Modal Edit Data Mentor
	public function ajaxUpdate($idMentor)
	{
		$data = $this->M_mentor->find($idMentor);
		echo json_encode($data);
	}

	// Delete Data mentor
	public function delete($id)
	{
		$this->M_mentor->delete($id);
	}

	// Update Data Mentor
	public function update()
	{
		$id = $this->request->getPost('idMentor');
		$nama_mentor = ucwords($this->request->getPost('nama_mentor2'));

		//Data bidang
		$data = [
			'nama_mentor' => $nama_mentor,

		];

		//Cek Validasi Data bidang, Jika Data Tidak Valid 
		if ($this->form_validation->run($data, 'mentor') == FALSE) {

			$validasi = [
				'error'   => true,
				'nama_mentor2_error' => $this->form_validation->getErrors('nama_mentor'),
			];
			echo json_encode($validasi);
		}

		//Data Valid
		else {
			//Update Data bidang
			$this->M_mentor->update($id, $data);

			$validasi = [
				'success'   => true
			];
			echo json_encode($validasi);
		}
	}
	// Datatable server side
	public function ajaxDataMentor($idBidang)
	{

		if ($this->request->getMethod(true) == 'POST') {
			$lists = $this->M_mentor->get_datatables($idBidang);
			$data = [];
			$no = $this->request->getPost("start");
			foreach ($lists as $list) {
				$no++;
				$row = [];
				$row[] = $no;
				$row[] = $list->nama_mentor;
				$row[] = $this->_action($list->id);
				$data[] = $row;
			}
			$output = [
				"draw" 				=> $this->request->getPost('draw'),
				"recordsTotal" 		=> $this->M_mentor->count_all($idBidang),
				"recordsFiltered" 	=> $this->M_mentor->count_filtered($idBidang),
				"data" 				=> $data
			];
			echo json_encode($output);
		}
	}
}
