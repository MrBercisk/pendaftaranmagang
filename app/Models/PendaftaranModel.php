<?php namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class PendaftaranModel extends Model 
{

	protected $table = "tbl_pendaftaran";
	protected $allowedFields = ['user_id', 'bidang_id', 'kategori_id', 'nomor_pendaftaran', 'nama_peserta', 'jenis_permohonan', 'nama_kampus', 'prodi' , 'keahlian','nda' ,'tools','judul','tanggal_mulai','tanggal_selesai', 'surat_permohonan', 'no_hp', 'alamat_peserta', 'status_permohonan', 'video_perkenalan', 'foto', 'berkas', 'tahap_satu', 'tahap_dua', 'tahap_tiga', 'tanggal_pendaftaran', 'status_pendaftaran', 'status_verifikasi'];
	protected $useTimestamps = true;
	protected $column_order = [null, 'nomor_pendaftaran', 'nama_peserta', 'nama_kategori','tanggal_pendaftaran','jenis_permohonan','status_permohonan','nama_kampus', 'prodi' , 'keahlian', 'tools','judul', 'tanggal_mulai','tanggal_selesai','status_verifikasi', null];
	protected $column_search = ['nomor_pendaftaran', 'nama_peserta', 'nama_kategori', 'nama_kampus', 'prodi' , 'keahlian', 'tools','judul','tanggal_pendaftaran', 'jenis_permohonan' ,'status_verifikasi'];
	protected $order = ['tbl_pendaftaran.id' => 'desc'];
	protected $request;
	protected $db;
	protected $dt;

	function __construct(RequestInterface $request){
	   parent::__construct();
	   $this->db = db_connect();
	   $this->request = $request;
	   $this->dt = $this->db->table($this->table)->select('tbl_pendaftaran.id, nomor_pendaftaran, nama_peserta, tbl_kategori.nama_kategori, tanggal_pendaftaran, status_verifikasi')->join('tbl_kategori', 'tbl_kategori.id = tbl_pendaftaran.kategori_id', 'left')->where('status_pendaftaran', "Selesai");
	}

	private function _get_datatables_query(){
	    $i = 0;
	    foreach ($this->column_search as $item){
	        if($this->request->getPost('search')['value']){ 
	            if($i===0){
	                $this->dt->groupStart();
	                $this->dt->like($item, $this->request->getPost('search')['value']);
	            }
	            else{
	                $this->dt->orLike($item, $this->request->getPost('search')['value']);
	            }
	            if(count($this->column_search) - 1 == $i)
	                $this->dt->groupEnd();
	        }
	        $i++;
	    }
	     
	    if($this->request->getPost('order')){
	            $this->dt->orderBy($this->column_order[$this->request->getPost('order')['0']['column']], $this->request->getPost('order')['0']['dir']);
	        } 
	    else if(isset($this->order)){
	        $order = $this->order;
	        $this->dt->orderBy(key($order), $order[key($order)]);
	    }
	}

	function get_datatables(){
	    $this->_get_datatables_query();
	    if($this->request->getPost('length') != -1)
	    $this->dt->limit($this->request->getPost('length'), $this->request->getPost('start'));
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

