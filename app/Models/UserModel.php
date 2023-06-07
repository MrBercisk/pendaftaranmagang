<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
	protected $table = "tbl_user";
	protected $allowedFields = ['id','bidang_id', 'kategori_id', 'nama_kategori', 'token', 'reset_token_created_at', 'role_id', 'nama', 'email', 'role', 'password', 'created_at'];
	protected $column_search = ['nama', 'email', 'created_at','token', 'reset_token_created_at'];
	protected $column_order = [null, 'role_id', 'nama', 'email', 'role', 'nama_kategori', 'created_at', null];
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

		// Add search for 'role_id' with value of 2
		$this->dt->where('tbl_user.role_id', 2);

		if ($this->request->getVar('order')) {
			$this->dt->orderBy($this->column_order[$this->request->getVar('order')['0']['column']], $this->request->getVar('order')['0']['dir']);
		} else if (isset($this->order)) {
			$order = $this->order;
			$this->dt->orderBy(key($order), $order[key($order)]);
		}

		$this->dt->limit($this->request->getVar('length'), $this->request->getVar('start'));
	}



	public function get_datatables()
	{
		$this->dt->select('tbl_user.*, tbl_user_role.role, tbl_kategori.nama_kategori'); // tambahkan field nama_kategori
		$this->dt->join('tbl_user_role', 'tbl_user.role_id = tbl_user_role.id', 'left');
		$this->dt->join('tbl_kategori', 'tbl_user.kategori_id = tbl_kategori.id', 'left'); // tambahkan join ke tbl_kategori
		$this->dt->where('tbl_user_role.role', 'mentor');
		$this->_get_datatables_query();

		if ($this->request->getVar('length') != -1)
			$this->dt->limit($this->request->getVar('length'), $this->request->getVar('start'));

		$query = $this->dt->get();
		return $query->getResult();
	}



	function count_filtered()
	{
		$this->_get_datatables_query();
		return $this->dt->countAllResults(false);
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
	public function tambahData($data)
	{
		$this->insert($data);
	}
	// mengambil token untuk fitur lupa password
	public function getUserByToken($token)
	{
		return $this->where('token', $token)->first();
	}

	public function resetPassword($token, $password)
	{

		$this->set('password', $password);
		$this->where('token', $token);
		$this->update();

		$this->set('token', NULL);
		$this->where('token', $token);
		$this->update();
	}


	// fitur forgot password
	public function getUserByResetToken($token)
	{
		return $this->where('token', $token)
			->where('reset_token_created_at >', date('Y-m-d H:i:s', strtotime('-1 day')))
			->first();
	}
}
