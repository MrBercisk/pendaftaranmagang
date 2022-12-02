<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class MentorModel extends Model
{
	protected $table = "tbl_mentor";
	protected $allowedFields = ['bidang_id', 'role_id', 'nama_mentor', 'email', 'password'];
	protected $column_order = [null, 'nama_mentor', null];
	protected $column_search = ['nama_mentor'];
	protected $order = ['id' => 'desc'];
	protected $request;
	protected $db;
	protected $dt;


	function __construct(RequestInterface $request)
	{
		parent::__construct();
		$this->db = db_connect();
		$this->request = $request;
		$this->dt = $this->db->table($this->table)->select('*');
	}

	private function _tbl_mentor($idBidang)
	{
		$this->dt->where('bidang_id', $idBidang);
	}

	private function _get_datatables_query($idBidang)
	{
		$this->_tbl_mentor($idBidang);
		$i = 0;
		foreach ($this->column_search as $item) {
			if ($this->request->getPost('search')['value']) {
				if ($i === 0) {
					$this->dt->groupStart();
					$this->dt->like($item, $this->request->getPost('search')['value']);
				} else {
					$this->dt->orLike($item, $this->request->getPost('search')['value']);
				}
				if (count($this->column_search) - 1 == $i)
					$this->dt->groupEnd();
			}
			$i++;
		}

		if ($this->request->getPost('order')) {
			$this->dt->orderBy($this->column_order[$this->request->getPost('order')['0']['column']], $this->request->getPost('order')['0']['dir']);
		} else if (isset($this->order)) {
			$order = $this->order;
			$this->dt->orderBy(key($order), $order[key($order)]);
		}
	}

	function get_datatables($idBidang)
	{
		$this->_get_datatables_query($idBidang);
		if ($this->request->getPost('length') != -1)
			$this->dt->limit($this->request->getPost('length'), $this->request->getPost('start'));
		$query = $this->dt->get();
		return $query->getResult();
	}

	function count_filtered($idBidang)
	{
		$this->_get_datatables_query($idBidang);
		return $this->dt->countAllResults();
	}

	public function count_all($idBidang)
	{
		$tbl_storage = $this->db->table($this->table)->select('*')->where('bidang_id', $idBidang);
		return $tbl_storage->countAllResults();
	}
}
