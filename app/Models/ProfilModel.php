<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class ProfilModel extends Model
{
    protected $table = "tbl_user";
    protected $allowedFields = ['role_id', 'nama', 'email', 'password', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
    protected $db;
	protected $dt;

    function __construct(RequestInterface $request)
    {
        parent::__construct();
        $this->db = db_connect();
        $this->request = $request;
        $this->dt = $this->db->table($this->table);
    }
}
