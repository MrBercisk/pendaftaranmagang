<?php

namespace App\Controllers;

use App\Models\KampusModel;
use Config\Services;
use App\Models\JadwalModel;
use App\Models\PendaftaranModel;

class Kampus extends BaseController
{
    protected $session;
    protected $M_jadwal;
    protected $M_kampus;
    protected $request;
    protected $form_validation;
    protected $M_Pendaftaran;

    public function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
        $this->request = Services::request();
        $this->M_jadwal = new JadwalModel($this->request);
        $this->M_kampus = new KampusModel();
        $this->form_validation =  \Config\Services::validation();
        $this->session = \Config\Services::session();
        $this->M_Pendaftaran = new PendaftaranModel($this->request);
    }
    // Tombol Aksi Pada Tabel Data Kampus
	private function _action($idKampus)
	{
		$link = "
	      
	      	<a href='" . base_url('kampus/delete/' . $idKampus) . "' class='btn-deleteKampus' data-toggle='tooltip' data-placement='top' title='Delete'>
	      		<button type='button' class='btn btn-outline-danger btn-xs'><i class='fa fa-trash'></i></button>
	      	</a>
	    ";
		return $link;
	}
    public function index()
    {
        $data['title']   = "SI AMANG | Tambah Kampus";
        $data['page']   = "kampus";

        // periksa apakah session masih ada atau tidak
        if (!$this->session->has('nama') || !$this->session->has('email')) {
            return redirect()->to('/login');
        }

        $data['nama']   = $this->session->get('nama');
        $data['email']   = $this->session->get('email');

        // Ambil data pendaftaran yang terbaru dan belum diterima
        $data['tbl_pendaftaran'] = $this->M_Pendaftaran->where('status_verifikasi', 'Belum Verifikasi')
            ->orderBy('created_at', 'DESC')
            ->findAll();
        $data['jumlah_pendaftaran'] = count($data['tbl_pendaftaran']);
        $data['events'] = $this->M_jadwal->getEvents();

        return view('v_kampus/index', $data);
    }

    public function tambah()
    {
        $data = [];

        if ($this->request->getMethod() === 'post') {
            $model = new KampusModel();

            $data = [
                'nama_kampus' => $this->request->getVar('nama_kampus')
            ];

            $model->tambah_data_kampus($data);
            session()->setFlashdata('success', 'Data berhasil ditambahkan.');
            return redirect()->to('/kampus');
        }
        return view('v_kampus/index', $data);
    }
    // Datatable server side
	public function ajaxDataKampus()
	{

		if ($this->request->getMethod(true) == 'POST') {
			$lists = $this->M_kampus->get_datatables();
			$data = [];
			$no = $this->request->getPost("start");
			foreach ($lists as $list) {
				$no++;
				$row = [];
				$row[] = $no;
				$row[] = $list->nama_kampus;
                $row[] = $this->_action($list->id);
				$data[] = $row;
			}
			$output = [
				"draw"              => $this->request->getPost('draw'),
				"recordsTotal"      => $this->M_kampus->count_all(),
				"recordsFiltered"   => $this->M_kampus->count_filtered(),
				"data"              => $data
			];
			echo json_encode($output);
		}
	}
    // Delete Data kampus
    public function delete($id)
    {
        $this->M_kampus->delete($id);
    }
}