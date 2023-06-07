<?php

namespace App\Controllers;

use App\Models\BidangModel;
use App\Models\KategoriModel;
use App\Models\UserModel;
use App\Models\JadwalModel;
use App\Models\PendaftaranModel;
use CodeIgniter\API\ResponseTrait;
use Config\Services;

class DataMentor extends BaseController
{
    protected $request;
    protected $form_validation;
    protected $session;
    protected $M_pendaftaran;
    protected $M_bidang;
    protected $M_kategori;
    protected $M_jadwal;
    protected $M_user;
    protected $encrypter;
    use ResponseTrait;


    public function __construct()
    {
        $this->M_pendaftaran = new PendaftaranModel($this->request);
        $this->M_bidang = new BidangModel($this->request);
        $this->M_jadwal = new JadwalModel($this->request);
        $this->M_kategori = new KategoriModel($this->request);
        $this->M_user = new UserModel($this->request);
        $this->request = Services::request();
        $this->form_validation =  \Config\Services::validation();
        $this->session = \Config\Services::session();
        $this->encrypter = \Config\Services::encrypter();
    }


    public function index()
    {
        $data['title'] = 'Data Mentor';
        $data['page'] = "datamentor";
        $data['bidang']   = $this->M_bidang->findAll();
        // periksa apakah session masih ada atau tidak
        if (!$this->session->has('nama') || !$this->session->has('email')) {
            return redirect()->to('/login');
        }
        $data['nama']   = $this->session->get('nama');
        $data['email']   = $this->session->get('email');
        $mentor_id = $this->session->get('id');
        $cekMentor = $this->M_user->where('id', $mentor_id)->first();

        $bidang_id = $cekMentor['bidang_id'];
        $kategori_id = $cekMentor['kategori_id'];
        //Jika $bidang_id == 0 dan $kategori_id == 0
        if ($bidang_id == 0 && $kategori_id == 0) {
            $data['IdBidang']   = "";
            $data['nama_bidang']   = "--Bidang--";
            $data['IdKategori']   = "";
            $data['nama_kategori']   = "--Kategori--";
        }
        //Dan jika tidak 
        else {
            //Bidang
            $data['IdBidang']   = $bidang_id;
            $cekBidang = $this->M_bidang->where('id', $bidang_id)->first();
            $data['nama_bidang']   = $cekBidang['nama_bidang'];
            //Kategori
            $data['IdKategori']   = $kategori_id;
            $cekKategori = $this->M_kategori->where('id', $kategori_id)->first();
            $data['nama_kategori']   = $cekKategori['nama_kategori'];
        }

        $data['tbl_pendaftaran'] = $this->M_pendaftaran->where('status_verifikasi', 'Belum Verifikasi')
            ->orderBy('created_at', 'DESC')
            ->findAll();
        $data['jumlah_pendaftaran'] = count($data['tbl_pendaftaran']);
        $data['events'] = $this->M_jadwal->getEvents();
        return view('v_dataMentor/index', $data);
    }

    public function ajaxDataMentor()
    {
        if ($this->request->getMethod(true) == 'POST') {
            $lists = $this->M_user->get_datatables();
            $data = [];
            $no = $this->request->getPost("start");
            foreach ($lists as $list) {
                $no++;
                $row = [];
                $row[] = $no;
                $row[] = $list->nama;
                $row[] = $list->email;
                $row[] = $list->role;
                $row[] = $list->nama_kategori;
                $row[] = $list->created_at;
                $row[] = $this->_action($list->id);
                $data[] = $row;
            }
            $output = [
                "draw" => $this->request->getPost('draw'),
                "recordsTotal" => $this->M_user->count_all(),
                "recordsFiltered" => $this->M_user->count_filtered(false),
                "data" => $data
            ];
            echo json_encode($output);
        }
    }

    private function _action($idMentor)
    {
        $link = "
       
        <a href='" . base_url('dataMentor/ubah/' . $idMentor) . "' class='btn-ubahMentor' data-toggle='tooltip' data-placement='top' title='Ubah Mentor'>
        <button type='button' class='btn btn-outline-warning btn-xs'><i class='fas fa-edit'></i></button>
      </a>
          <a href='" . base_url('dataMentor/delete/' . $idMentor) . "' class='btn-deleteMentor' data-toggle='tooltip' data-placement='top' title='Delete'>
              <button type='button' class='btn btn-outline-danger btn-xs'><i class='fa fa-trash'></i></button>
          </a>
          
    ";
        return $link;
    }


    // Delete Data bidang
    public function delete($id)
    {
        $this->M_user->delete($id);
    }

    public function ubah($id)
    {
        $data['title']   = "SI AMANG | Ubah Data Mentor";
        $data['page']    = "ubahmentor";
        $data['nama']    = $this->session->get('nama');
        $data['email']   = $this->session->get('email');
        $data['bidang'] = $this->M_bidang->findAll();

        // Ambil data pendaftaran yang terbaru dan belum diterima
        $data['tbl_pendaftaran'] = $this->M_pendaftaran->where('status_verifikasi', 'Diterima')
            ->orderBy('created_at', 'DESC')
            ->findAll();
        $data['jumlah_pendaftaran'] = count($data['tbl_pendaftaran']);
        $data['events'] = $this->M_jadwal->getEvents();
        $data['mentor'] = $this->M_user->find($id);
        $user_id = $this->session->get('id');
        $cekMentor = $this->M_user->where('id', $user_id)->first();

        $bidang_id = $cekMentor['bidang_id'];
        $kategori_id = $cekMentor['kategori_id'];
        // Jika $bidang_id == 0 dan $kategori_id == 0
        if ($bidang_id == 0 && $kategori_id == 0) {
            $data['IdBidang']   = "";
            $data['nama_bidang']   = "--Bidang--";
            $data['IdKategori']   = "";
            $data['nama_kategori']   = "--Kategori--";
        }
        // Dan jika tidak 
        else {
            // Bidang
            $data['IdBidang']   = $bidang_id;
            $cekBidang = $this->M_bidang->where('id', $bidang_id)->first();
            $data['nama_bidang']   = $cekBidang['nama_bidang'];
            // Kategori
            $data['IdKategori']   = $kategori_id;
            $cekKategori = $this->M_kategori->where('id', $kategori_id)->first();
            $data['nama_kategori']   = $cekKategori['nama_kategori'];
        }

        if (empty($data['mentor'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data Mentor tidak ditemukan.');
        }

        if ($this->request->getMethod() == 'post') {
            $validationRules = [
                'nama' => 'required',
                'bidang' => 'required',
                'kategori' => 'required'
            ];

            if (!$this->validate($validationRules)) {
                // Jika validasi gagal, kembalikan ke halaman edit dengan pesan error
                return view('v_dataMentor/edit', $data);
            }

            $dataToUpdate = [
                'nama' => $this->request->getPost('nama'),
                'bidang_id' => $this->request->getPost('bidang'),
                'kategori_id' => $this->request->getPost('kategori')
            ];

            $this->M_user->update($id, $dataToUpdate);

            // Tambahkan notifikasi Sweet Alert
            session()->setFlashdata('success', 'Data berhasil diubah!');

            return redirect()->to(base_url('datamentor'));
        }

        return view('v_dataMentor/edit', $data);
    }

    public function update($id)
    {
        if ($this->request->getMethod() == 'post') {
            $validationRules = [
                'nama' => 'required',
                'bidang' => 'required',
                'kategori' => 'required'
            ];

            if (!$this->validate($validationRules)) {
                // Jika validasi gagal, kembalikan ke halaman edit dengan pesan error
                return redirect()->back()->withInput()->with('error', 'Validasi gagal!');
            }

            $data = [
                'nama' => $this->request->getPost('nama'),
                'bidang_id' => $this->request->getPost('bidang'),
                'kategori_id' => $this->request->getPost('kategori')
            ];

            $this->M_user->update($id, $data);

            // Tambahkan notifikasi Sweet Alert
            session()->setFlashdata('success', 'Data berhasil diubah!');

            return redirect()->to(base_url('datamentor'));
        }
    }


    public function add()
    {
        // periksa apakah session masih ada atau tidak
        if (!$this->session->has('nama') || !$this->session->has('email')) {
            return redirect()->to('/login');
        }

        $data['title'] = 'SI AMANG | Tambah Mentor';
        $data['page'] = "tambah_datamentor";
        $data['bidang']   = $this->M_bidang->findAll();
        $data['nama']   = $this->session->get('nama');
        $data['email']   = $this->session->get('email');
        $data['tbl_pendaftaran'] = $this->M_pendaftaran->where('status_verifikasi', 'Belum Verifikasi')
            ->orderBy('created_at', 'DESC')
            ->findAll();
        $data['jumlah_pendaftaran'] = count($data['tbl_pendaftaran']);
        $user_id = $this->session->get('id');
        $cekMentor = $this->M_user->where('id', $user_id)->first();

        $bidang_id = $cekMentor['bidang_id'];
        $kategori_id = $cekMentor['kategori_id'];
        //Jika $bidang_id == 0 dan $kategori_id == 0
        if ($bidang_id == 0 && $kategori_id == 0) {
            $data['IdBidang']   = "";
            $data['nama_bidang']   = "--Bidang--";
            $data['IdKategori']   = "";
            $data['nama_kategori']   = "--Kategori--";
        }
        //Dan jika tidak 
        else {
            //Bidang
            $data['IdBidang']   = $bidang_id;
            $cekBidang = $this->M_bidang->where('id', $bidang_id)->first();
            $data['nama_bidang']   = $cekBidang['nama_bidang'];
            //Kategori
            $data['IdKategori']   = $kategori_id;
            $cekKategori = $this->M_kategori->where('id', $kategori_id)->first();
            $data['nama_kategori']   = $cekKategori['nama_kategori'];
        }
        $data['events'] = $this->M_jadwal->getEvents();

        // tampilkan view form tambah data mentor
        return view('v_dataMentor/add', $data);
    }

    // Menampilkan pilihan kategori berdasarkan bidang pada Halaman pendaftaran tahap dua 
    public function ajaxPilihanKategori()
    {
        $bidang_id = $this->request->getPost('id');
        $data = $this->M_kategori->where('bidang_id', $bidang_id)->findAll();
        echo json_encode($data);
    }

    public function tambah_mentor()
    {
        $nama = $this->request->getPost('nama');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $confirm_password = $this->request->getPost('confirm_password');
        $bidang = $this->request->getPost('bidang');
        $kategori = $this->request->getPost('kategori');

        // Validasi daftar akun pendaftaran
        $cek_validasi = [
            'nama' => $nama,
            'email' => $email,
            'password' => $password,
            'confirm_password' => $confirm_password,
            'bidang_id' => $bidang,
            'kategori_id' => $kategori
        ];

        // Cek Validasi, Jika Data Tidak Valid
        if ($this->form_validation->run($cek_validasi, 'tambah_mentor') == FALSE) {
            $validasi = [
                'error' => true,
                'tambah_mentor_error' => $this->form_validation->getErrors()
            ];
            echo json_encode($validasi);
        } else {
            // Data Valid
            $data = [
                'role_id' => 2,
                'nama' => $nama,
                'email' => $email,
                'bidang_id' => $bidang,
                'kategori_id' => $kategori,
                'password' => base64_encode($this->encrypter->encrypt($password)),
                'created_at' => date('Y-m-d H:i:s')
            ];
            $this->M_user->save($data);
            $validasi = [
                'success' => true,
                'link' => base_url('dataMentor')
            ];
            echo json_encode($validasi);
        }
    }
}
