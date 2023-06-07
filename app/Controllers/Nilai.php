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

class Nilai extends BaseController
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
    protected $db;

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
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $data['title'] = "SI AMANG | Nilai Peserta";
        $data['page'] = "nilaipeserta";

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
        return view('v_nilai/index', $data);
    }
    public function add()
    {

        $id               = $this->request->getPost('id');
        $pendaftaran_id   = $this->request->getPost('pendaftaran_id');
        $nama_peserta     = $this->request->getPost('nama_peserta');
        $ketepatan_waktu = $this->request->getPost('ketepatan_waktu');
        $kehadiran     = $this->request->getPost('kehadiran');
        $kemampuan_kerja     = $this->request->getPost('kemampuan_kerja');
        $kualitas_kerja     = $this->request->getPost('kualitas_kerja');
        $kerjasama     = $this->request->getPost('kerjasama');
        $inisiatif     = $this->request->getPost('inisiatif');
        $rasa_percaya     = $this->request->getPost('rasa_percaya');
        $penampilan     = $this->request->getPost('penampilan');
        $patuh_aturan_pkl     = $this->request->getPost('patuh_aturan_pkl');
        $rata_rata    = $this->request->getPost('rata_rata');
        $tanggung_jawab     = $this->request->getPost('tanggung_jawab');
        $tanda_tangan    = $this->request->getPost('tanda_tangan');
        // Check if data with the same pendaftaran_id already exists in tbl_jadwal
        $dataExists = $this->M_nilai->checkExistData($pendaftaran_id, $nama_peserta);

        if ($dataExists) {
            $ketepatan_waktu = $dataExists->ketepatan_waktu;
            $kehadiran = $dataExists->kehadiran;
            $kemampuan_kerja = $dataExists->kemampuan_kerja;
            $kualitas_kerja = $dataExists->kualitas_kerja;
            $kerjasama = $dataExists->kerjasama;
            $inisiatif = $dataExists->inisiatif;
            $rasa_percaya = $dataExists->rasa_percaya;
            $penampilan = $dataExists->penampilan;
            $patuh_aturan_pkl = $dataExists->patuh_aturan_pkl;
            $rata_rata = $dataExists->rata_rata;
            $tanggung_jawab = $dataExists->tanggung_jawab;
            $tanda_tangan = $dataExists->tanda_tangan;
        } else {
            $ketepatan_waktu = $this->request->getPost('ketepatan_waktu');
            $kehadiran     = $this->request->getPost('kehadiran');
            $kemampuan_kerja     = $this->request->getPost('kemampuan_kerja');
            $kualitas_kerja     = $this->request->getPost('kualitas_kerja');
            $kerjasama     = $this->request->getPost('kerjasama');
            $inisiatif     = $this->request->getPost('inisiatif');
            $rasa_percaya     = $this->request->getPost('rasa_percaya');
            $penampilan     = $this->request->getPost('penampilan');
            $patuh_aturan_pkl     = $this->request->getPost('patuh_aturan_pkl');
            $rata_rata    = $this->request->getPost('rata_rata');
            $tanggung_jawab     = $this->request->getPost('tanggung_jawab');
            $tanda_tangan     = $this->request->getPost('tanda_tangan');
        }
        $data = [
            'pendaftaran_id'   => $pendaftaran_id,
            'nama_peserta'     => $nama_peserta,
            'ketepatan_waktu'    => $ketepatan_waktu,
            'kehadiran'  => $kehadiran,
            'kemampuan_kerja' => $kemampuan_kerja,
            'kualitas_kerja'    => $kualitas_kerja,
            'kerjasama'    => $kerjasama,
            'inisiatif'    => $inisiatif,
            'rasa_percaya'    => $rasa_percaya,
            'penampilan'    => $penampilan,
            'patuh_aturan_pkl'    => $patuh_aturan_pkl,
            'rata_rata'    => $rata_rata,
            'tanggung_jawab'    => $tanggung_jawab,
            'tanda_tangan'    => $tanda_tangan,
        ];
        if ($this->form_validation->run($data, 'nilai') == FALSE) {
            $validasi = [
                'error'         => true,
                'nilai_error'  => $this->form_validation->getErrors()
            ];
            echo json_encode($validasi);
        } else {
            /* var_dump($data);
            die(); */
            if ($dataExists) {
                $this->M_nilai->update($id, $data);
            } else {
                $this->M_nilai->save($data);
            }
            $validasi = [
                'success'   => true,
                'link'      => base_url('nilai')
            ];
            echo json_encode($validasi);
        }
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

    public function cetakPDF()
    {
        $lists = $this->M_nilai->get_datatables();
        $data = [];
        $no = 0;
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
        //Cetak dengan dompdf
        $dompdf = new \Dompdf\Dompdf();
        $options = new \Dompdf\Options();
        $options->setIsRemoteEnabled(true);

        $dompdf->setOptions($options);
        $dompdf->output();
        $dompdf->loadHtml(view('v_dataNilai/cetak',  ['data' => $data]));
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream('datanilai.pdf', array("Attachment" => false));
    }
}
