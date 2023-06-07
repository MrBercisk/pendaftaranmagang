<?php

namespace App\Models;

use CodeIgniter\Model;

class MentorLaporanModel extends Model
{
    protected $table = 'tbl_laporan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['tbl_pendaftaran.nama_peserta', 'tbl_pendaftaran.user_id', 'tbl_pendaftaran.jenis_permohonan', 'tbl_pendaftaran.status_permohonan', 'judul_laporan',  'link_drive', 'form_nilai', 'surat_selesai_magang'];
    protected $column_order = [null, 'tbl_pendaftaran.nama_peserta',  'tbl_pendaftaran.status_permohonan','tbl_pendaftaran.jenis_permohonan', 'judul_laporan', 'link_drive', 'form_nilai', 'form_nilai','surat_selesai_magang'];
    protected $column_search = ['judul_laporan', 'link_drive', 'form_nilai'];
    protected $order = ['tbl_laporan.id' => 'desc'];
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
        $this->dt = $this->db->table($this->table)
            ->select('tbl_laporan.id, tbl_laporan.judul_laporan, tbl_laporan.link_drive, tbl_laporan.form_nilai, tbl_laporan.surat_selesai_magang, tbl_pendaftaran.nama_peserta, tbl_pendaftaran.jenis_permohonan, tbl_pendaftaran.status_permohonan')
            ->join('tbl_pendaftaran', 'tbl_pendaftaran.user_id = tbl_laporan.user_id', 'left');
        // tambahkan kondisi where
        $userModel = new UserModel($this->request);
        $user_id = $userModel->where('email', $this->session->get('email'))->first()['id'];
        $this->dt->where('tbl_pendaftaran.kategori_id', $userModel->find($user_id)['kategori_id']);
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


    public function getLaporanById($id)
    {
        return $this->db->table('tbl_laporan')->where('id', $id)->get()->getRow();
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

    public function insertLaporan($data)
    {
        return $this->insert($data);
    }
}
