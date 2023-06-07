<?php namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class BidangModel extends Model 
{
	protected $table = "tbl_bidang";
	protected $allowedFields = ['nama_bidang'];
	protected $column_order = [null, 'nama_bidang', null];
	protected $column_search = ['nama_bidang'];
	protected $order = ['id' => 'desc'];
	protected $request;
	protected $db;
	protected $dt;

	function __construct(){
	   parent::__construct();
	   $this->db = db_connect();
	   $this->request = \Config\Services::request();
	   $this->dt = $this->db->table($this->table);
	}

	private function _get_datatables_query(){
	    $i = 0;
	    foreach ($this->column_search as $item){
	        if($this->request->getVar('search')['value']){ 
	            if($i===0){
	                $this->dt->groupStart();
	                $this->dt->like($item, $this->request->getVar('search')['value']);
	            }
	            else{
	                $this->dt->orLike($item, $this->request->getVar('search')['value']);
	            }
	            if(count($this->column_search) - 1 == $i)
	                $this->dt->groupEnd();
	        }
	        $i++;
	    }
	     
	    if($this->request->getVar('order')){
	            $this->dt->orderBy($this->column_order[$this->request->getVar('order')['0']['column']], $this->request->getVar('order')['0']['dir']);
	        } 
	    else if(isset($this->order)){
	        $order = $this->order;
	        $this->dt->orderBy(key($order), $order[key($order)]);
	    }
	}

	function get_datatables(){
	    $this->_get_datatables_query();
	    if($this->request->getVar('length') != -1)
	    $this->dt->limit($this->request->getVar('length'), $this->request->getVar('start'));
	    $query = $this->dt->get();
	    return $query->getResult();
	}

	function count_filtered(){
	    $this->_get_datatables_query();
	    return $this->dt->countAllResults();
	}

	public function count_all(){
	    $tbl_storage = $this->db->table($this->table);
	    return $tbl_storage->countAllResults();
	}

}

