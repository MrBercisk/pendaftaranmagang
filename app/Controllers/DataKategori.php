<?php namespace App\Controllers;

use App\Models\BidangModel;
use App\Models\KategoriModel;
use Config\Services;

class DataKategori extends BaseController 
{
	protected $M_bidang;
	protected $M_kategori;
	protected $request;
	protected $form_validation;
	protected $session;

	public function __construct()
	{
		$this->request = Services::request();
	  	$this->M_bidang = new BidangModel($this->request);
	  	$this->M_kategori = new KategoriModel($this->request);
		$this->form_validation =  \Config\Services::validation();
		$this->session = \Config\Services::session();
	}

	// Tombol Aksi Pada Tabel Data Kategori
	private function _action($idKategori)
	{ 
		$link = "
			<a data-toggle='tooltip' data-placement='top' class='btn-editKategori' title='Update' value='".$idKategori."'>
	      		<button type='button' class='btn btn-outline-success btn-xs' data-toggle='modal' data-target='#modalEdit'><i class='fa fa-edit'></i></button>
	      	</a>
	      
	      	<a href='".base_url('dataKategori/delete/'.$idKategori)."' class='btn-deleteKategori' data-toggle='tooltip' data-placement='top' title='Delete'>
	      		<button type='button' class='btn btn-outline-danger btn-xs'><i class='fa fa-trash'></i></button>
	      	</a>
	    ";
	    return $link;
	}

	// Halaman Data Kategori
	public function index($idBidang)
	{
		$data ['title']  = "E-Magang | Data Kategori";
		$data ['page']   = "datakategori";
		$data ['nama']   = $this->session->get('nama');
		$data ['email']   = $this->session->get('email');

		//Cek Data Bidang Berdasarkan Id Bidang
		$cekBidang = $this->M_bidang->where('id', $idBidang)->first();
		$data ['nama_bidang']   = $cekBidang['nama_bidang'];
		$data ['id_bidang'] = $cekBidang['id'];

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
		
		//Data kategori
		$data = [ 
			'bidang_id' => $bidang_id,
			'nama_kategori' => $nama_kategori
		];

		//Cek Validasi Data kategori, Jika Data Tidak Valid 
		if ($this->form_validation->run($data, 'kategori') == FALSE) {
			
			$validasi = [
				'error'   => true,
			    'nama_kategori_error' => $this->form_validation->getErrors('nama_kategori')
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
		
		//Data bidang
		$data = [ 
			'nama_kategori' => $nama_kategori
		];

		//Cek Validasi Data bidang, Jika Data Tidak Valid 
		if ($this->form_validation->run($data, 'kategori') == FALSE) {
			
			$validasi = [
				'error'   => true,
			    'nama_kategori2_error' => $this->form_validation->getErrors('nama_kategori')
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
	  
	  if($this->request->getMethod(true)=='POST')
	  {
	    $lists = $this->M_kategori->get_datatables($idBidang);
	        $data = [];
	        $no = $this->request->getPost("start");
	        foreach ($lists as $list) 
	        {
                $no++;
                $row = [];
                $row[] = $no;
                $row[] = $list->nama_kategori;
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

