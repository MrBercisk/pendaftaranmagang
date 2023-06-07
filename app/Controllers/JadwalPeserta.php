<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\PendaftaranModel;
use App\Models\BidangModel;
use App\Models\KategoriModel;
use App\Models\MentorModel;
use App\Models\JadwalModel;
use Config\Services;

class JadwalPeserta extends BaseController
{
    protected $encrypter;
    protected $form_validation;
    protected $M_user;
    protected $M_pendaftaran;
    protected $M_bidang;
    protected $M_kategori;
    protected $M_mentor;
    protected $M_jadwal;
    protected $session;

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
        $this->M_mentor = new MentorModel($this->request);
        $this->M_jadwal = new JadwalModel($this->request);
        $this->session = \Config\Services::session();
    }
    // Tombol Aksi Pada Tabel Data Jadwal
    private function _action($idJadwal)
    {
        $link = "
			<a data-toggle='tooltip' data-placement='top' class='btn-editBidang' title='Update' value='" . $idJadwal . "'>
	      		<button type='button' class='btn btn-outline-success btn-xs' data-toggle='modal' data-target='#modalEdit'><i class='fa fa-edit'></i></button>
	      	</a>
	      
	      	<a href='" . base_url('jadwalPeserta/delete/' . $idJadwal) . "' class='btn-deleteJadwal' data-toggle='tooltip' data-placement='top' title='Delete'>
	      		<button type='button' class='btn btn-outline-danger btn-xs'><i class='fa fa-trash'></i></button>
	      	</a>
	      	
          
            ";
        return $link;
    }

    public function index()
    {
        $data['title'] = "SI AMANG | Jadwal Peserta";
        $data['page'] = "jadwalpeserta";

        // periksa apakah session masih ada atau tidak
        if (!$this->session->has('nama') || !$this->session->has('email')) {
            return redirect()->to('/login');
        }

        $data['nama'] = $this->session->get('nama');
        $data['email'] = $this->session->get('email');

        // Ambil data pendaftaran yang terbaru dan belum diterima
        $data['tbl_pendaftaran'] = $this->M_pendaftaran->where('status_verifikasi', 'Belum Verifikasi')
            ->orderBy('created_at', 'DESC')
            ->findAll();
        $data['jumlah_pendaftaran'] = count($data['tbl_pendaftaran']);

        // Ambil data peserta yang sudah diterima
        $pesertaModel = new PendaftaranModel($this->request);
        $data['peserta'] = $pesertaModel->where('status_verifikasi', 'Diterima')->select('id, nama_peserta, kategori_id')->findAll();

        // Ambil data mentor yang sudah diterima
        $mentorModel = new UserModel($this->request);
        $data['mentor'] = $mentorModel->where('role_id', 2)->select('id, nama, kategori_id')->findAll();

        // Check if a peserta is selected
        if ($this->request->getPost('nama_peserta')) {
            $selected_peserta_id = $this->request->getPost('nama_peserta');
            $selected_peserta = $pesertaModel->find($selected_peserta_id);

            // Filter the mentors based on the selected peserta's kategori_id
            $selected_kategori_id = $selected_peserta['kategori_id'];
            $data['mentor'] = $mentorModel->where('role_id', 2)->where('kategori_id', $selected_kategori_id)->select('id, nama, kategori_id')->findAll();
        }

        // Add the events data to the view
        $data['events'] = $this->M_jadwal->getEvents();
        // Add the pendaftaran data to the view
        $tbl_pendaftaran = $data['tbl_pendaftaran'];
        $pendaftaran = !empty($tbl_pendaftaran) ? $this->M_pendaftaran->find($tbl_pendaftaran[0]['id']) : null;
        $data['pendaftaran'] = $pendaftaran;


        return view('v_jadwal/index', $data);
    }

    public function add()
    {
        $id = $this->request->getPost('pendaftaran_id');
        $nama_peserta = $this->request->getPost('nama_peserta');
        $tanggal_bimbingan = $this->request->getPost('tanggal_bimbingan');
        $jam_bimbingan = $this->request->getPost('jam_bimbingan');

        // Modify the format of the jam_bimbingan field to 24-hour format and remove seconds
        $jam_bimbingan = date('H:i', strtotime($jam_bimbingan));

        // Check if data with the same pendaftaran_id already exists in tbl_jadwal
        $dataExists = $this->M_jadwal->checkExistData($id, $nama_peserta);

        if ($dataExists) {
            $tanggal_mulai = $dataExists->tanggal_mulai;
            $tanggal_selesai = $dataExists->tanggal_selesai;
        } else {
            $tanggal_mulai = $this->request->getPost('tanggal_mulai');
            $tanggal_selesai = $this->request->getPost('tanggal_selesai');
        }

        $data = [
            'pendaftaran_id' => $id,
            'nama_peserta' => $nama_peserta,
            'tanggal_mulai' => $tanggal_mulai,
            'tanggal_selesai' => $tanggal_selesai,
            'tanggal_bimbingan' => $tanggal_bimbingan,
            'jam_bimbingan' => $jam_bimbingan
        ];

        if ($this->form_validation->run($data, 'jadwal') == FALSE) {
            $validasi = [
                'error' => true,
                'jadwal_error' => $this->form_validation->getErrors()
            ];
            echo json_encode($validasi);
        } else {
            $this->M_jadwal->save($data);

            $validasi = [
                'success' => true,
                'link' => base_url('jadwalpeserta')
            ];
            echo json_encode($validasi);
        }
    }


    // Delete Data 
    public function delete($id)
    {
        $this->M_jadwal->delete($id);
    }
    // Datatable server side
    public function ajaxDataJadwal()
    {

        if ($this->request->getMethod(true) == 'POST') {
            $lists = $this->M_jadwal->get_datatables();
            $data = [];
            $no = $this->request->getPost("start");
            foreach ($lists as $list) {
                $no++;
                $row = [];
                $row[] = $no;
                $row[] = $list->nama_peserta;
                $row[] = tgl_indonesia($list->tanggal_mulai);
                $row[] = tgl_indonesia($list->tanggal_selesai);
                $row[] = $this->_action($list->id, $list->status_verifikasi);
                $data[] = $row;
            }
            $output = [
                "draw"                 => $this->request->getPost('draw'),
                "recordsTotal"         => $this->M_pendaftaran->count_all(),
                "recordsFiltered"     => $this->M_pendaftaran->count_filtered(),
                "data"                 => $data
            ];
            echo json_encode($output);
        }
    }
}
