<?php

namespace App\Models;

use CodeIgniter\Model;

class MentorModel extends Model
{
	protected $table = "tbl_user";
	protected $allowedFields = ['role_id', 'nama', 'email', 'role', 'created_at'];
	protected $column_search = ['nama', 'email', 'created_at'];
	protected $column_order = [null, 'role_id', 'nama', 'email', 'role', 'created_at', null];
	protected $order = ['tbl_user.id' => 'desc'];
	protected $useTimestamps = true;
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

    // Add search for 'role'
    $roleSearch = $this->request->getVar('columns')[4]['search']['value'];
    if (!empty($roleSearch)) {
        $this->dt->groupStart();
        $this->dt->like('tbl_user_role.role', $roleSearch);
        $this->dt->groupEnd();
    }

    // Add condition to show only mentor role
    $this->dt->where('tbl_user_role.role', 'mentor');

    if ($this->request->getVar('order')) {
        $this->dt->orderBy($this->column_order[$this->request->getVar('order')['0']['column']], $this->request->getVar('order')['0']['dir']);
    } else if (isset($this->order)) {
        $order = $this->order;
        $this->dt->orderBy(key($order), $order[key($order)]);
    }
}


	public function get_datatables()
	{
		$this->dt->select('tbl_user.*, tbl_user_role.role');
		$this->dt->join('tbl_user_role', 'tbl_user.role_id = tbl_user_role.id', 'left');
		$this->_get_datatables_query(); // call the _get_datatables_query method to set up the search query

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

	public function getNewUsersCount()
	{
		$builder = $this->db->table($this->table);
		$builder->where('status', 'baru');
		return $builder->countAllResults();
	}

	public function getUserByEmail($email)
	{
		return $this->where('email', $email)->first();
	}
}
