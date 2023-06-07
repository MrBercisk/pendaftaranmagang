<?php

namespace App\Models;

use CodeIgniter\Model;

class LaporanModel extends Model
{
    protected $table = 'tbl_laporan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'nama_peserta', 'judul_laporan', 'file_laporan', 'link_drive', 'form_nilai','tbl_nilai.ketepatan_waktu', 'tbl_nilai.kehadiran' , 'tbl_nilai.kemampuan_kerja', 'tbl_nilai.kualitas_kerja',  'tbl_nilai.kerjasama' ,  'tbl_nilai.inisiatif',  'tbl_nilai.rasa_percaya',  'tbl_nilai.penampilan', 'tbl_nilai.patuh_aturan_pkl ','tbl_nilai.rata_rata' ,'tbl_nilai.tanggung_jawab', 'tbl_nilai.tanda_tangan'];
    protected $column_order = [null, 'user_id', 'nama_peserta', 'judul_laporan', 'file_laporan', 'link_drive', 'form_nilai', null];
    protected $column_search = ['user_id', 'nama_peserta', 'judul_laporan', 'file_laporan', 'link_drive', 'form_nilai'];
    protected $order = ['tbl_laporan.id' => 'desc'];
    protected $useTimestamps = true;
    protected $request;
    protected $db;
    protected $dt;

    function __construct()
    {
        parent::__construct();
        $this->db = db_connect();
        $this->request = \Config\Services::request();
        $this->dt = $this->db->table($this->table);
    }

    private function _get_datatables_query()
    {
        $i = 0;
        foreach ($this->column_search as $item) {
            if ($this->request->getVar('search')['value']) {
                if ($item === 'nama_peserta') {
                    $this->dt->groupStart();
                    $this->dt->like('tbl_pendaftaran.nama_peserta', $this->request->getVar('search')['value']);
                    $this->dt->groupEnd();
                } else {
                    if ($i === 0) {
                        $this->dt->groupStart();
                        $this->dt->like($item, $this->request->getVar('search')['value']);
                    } else {
                        $this->dt->orLike($item, $this->request->getVar('search')['value']);
                    }
                    if (count($this->column_search) - 1 == $i)
                        $this->dt->groupEnd();
                }
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


    public function getLaporanById($id)
    {
        return $this->db->table('tbl_laporan')->where('id', $id)->get()->getRow();
    }



    function get_datatables()
    {
        $this->dt->select('tbl_laporan.*, tbl_pendaftaran.nama_peserta, tbl_nilai.ketepatan_waktu, tbl_nilai.kehadiran , tbl_nilai.kemampuan_kerja, tbl_nilai.kualitas_kerja,  tbl_nilai.kerjasama,  tbl_nilai.inisiatif,  tbl_nilai.rasa_percaya,  tbl_nilai.penampilan, tbl_nilai.patuh_aturan_pkl ,tbl_nilai.rata_rata ,tbl_nilai.tanggung_jawab, tbl_nilai.tanda_tangan');
        $this->dt->join('tbl_pendaftaran', 'tbl_laporan.user_id = tbl_pendaftaran.user_id', 'left');
        $this->dt->join('tbl_nilai', 'tbl_laporan.user_id = tbl_nilai.pendaftaran_id', 'left');
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

    public function insertLaporan($data)
    {
        return $this->insert($data);
    }
}