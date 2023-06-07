<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class PendaftaranModel extends Model
{

	protected $table = "tbl_pendaftaran";
	protected $allowedFields = ['user_id', 'jadwal_id', 'bidang_id', 'mentor_id', 'kategori_id', 'nama_kategori', 'keterangan', 'nomor_pendaftaran', 'nama_peserta', 'nim', 'jenis_permohonan', 'nama_kampus', 'prodi', 'keahlian', 'nda', 'tools', 'judul', 'tbl_jadwal.tanggal_mulai', 'tbl_jadwal.tanggal_selesai', 'surat_permohonan', 'nama_anggota_1', 'nama_anggota_2', 'no_hp', 'alamat_peserta', 'status_permohonan', 'video_perkenalan', 'foto', 'berkas', 'tahap_satu', 'tahap_dua', 'tahap_tiga', 'tanggal_pendaftaran', 'status_pendaftaran', 'status_verifikasi'];
	protected $useTimestamps = true;
	protected $column_order = [null, 'foto', 'nomor_pendaftaran', 'nama_peserta', 'nama_kategori', 'tanggal_pendaftaran', 'status_verifikasi', 'tbl_user.email', 'keterangan', null];
	protected $column_search = ['nama_peserta', 'nim', 'tanggal_pendaftaran', 'status_verifikasi'];
	protected $order = ['tbl_pendaftaran.id' => 'desc'];
	protected $request;
	protected $db;
	protected $dt;

	function __construct($request)
	{
		parent::__construct();
		$this->db = db_connect();
		$this->request = $request;
		$this->request = \Config\Services::request();
		$this->dt = $this->db->table($this->table)
			->select('tbl_pendaftaran.id, foto, nomor_pendaftaran, nama_peserta, tbl_kategori.nama_kategori,tbl_kampus.nama_kampus, tanggal_pendaftaran, status_verifikasi, keterangan, tbl_user.nama')
			->join('tbl_kategori', 'tbl_kategori.id = tbl_pendaftaran.kategori_id', 'left')
			->join('tbl_user', 'tbl_user.id = tbl_pendaftaran.user_id', 'left')
			->join('tbl_kampus', 'tbl_kampus.id = tbl_pendaftaran.user_id', 'left')
			->where('status_pendaftaran', 'Selesai');
	}

	private function _get_datatables_query()
	{
		$i = 0;
		foreach ($this->column_search as $item) {
			if ($this->request->getVar('search')['value']) {
				if ($i === 0) {
					$this->dt->groupStart();
					$this->dt->like($item, $this->request->getVar('search')['value']);
				} else {
					$this->dt->orLike($item, $this->request->getVar('search')['value']);
				}
				if (count($this->column_search) - 1 == $i)
					$this->dt->groupEnd();
			}
			$i++;
		}

		// menambahkan kondisi order column berdasarkan status_verifikasi belum verifikasi
		$this->dt->orderBy('status_verifikasi', 'ASC');

		if ($this->request->getVar('order')) {
			$this->dt->orderBy($this->column_order[$this->request->getVar('order')['0']['column']], $this->request->getVar('order')['0']['dir']);
		} else if (isset($this->order)) {
			$order = $this->order;
			$this->dt->orderBy(key($order), $order[key($order)]);
		}
	}

	function get_datatables()
	{
		$this->_get_datatables_query();
		if ($this->request->getPost('length') != -1)
			$this->dt->limit($this->request->getVar('length'), $this->request->getVar('start'));
		$query = $this->dt->get();
		return $query->getResult();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		return $this->dt->countAllResults();
	}

	public function count_all()
	{
		$tbl_storage = $this->db->table($this->table);
		return $tbl_storage->countAllResults();
	}
	public function get_pendaftar_by_kampus()
	{
		$query = $this->db->query("SELECT nama_kampus, COUNT(CASE WHEN `status_verifikasi` = 'Diterima' THEN 1 END) AS `Diterima`, COUNT(CASE WHEN `status_verifikasi` = 'Tidak Diterima' THEN 1 END) AS `Tidak Diterima` FROM tbl_pendaftaran GROUP BY nama_kampus");
		$result = $query->getResultArray();
		return $result;
	}
	public function getPendaftaranByKategori($id_kategori)
	{
		$builder = $this->db->table($this->table);
		$builder->select('*');
		$builder->join('kategori', 'kategori.id_kategori = pendaftaran.id_kategori');
		$builder->where('pendaftaran.id_kategori', $id_kategori);
		$query = $builder->get();
		return $query->getResultArray();
	}

	public function getUserByEmail($id)
	{
		return $this->where('email', $id)->first();
	}
	public function getEmailById($user_id)
	{
		$builder = $this->db->table('tbl_user');
		$builder->select('tbl_user.email');
		$builder->join('tbl_pendaftaran', 'tbl_pendaftaran.user_id = tbl_user.id');
		$builder->where('tbl_pendaftaran.id', $user_id);
		$query = $builder->get();
		return $query->getRow('email');
	}
	public function getPendaftaran($status_verifikasi = null)
	{
		$builder = $this->db->table('tbl_pendaftaran');

		if (!empty($status_verifikasi)) {
			$builder->where('status_verifikasi', $status_verifikasi);
		}

		$query = $builder->get();

		return $query->getResultArray();
	}
}
