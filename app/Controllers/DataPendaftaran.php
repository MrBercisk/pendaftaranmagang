<?php namespace App\Controllers;

use App\Models\PendaftaranModel;
use App\Models\BidangModel;
use App\Models\KategoriModel;
use Config\Services;

class DataPendaftaran extends BaseController
{
	protected $session;
	protected $M_pendaftaran;
	protected $M_bidang;
	protected $M_kategori;
	protected $request;

	public function __construct()
	{
		$this->request = Services::request();
		$this->M_pendaftaran = new PendaftaranModel($this->request);
		$this->M_bidang = new BidangModel($this->request);
		$this->M_kategori = new KategoriModel($this->request);
		$this->session = \Config\Services::session();
	}

	// Tombol Aksi Pada Tabel Data Pendaftaran
	private function _action($idPendaftaran, $statusVerifikasi)
	{
		if ($statusVerifikasi == "Lulus" || $statusVerifikasi == "Tidak Lulus") {
		 	$link = "
		      	<a href='".base_url('datapendaftaran/view/'.$idPendaftaran)."' class='btn-viewPendaftaran' data-toggle='tooltip' data-placement='top' title='View'>
		      		<button type='button' class='btn btn-outline-primary btn-xs'><i class='far fa-eye'></i></button>
		      	</a>
		    ";
		    return $link;
		} 
		else {
		 	$link = "
		      	<a href='".base_url('datapendaftaran/view/'.$idPendaftaran)."' class='btn-viewPendaftaran' data-toggle='tooltip' data-placement='top' title='View'>
		      		<button type='button' class='btn btn-outline-primary btn-xs'><i class='far fa-eye'></i></button>
		      	</a>

		      	<a href='".base_url('datapendaftaran/lulus/'.$idPendaftaran)."' class='btn-lulusPendaftaran' data-toggle='tooltip' data-placement='top' title='Lulus'>
		      		<button type='button' class='btn btn-outline-success btn-xs'><i class='fas fa-check'></i></button>
		      	</a>

		      	<a href='".base_url('datapendaftaran/tidaklulus/'.$idPendaftaran)."' class='btn-tidakLulusPendaftaran' data-toggle='tooltip' data-placement='top' title='Tidak Lulus'>
		      		<button type='button' class='btn btn-outline-danger btn-xs'><i class='fas fa-times'></i></button>
		      	</a>
		    ";
		    return $link;
		}
		  	
	}

	// Halaman Data Pendaftaran
	public function index()
	{
		$data ['title']   = "E-Magang | Data Pendaftaran";
		$data ['page']    = "datapendaftaran";
		$data ['nama']   = $this->session->get('nama');
		$data ['email']   = $this->session->get('email');
		return view('v_dataPendaftaran/index', $data);
	}

	// Halaman View Pendaftaran
	public function view($id)
	{
		$data ['title']   = "E-Magang | View Data Pendaftaran";
		$data ['page']    = "datapendaftaran";
		$data ['nama']   = $this->session->get('nama');
		$data ['email']   = $this->session->get('email');

		//Cek pendaftaran berdasarkan id pendaftaran
		$cekPendaftaran = $this->M_pendaftaran->where('id', $id)->first();
		$status_pendaftaran = $cekPendaftaran['status_pendaftaran'];
		$bidang_id 	= $cekPendaftaran['bidang_id'];
		$kategori_id 		= $cekPendaftaran['kategori_id'];
		
		//Jika Data pendaftaran ada
		if ($cekPendaftaran) {
			//Jika pendaftaran sudah selesai
			if ($status_pendaftaran == "Selesai") {
				$data ['pendaftaran'] = $cekPendaftaran;

				//bidang
				$cekBidang = $this->M_bidang->where('id', $bidang_id)->first();
				$data ['nama_bidang']   = $cekBidang['nama_bidang'];

				//Kategori
				$cekKategori = $this->M_kategori->where('id', $kategori_id)->first();
				$data ['nama_kategori']   = $cekKategori['nama_kategori'];

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

	// Lulus 
	public function lulus($id)
	{
		//Data pendaftaran
		$data = [ 
			'status_verifikasi' => "Lulus"
		];

		//Update Data pendaftaran
		$this->M_pendaftaran->update($id, $data);
	}

	// Tidak Lulus
	public function tidakLulus($id)
	{
		//Data pendaftaran
		$data = [ 
			'status_verifikasi' => "Tidak Lulus"
		];

		//Update Data pendaftaran
		$this->M_pendaftaran->update($id, $data);
	}

	// Datatable server side
	public function ajaxDataPendaftaran()
	{
	  
	  if($this->request->getMethod(true)=='POST')
	  {
	    $lists = $this->M_pendaftaran->get_datatables();
	        $data = [];
	        $no = $this->request->getPost("start");
	        foreach ($lists as $list) 
	        {
                $no++;
                $row = [];
                $row[] = $no;
                $row[] = $list->nomor_pendaftaran;
                $row[] = $list->nama_peserta;
                $row[] = $list->nama_kategori;
                $row[] = tgl_indonesia($list->tanggal_pendaftaran);
                $row[] = $list->status_verifikasi;
                $row[] = $this->_action($list->id, $list->status_verifikasi);
                $data[] = $row;
	    	}
	    $output = [
	    	"draw" 				=> $this->request->getPost('draw'),
	        "recordsTotal" 		=> $this->M_pendaftaran->count_all(),
            "recordsFiltered" 	=> $this->M_pendaftaran->count_filtered(),
            "data" 				=> $data
        	];
	    echo json_encode($output);
	  }
	}
}


