<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\PendaftaranModel;
use App\Models\JadwalModel;
use App\Models\LaporanModel;
use Config\Services;
use App\Models\ProgresMagangModel;

class ProgressMagang extends BaseController
{
    protected $encrypter;
    protected $form_validation;
    protected $M_user;
    protected $M_pendaftaran;
    protected $M_jadwal;
    protected $M_laporan;
    protected $session;
    protected $request;
    protected $db;
    protected $model;
    protected $nama_peserta;
    protected $M_progres;

    public function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
        $this->request = Services::request();
        $this->encrypter = \Config\Services::encrypter();
        $this->form_validation =  \Config\Services::validation();
        $this->M_user = new UserModel($this->request);
        $this->M_pendaftaran = new PendaftaranModel($this->request);
        $this->M_progres = new ProgresMagangModel($this->request);
        $this->M_jadwal = new JadwalModel($this->request);
        $this->M_laporan = new LaporanModel($this->request);
        $this->session = \Config\Services::session();
        $this->db = \Config\Database::connect();
        $this->session->start();


        // Set nama_peserta dari data pendaftaran
        $user_id = $this->session->get('id');
        $builder = $this->db->table('tbl_pendaftaran');
        $builder->select('tbl_pendaftaran.nama_peserta, tbl_pendaftaran.foto, tbl_user.nama');
        $builder->join('tbl_user', 'tbl_user.id = tbl_pendaftaran.user_id');
        $builder->where('tbl_pendaftaran.user_id', $user_id);
        $query = $builder->get();
        $data['pendaftaran'] = $query->getRow();
    }
    private function _action($idProgres)
    {
        $link = "
			
	      	<a href='" . base_url('progressMagang/edit/' . $idProgres) . "' class='btn-editProgres' data-toggle='tooltip' data-placement='top' title='Delete'>
              <button type='button' class='btn btn-outline-success btn-xs' data-toggle='modal' data-target='#modalEdit'><i class='fa fa-edit'></i></button>
	      	</a>
	      	
          
            ";
        return $link;
    }

    public function index()
    {
        // periksa apakah session masih ada atau tidak
        if (!$this->session->has('nama') || !$this->session->has('email')) {
            return redirect()->to('/login');
        }
        $data['nama']   = $this->session->get('nama');
        $data['email']   = $this->session->get('email');

        //Cek pendaftaran berdasarkan user_id
        $user_id = $this->session->get('id');
        $pendaftaran = $this->M_pendaftaran->where('user_id', $user_id)->first();

        // megambil data dari tbl_pendaftaran dan tbl_user
        $builder = $this->db->table('tbl_pendaftaran');
        $builder->select('tbl_pendaftaran.nama_peserta, tbl_pendaftaran.foto, tbl_pendaftaran.judul, tbl_user.nama, tbl_jadwal.tanggal_mulai, tbl_jadwal.tanggal_selesai');
        $builder->join('tbl_user', 'tbl_user.id = tbl_pendaftaran.user_id');
        $builder->join('tbl_jadwal', 'tbl_jadwal.pendaftaran_id = tbl_pendaftaran.id', 'left');
        $builder->where('tbl_pendaftaran.user_id', $user_id);
        $query = $builder->get();
        $data['pendaftaran'] = $query->getRow();

        // pengambilan data dari tbl_pendaftaran & tbl_user
        $data['nama_peserta'] = $data['pendaftaran']->nama_peserta;
        $data['foto'] = $data['pendaftaran']->foto;
        $data['judul'] = $data['pendaftaran']->judul;
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
        
        // menampilkan data title
        $data['title']   = "SI AMANG | Progress";
        $data['page']   = "progress";
        $data['events'] = $this->M_jadwal->getEvents();
        $data['tanggal_mulai'] = $data['pendaftaran']->tanggal_mulai;
        $data['tanggal_selesai'] = $data['pendaftaran']->tanggal_selesai;
        $laporan = new LaporanModel();
        $where = ['user_id' => $user_id];
        $data['laporan'] = $laporan->where($where)->first();
        if ($data['laporan']) {
            $data['keterangan_laporan'] = "Anda Sudah Upload Laporan";
        } else {
            $data['keterangan_laporan'] = "Anda Belum Upload Laporan";
        }

        // Periksa apakah tanggal saat ini sudah melewati tanggal_mulai atau belum
        $tanggal_sekarang = date('Y-m-d');
        if ($tanggal_sekarang < $data['tanggal_mulai']) {
            $pesan = "Maaf, Halaman ini hanya dapat diakses setelah waktu magang dimulai. Silahkan cek jadwal magang untuk mengetahui waktu mulai magang Anda.";
            $this->session->setFlashdata('pesan_error', $pesan);
            return redirect()->back();
        }

        // Periksa apakah tanggal saat ini sudah melewati tanggal_selesai atau belum
        // jika sudah melewati tanggal_selesai maka form pada myTabContent akan dihilangkan dengan javascript
        if ($tanggal_sekarang > $data['tanggal_selesai']) {
            $pesan = "Waktu magang Anda telah selesai. Terima kasih telah mengikuti program magang.";
            $this->session->setFlashdata('pesan_info', $pesan);
            // hapus tab form progress
            echo '<script>document.getElementById("formprogress-tab").remove(); document.getElementById("formprogress").remove(); </script>';
        }

        return view('v_progress/index', $data);
    }


    public function ajaxDataProgress()
    {
        if ($this->request->getMethod(true) == 'POST') {
            $user_id = $this->session->get('id'); // ambil user_id dari session
            $lists = $this->M_progres->get_datatables($user_id); // tambahkan parameter user_id
            $data = [];
            $no = $this->request->getPost("start");
            foreach ($lists as $list) {
                $no++;
                $row = [];
                $row[] = $no;
                $row[] = $list->judul;
                $row[] = $list->tgl_bimbingan;
                $row[] = $list->pencapaian;
                $row[] = $list->catatan;
                $row[] = "<a href='/file_peserta/progress/" . $list->file_presentasi . "' class='btn btn-primary btn-sm'>Download PDF</a>";
                $row[] = $list->created_at;
                $data[] = $row;
            }
            $recordsFiltered = $this->M_progres->count_filtered($user_id);
            $output = [
                "draw" => $this->request->getPost('draw'),
                "recordsTotal" => $recordsFiltered,
                "recordsFiltered" => $recordsFiltered,
                "data" => $data
            ];
            echo json_encode($output);
        }
    }


    // upload data
    public function create()
    {
        // periksa apakah session masih ada atau tidak
        if (!$this->session->has('nama') || !$this->session->has('email')) {
            return redirect()->to('/login');
        }
        $data['nama']   = $this->session->get('nama');
        $data['email']   = $this->session->get('email');


        $model = new ProgresMagangModel();
        $file_presentasi = $this->request->getFile('file_presentasi');

        // Menentukan maksimum ukuran file yang diperbolehkan (2 MB)
        $max_size = 2 * 1024 * 1024;

        // Validasi file_presentasi
        if (!$file_presentasi->isValid() || $file_presentasi->getSize() > $max_size || $file_presentasi->getClientMimeType() != 'application/pdf') {
            return redirect()->back()->with('error', 'File_presentasi harus berukuran kurang dari 2 MB dan berformat PDF');
        }
        $user_id = session()->get('id'); // mengambil user_id dari session
        $nama_peserta = session()->get('nama'); // mengambil user_id dari session

        // Memindahkan file form nilai ke folder uploads/form-nilai
        $nama_file_presentasi = $user_id . '_' . $nama_peserta . '_' . 'Progress_Magang.' . pathinfo($file_presentasi->getName(), PATHINFO_EXTENSION);

        $file_presentasi->move('file_peserta/progress', $nama_file_presentasi);

        $data = [
            'user_id' => $user_id,
            'tgl_bimbingan' => $this->request->getPost('tgl_bimbingan'),
            'pencapaian' => $this->request->getPost('pencapaian'),
            'catatan' => $this->request->getPost('catatan'),
            'file_presentasi' => $nama_file_presentasi,
        ];

        if (!$model->insertProgress($data)) {
            return redirect()->back()->with('error', 'Gagal menyimpan progress');
        }

        return redirect()->to('/ProgressMagang')->with('success', 'Progress berhasil disimpan');
    }
}
