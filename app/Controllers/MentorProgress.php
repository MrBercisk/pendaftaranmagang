<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\PendaftaranModel;
use App\Models\DataProgressModel;
use App\Models\MentorProgressModel;
use Config\Services;
use App\Models\JadwalModel;
use App\Models\ProgresMagangModel;

class MentorProgress extends BaseController
{
    protected $encrypter;
    protected $form_validation;
    protected $M_user;
    protected $M_pendaftaran;
    protected $session;
    protected $request;
    protected $M_progres;
    protected $nama_peserta;
    protected $M_jadwal;
    protected $M_dataprogress;
    protected $M_mentorprogress;
    protected $db;

    public function __construct()
    {

        $this->request = Services::request();
        $this->encrypter = \Config\Services::encrypter();
        $this->form_validation =  \Config\Services::validation();
        $this->M_user = new UserModel($this->request);
        $this->M_pendaftaran = new PendaftaranModel($this->request);
        $this->M_progres = new ProgresMagangModel($this->request);
        $this->M_jadwal = new JadwalModel($this->request);
        $this->M_dataprogress = new DataProgressModel($this->request);
        $this->M_mentorprogress = new MentorProgressModel($this->request);
        $this->session = \Config\Services::session();
        $this->db = \Config\Database::connect();
        $this->session->start();


        // Set nama_peserta dari data pendaftaran
        $user_id = $this->session->get('id');
        $builder = $this->db->table('tbl_pendaftaran');
        $builder->select('tbl_pendaftaran.nama_peserta, tbl_pendaftaran.judul, tbl_pendaftaran.foto, tbl_user.nama');
        $builder->join('tbl_user', 'tbl_user.id = tbl_pendaftaran.user_id');
        $builder->where('tbl_pendaftaran.user_id', $user_id);
        $query = $builder->get();
        $data['pendaftaran'] = $query->getRow();
    }

    // Tombol Aksi Pada Tabel Data Progress
    private function _action($idProgres)
    {
        $link = "
			<a data-toggle='tooltip' data-placement='top' class='btn-editBidang' title='Update' value='" . $idProgres . "'>
	      		<button type='button' class='btn btn-outline-success btn-xs' data-toggle='modal' data-target='#modalEdit'><i class='fa fa-edit'></i></button>
	      	</a>
	      
	      	<a href='" . base_url('dataProgress/delete/' . $idProgres) . "' class='btn-deleteProgres' data-toggle='tooltip' data-placement='top' title='Delete'>
	      		<button type='button' class='btn btn-outline-danger btn-xs'><i class='fa fa-trash'></i></button>
	      	</a>
	      	
          
            ";
        return $link;
    }

    // Halaman Data Laporan
    public function index()
    {
        $data['title']  = "SI AMANG | Data Progress";
        $data['page']   = "dataprogress";

        // periksa apakah session masih ada atau tidak
        if (!$this->session->has('nama') || !$this->session->has('email')) {
            return redirect()->to('/login');
        }

        $data['nama']   = $this->session->get('nama');
        $data['email']   = $this->session->get('email');
        //Cek pendaftaran berdasarkan user_id
        $user_id = $this->session->get('id');
        $pendaftaran = $this->M_pendaftaran->where('user_id', $user_id)->first();
        $user = $this->M_user->where('id', $user_id)->first();
        // join table pendaftaran berdasarkan user_id
        $builder = $this->db->table('tbl_user');
        $builder->select('tbl_pendaftaran.nama_peserta, tbl_pendaftaran.foto, tbl_pendaftaran.bidang_id, tbl_pendaftaran.kategori_id, tbl_user.nama, tbl_jadwal.tanggal_mulai, tbl_jadwal.tanggal_selesai');
        $builder->join('tbl_pendaftaran', 'tbl_user.id = tbl_pendaftaran.user_id', 'left');
        $builder->join('tbl_jadwal', 'tbl_jadwal.pendaftaran_id = tbl_pendaftaran.id', 'left');
        $builder->where('tbl_user.id', $user_id);
        $query = $builder->get();
        $data['pendaftaran'] = $query->getRow();

        // mengambil data id pada tbl_user
        $builder = $this->db->table('tbl_user');
        $builder->where('tbl_user.id', $user_id);
        $query = $builder->get();
        $data['user'] = $query->getRow();

        // ambil data chat yang terkait dengan user yang sedang login
        $builder = $this->db->table('chat');
        $builder->select('chat.*, tbl_user.role_id, tbl_user.nama as pengirim_nama');
        $builder->join('tbl_user', 'tbl_user.id = chat.pengirim');
        $builder->orderBy('waktu_kirim', 'DESC'); // Mengubah pengurutan menjadi DESC
        $builder->where('chat.kategori_id', $data['user']->kategori_id);
        $query = $builder->get();
        $data['chat'] = $query->getResult();


        $currentUser = $this->session->get('id');
        // Periksa apakah ada pesan baru yang belum dibaca
        $chatBaru = false;
        foreach ($data['chat'] as $chat) {
            if (!$chat->dibaca && $chat->pengirim !== $currentUser) {
                $chatBaru = true;
                break;
            }
        }

        // Jika chat dibuka atau halaman diskusiforum diakses oleh penerima pesan,
        // set nilai 'dibaca' menjadi true untuk pesan yang dikirim oleh pengirim.
        if ($chatBaru) {
            $this->db->table('chat')
                ->where('kategori_id', $data['user']->kategori_id)
                ->where('pengirim', $chat->pengirim); // Hanya untuk pesan yang dikirim oleh pengirim
        }

        // Filter chat yang belum dibaca oleh pengirim
        $filteredChat = array_filter($data['chat'], function ($chat) use ($currentUser) {
            // Memeriksa apakah chat belum dibaca dan bukan dikirim oleh pengirim
            return !$chat->dibaca && $chat->pengirim !== $currentUser;
        });
        $data['chat_baru'] = count($filteredChat);
        // Ambil data pendaftaran yang terbaru dan belum diterima
        $data['tbl_pendaftaran'] = $this->M_pendaftaran->where('status_verifikasi', 'Belum Verifikasi')
            ->orderBy('created_at', 'DESC')
            ->findAll();
        $data['jumlah_pendaftaran'] = count($data['tbl_pendaftaran']);
        $data['events'] = $this->M_jadwal->getEvents();
        return view('v_mentor/progress', $data);
    }

    // Delete Data Progress
    public function delete($id)
    {
        $this->M_progres->delete($id);
    }
    public function ajaxDataProgress()
    {
        if ($this->request->getMethod(true) == 'POST') {
            $lists = $this->M_mentorprogress->get_datatables();
            $data = [];
            $no = $this->request->getPost("start");
            foreach ($lists as $list) {
                $no++;
                $row = [];
                $row[] = $no;
                $row[] = $list->nama_peserta;
                $row[] = $list->judul;
                $row[] = $list->tgl_bimbingan;
                $row[] = $list->pencapaian;
                $row[] = $list->catatan;
                $row[] = "<a href='/file_peserta/progress/" . $list->file_presentasi . "' class='btn btn-primary btn-sm'>Download PDF</a>";
                $data[] = $row;
            }
            $output = [
                "draw"              => $this->request->getPost('draw'),
                "recordsTotal"      => $this->M_mentorprogress->count_all(),
                "recordsFiltered"   => $this->M_mentorprogress->count_filtered(),
                "data"              => $data
            ];
            echo json_encode($output);
        }
    }


    public function download_pdf_file_presentasi($file_presentasi)
    {
        // Load Dompdf library
        $dompdf = new \Dompdf\Dompdf();
        $options = new \Dompdf\Options();
        $options->setIsRemoteEnabled(true);

        // Load HTML content from view
        $html = view('file_peserta/progress', ['file_presentasi' => $file_presentasi]);

        // Set options for PDF generation
        $dompdf->setPaper('A4', 'portrait');

        // Load HTML into Dompdf
        $dompdf->loadHtml($html);

        // Render the PDF
        $dompdf->render();

        // Download the PDF file
        $dompdf->stream("file_presentasi.pdf");
    }


    public function insertData()
    {
        $session = session();
        $user_id = $session->get('id');

        if (!$user_id) {
            return redirect()->to('/login');
        }

        $progresMagangModel = new ProgresMagangModel();

        $data = [
            'user_id' => $user_id,
            'nama_project' => $this->request->getVar('nama_project'),
            'tgl_bimbingan' => $this->request->getVar('tgl_bimbingan'),
            'pencapaian' => $this->request->getVar('pencapaian'),
            'file_presentasi' => $this->request->getVar('file_presentasi')
        ];

        if ($progresMagangModel->insert($data)) {
            return redirect()->to('/ProgressMagang',)->with('success', 'Data berhasil ditambahkan!');
        } else {
            return redirect()->back()->withInput()->with('error', 'Data gagal ditambahkan!');
        }
    }
}
