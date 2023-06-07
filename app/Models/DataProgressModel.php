<?php

namespace App\Models;

use CodeIgniter\Model;

class DataProgressModel extends Model
{
	protected $table      = 'tbl_progresmagang';
	protected $primaryKey = 'id';
	protected $allowedFields = ['tbl_pendaftaran.nama_peserta','tbl_pendaftaran.user_id', 'tbl_pendaftaran.judul','tgl_bimbingan', 'pencapaian','catatan', 'file_presentasi', 'created_at'];
	protected $column_order = [null,'tbl_pendaftaran.nama_peserta', 'tbl_pendaftaran.judul', 'tgl_bimbingan', 'pencapaian','catatan', 'file_presentasi', 'created_at', null];
	protected $column_search = [ 'tgl_bimbingan', 'pencapaian' , 'file_presentasi'];
	protected $order = ['tbl_progresmagang.id' => 'desc'];
	protected $useTimestamps = true;
	protected $request;
	protected $session;
	protected $db;
	protected $dt;
	protected $validationRules    = [
		'user_id' => 'required|integer',
		'nama_project' => 'required',
		'tgl_bimbingan' => 'required',
		'pencapaian' => 'required',
		'file_presentasi' => 'required'
	];
	protected $validationMessages = [];
	protected $skipValidation     = false;


	function __construct()
	{
		parent::__construct();
		$this->db = db_connect();
		$this->request = \Config\Services::request();
		$this->session = \Config\Services::session();
		$this->dt = $this->db->table($this->table);
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
}
