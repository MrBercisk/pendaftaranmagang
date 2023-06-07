<?php

namespace App\Models;

use CodeIgniter\Model;

class ProgresMagangModel extends Model
{
	protected $table      = 'tbl_progresmagang';
	protected $primaryKey = 'id';
	protected $allowedFields = ['user_id', 'tbl_pendaftaran.judul', 'tgl_bimbingan', 'pencapaian', 'catatan', 'file_presentasi', 'created_at'];
	protected $column_order = [null, 'user_id', 'judul', 'tgl_bimbingan', 'pencapaian', 'catatan', 'file_presentasi', 'created_at', null];
	protected $column_search = ['tbl_pendaftaran.judul','tgl_bimbingan', 'pencapaian', 'catatan'];
	protected $order = ['tbl_progresmagang.id' => 'desc'];
	protected $useTimestamps = true;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $request;
	protected $session;
	protected $db;
	protected $dt;

	function __construct()
	{
		parent::__construct();
		$this->db = db_connect();
		$this->request = \Config\Services::request();
		$this->session = \Config\Services::session();
		$this->dt = $this->db->table($this->table);
		$this->dt->select('tbl_progresmagang.*, tbl_pendaftaran.judul'); // Menambahkan kolom judul dari tabel tbl_pendaftaran
		$this->dt->join('tbl_pendaftaran', 'tbl_pendaftaran.user_id = tbl_progresmagang.user_id', 'left');
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

		// Tambahkan kondisi where untuk user_id
		$this->dt->where('tbl_progresmagang.user_id', $this->session->get('id'));

		if ($this->request->getVar('order')) {
			$column = $this->request->getVar('order')['0']['column'];
			$order = $this->column_order[$column];
			if ($order === 'tbl_pendaftaran.judul') {
				$order = 'judul'; // Jika order adalah kolom judul, ubah menjadi 'judul' saja
			}
			$this->dt->orderBy($order, $this->request->getVar('order')['0']['dir']);
		} else if (isset($this->order)) {
			$order = $this->order;
			$this->dt->orderBy(key($order), $order[key($order)]);
		}
	}

	function get_datatables()
	{
		$this->_get_datatables_query();
		$this->dt->where('tbl_progresmagang.user_id', $this->session->get('id'));
		if ($this->request->getVar('length') != -1)
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

	public function insertProgress($data)
	{
		return $this->insert($data);
	}

	public function updateProgress($data)
	{
		return $this->update($data);
	}
}
