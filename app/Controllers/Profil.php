<?php

namespace App\Controllers;

use App\Models\ProfilModel;
use Config\Services;

class Profil extends BaseController
{
	protected $M_profil;
	protected $request;
	protected $form_validation;
	protected $session;

	public function __construct()
	{
		date_default_timezone_set('Asia/Jakarta');
		$this->request = Services::request();
		$this->M_profil = new ProfilModel($this->request);
		$this->form_validation =  \Config\Services::validation();
		$this->session = \Config\Services::session();
	}
	// Halaman Login
	public function index()
	{
		$data['title']   = "E-Magang | Profil";
		$data['page']   = "profil";
		$data['nama']   = $this->session->get('nama');
		$data['email']   = $this->session->get('email');
		return view('v_profil/index', $data);
	}
}
