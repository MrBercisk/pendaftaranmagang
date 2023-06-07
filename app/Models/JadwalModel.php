<?php

namespace App\Models;

use CodeIgniter\Model;


class JadwalModel extends Model
{
    protected $table = 'tbl_jadwal';
    protected $allowedFields = ['pendaftaran_id', 'tbl_pendaftaran.nama_peserta', 'kategori_id', 'tanggal_mulai', 'tanggal_selesai', 'jam_bimbingan', 'tanggal_bimbingan'];
    protected $column_order = [null, 'tbl_pendaftaran.nama_peserta', 'tbl_pendaftaran.judul', 'jam_bimbingan', 'tanggal_mulai', 'tanggal_selesai', 'tanggal_bimbingan'];
    protected $column_search = ['nama_peserta', 'judul', 'tanggal_mulai', 'tanggal_selesai', 'tanggal_bimbingan'];
    protected $order = ['tbl_jadwal.tanggal_mulai' => 'desc'];
    protected $request;
    protected $db;
    protected $dt;

    function __construct()
    {
        parent::__construct();
        $this->db = db_connect();
        $this->request = \Config\Services::request();
        $this->dt = $this->db->table($this->table)
            ->join('tbl_pendaftaran', 'tbl_pendaftaran.id = tbl_jadwal.pendaftaran_id', 'left')
            ->join('tbl_kategori', 'tbl_kategori.id = tbl_pendaftaran.kategori_id', 'left');
    }
    function get_datatables()
    {
        $this->_get_datatables_query();
        if ($this->request->getPost('length') != -1)
            $this->dt->limit($this->request->getVar('length'), $this->request->getVar('start'));
        $query = $this->dt->get();
        return $query->getResult();
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

    public function getEvents()
    {
        $builder = $this->db->table('tbl_jadwal');
        $builder->select('tbl_jadwal.*, tbl_pendaftaran.nama_peserta, tbl_pendaftaran.judul');
        $builder->join('tbl_pendaftaran', 'tbl_pendaftaran.id = tbl_jadwal.pendaftaran_id');
        $query = $builder->get();
        return $query->getResult();
    }
    public function checkExistData($pendaftaran_id)
    {
        return $this->where('pendaftaran_id', $pendaftaran_id)->get()->getRow();
    }
    public function checkDatesExist($pendaftaran_id)
    {
        $jadwal = $this->db->table('tbl_jadwal')
            ->where('pendaftaran_id', $pendaftaran_id)
            ->get()
            ->getRow();
    
        if ($jadwal) {
            return true; // Tanggal_mulai dan tanggal_selesai sudah ada
        } else {
            return false; // Tanggal_mulai dan tanggal_selesai belum ada
        }
    }
    
    public function getTanggalBimbingan($user_id)
    {
        $db = db_connect();
        $builder = $db->table('tbl_jadwal');
        $builder->select('tanggal_bimbingan');
        $builder->where('user_id', $user_id);
        $builder->orderBy('tanggal_bimbingan', 'desc');
        $builder->limit(1);
        $query = $builder->get();
        $result = $query->getRow();
        return $result ? $result->tanggal_bimbingan : null;
    }
}
