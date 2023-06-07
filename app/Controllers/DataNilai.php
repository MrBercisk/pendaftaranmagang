<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\PendaftaranModel;
use App\Models\BidangModel;
use App\Models\KategoriModel;
use App\Models\MentorModel;
use App\Models\LaporanModel;
use App\Models\DataLaporanModel;
use App\Models\JadwalModel;
use App\Models\NilaiModel;
use Config\Services;

class DataNilai extends BaseController
{
    protected $encrypter;
    protected $form_validation;
    protected $M_user;
    protected $M_pendaftaran;
    protected $M_bidang;
    protected $M_kategori;
    protected $M_mentor;
    protected $M_jadwal;
    protected $M_datalaporan;
    protected $M_laporan;
    protected $M_nilai;
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
        $this->M_nilai = new NilaiModel($this->request);
        $this->M_datalaporan = new DataLaporanModel($this->request);
        $this->session = \Config\Services::session();
    }

    public function index()
    {
        $data['title'] = "SI AMANG | Nilai Peserta";
        $data['page'] = "datanilai";

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

        // Ambil data peserta yang sudah diterima dan memiliki kategori_id yang sesuai dengan user yang login
        $laporanModel = new LaporanModel($this->request);
        $userModel = new UserModel($this->request);
        $user_id = $userModel->where('email', $this->session->get('email'))->first()['id'];
        $data['laporan'] = $laporanModel->select('tbl_laporan.id, tbl_pendaftaran.id, tbl_pendaftaran.nama_peserta')
            ->where('status_verifikasi', 'Diterima')
            ->join('tbl_pendaftaran', 'tbl_pendaftaran.user_id = tbl_laporan.user_id')
            ->where('tbl_pendaftaran.kategori_id', $userModel->find($user_id)['kategori_id'])
            ->findAll();


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


        return view('v_dataNilai/index', $data);
    }
    // Delete Data 
    public function delete($id)
    {
        $this->M_nilai->delete($id);
    }
    public function ajaxDataNilai()
    {
        if ($this->request->getMethod(true) == 'POST') {
            $lists = $this->M_nilai->get_datatables(); // tambahkan parameter user_id
            $data = [];
            $no = $this->request->getPost("start");
            foreach ($lists as $list) {
                $no++;
                $row = [];
                $row[] = $no;
                $row[] = $list->nama_peserta;
                $row[] = $list->nama_kampus;
                $row[] = $list->ketepatan_waktu;
                $row[] = $list->kehadiran;
                $row[] = $list->kemampuan_kerja;
                $row[] = $list->kualitas_kerja;
                $row[] = $list->kerjasama;
                $row[] = $list->inisiatif;
                $row[] = $list->rasa_percaya;
                $row[] = $list->penampilan;
                $row[] = $list->patuh_aturan_pkl;
                $row[] = $list->tanggung_jawab;
                $row[] = $list->rata_rata;
                $data[] = $row;
            }
            $recordsFiltered = $this->M_nilai->count_filtered();
            $output = [
                "draw" => $this->request->getPost('draw'),
                "recordsTotal" => $recordsFiltered,
                "recordsFiltered" => $recordsFiltered,
                "data" => $data
            ];
            echo json_encode($output);
        }
    }
}
