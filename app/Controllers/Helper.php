<?php

namespace App\Controllers;

use App\Models\InformasiModel;
use App\Models\PendaftaranModel;
use Config\Services;


class Helper extends BaseController
{
    protected $M_pendaftaran;
    protected $session;
    protected $request;
    protected $db;

    public function __construct()
    {
        $this->request = Services::request();
        $this->db = \Config\Database::connect();

        $this->M_pendaftaran = new PendaftaranModel($this->request);
        $this->session = \Config\Services::session();
    }

    public function template_data()
    {
        //Cek pendaftaran berdasarkan user_id
        $user_id = $this->session->get('id');
        $pendaftaran = $this->M_pendaftaran->where('user_id', $user_id)->first();

        $builder = $this->db->table('tbl_pendaftaran');
        $builder->where('user_id', $user_id);
        $query = $builder->get();
        $data['pendaftaran'] = $query->getResult();
        

        return $data;
    }
}
