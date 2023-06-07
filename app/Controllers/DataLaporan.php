<?php

namespace App\Controllers;

use App\Models\BidangModel;
use App\Models\PendaftaranModel;
use App\Models\JadwalModel;
use App\Models\DataLaporanModel;
use Config\Services;

class DataLaporan extends BaseController
{
	protected $M_pendaftaran;
    protected $M_jadwal;
	protected $M_bidang;
	protected $M_dataLaporan;
	protected $request;
	protected $nama_peserta;
	protected $form_validation;
	protected $session;
	protected $db;

	public function __construct()
	{
		$this->request = Services::request();
        $this->M_jadwal = new JadwalModel($this->request);
		$this->M_bidang = new BidangModel($this->request);
		$this->M_pendaftaran = new PendaftaranModel($this->request);
		$this->M_dataLaporan = new DataLaporanModel($this->request);
		$this->form_validation =  \Config\Services::validation();
		$this->session = \Config\Services::session();
		$this->db = \Config\Database::connect();

		// Set nama_peserta dari data pendaftaran
		$user_id = $this->session->get('id');
		$builder = $this->db->table('tbl_pendaftaran');
		$builder->select('tbl_pendaftaran.nama_peserta, tbl_pendaftaran.jenis_permohonan, tbl_pendaftaran.status_permohonan, tbl_jadwal.tanggal_mulai, tbl_jadwal.tanggal_selesai, tbl_pendaftaran.foto, tbl_user.nama');
		$builder->join('tbl_user', 'tbl_user.id = tbl_pendaftaran.user_id');
		$builder->join('tbl_jadwal', 'tbl_jadwal.pendaftaran_id = tbl_pendaftaran.id', 'left');
		$builder->where('tbl_pendaftaran.user_id', $user_id);
		$query = $builder->get();
		$data['pendaftaran'] = $query->getRow();
	}


	// Halaman Data Laporan
	public function index()
	{
		$data['title']  = "SI AMANG | Data Laporan";
		$data['page']   = "datalaporan";

		// periksa apakah session masih ada atau tidak
		if (!$this->session->has('nama') || !$this->session->has('email')) {
			return redirect()->to('/login');
		}
		$data['nama']   = $this->session->get('nama');
		$data['email']   = $this->session->get('email');

		// Ambil data pendaftaran yang terbaru dan belum diterima
		$data['tbl_pendaftaran'] = $this->M_pendaftaran->where('status_verifikasi', 'Belum Verifikasi')
			->orderBy('created_at', 'DESC')
			->findAll();
		$data['jumlah_pendaftaran'] = count($data['tbl_pendaftaran']);
		$data['events'] = $this->M_jadwal->getEvents();
		return view('v_dataLaporan/index', $data);
	}



	// Datatable server side
	public function ajaxDataLaporan()
	{

		if ($this->request->getMethod(true) == 'POST') {
			$lists = $this->M_dataLaporan->get_datatables();
			$data = [];
			$no = $this->request->getPost("start");
			foreach ($lists as $list) {
				$no++;
				$row = [];
				$row[] = $no;
				$row[] = $list->nama_peserta;
				$row[] = $list->status_permohonan;
				$row[] = $list->jenis_permohonan;
				$row[] = $list->judul_laporan;
				$row[] = "<a href='" . $list->link_drive . "'>" . $list->link_drive . "</a>";
				$row[] = "<a href='/file_peserta/laporan/" . $list->form_nilai . "' class='btn btn-primary btn-sm'>Download PDF</a>";
				if ($list->form_nilai) {
					$row[] = "<span class='text-success'>Sudah Diupload</span>
					<button type='button' class='btn btn-success btn-sm' data-toggle='modal' data-target='#modalUploadNilai' data-id='" . $list->id . "'>Upload Ulang Nilai</button>";
				} else {
					$row[] = "<button type='button' class='btn btn-success btn-sm' data-toggle='modal' data-target='#modalUploadNilai' data-id='" . $list->id . "'>Upload Nilai</button>";
				}
				if ($list->surat_selesai_magang) {
					$row[] = "<span class='text-success'>Sudah Diupload</span>
					<button type='button' class='btn btn-success btn-sm' data-toggle='modal' data-target='#modalUploadSurat' data-id='" . $list->id . "'>Upload Ulang Surat</button>";
				} else {
					$row[] = "<button type='button' class='btn btn-success btn-sm' data-toggle='modal' data-target='#modalUploadSurat' data-id='" . $list->id . "'>Upload Surat</button>";
				}

				$data[] = $row;
			}
			$output = [
				"draw"              => $this->request->getPost('draw'),
				"recordsTotal"      => $this->M_dataLaporan->count_all(),
				"recordsFiltered"   => $this->M_dataLaporan->count_filtered(),
				"data"              => $data
			];
			echo json_encode($output);
		}
	}

	
	public function uploadFormNilai()
	{
		$id = $this->request->getPost('id');
		$file = $this->request->getFile('form_nilai');

		
		// Simpan file ke folder yang ditentukan
		$newFileName = 'form_nilai_sudah_dinilai.pdf';
		$file->move('./file_peserta/laporan', $newFileName);

		// Update data pada tabel M_laporan dengan form_nilai yang baru
		$this->M_dataLaporan->update($id, ['form_nilai' => $newFileName]);

		// Redirect ke halaman datalaporan
		return redirect()->to('/datalaporan')->with('swal_success', 'Data berhasil diupload');
	}

	public function uploadFormSurat()
	{
		$id = $this->request->getPost('id');
		$file = $this->request->getFile('surat_selesai_magang');

		// Simpan file ke folder yang ditentukan
		$newFileName = 'surat_selesai_magang.pdf';
		$file->move('./file_peserta/laporan', $newFileName);

		// Update data pada tabel M_laporan dengan form_nilai yang baru
		$this->M_dataLaporan->update($id, ['surat_selesai_magang' => $newFileName]);

		// Redirect ke halaman datalaporan
		return redirect()->to('/datalaporan')->with('swal_success', 'Data berhasil diupload');
	}
}
