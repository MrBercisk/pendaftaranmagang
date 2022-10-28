<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KalenderModel;

class Kalender extends BaseController
{
	public function __construct()
	{
		helper(["html"]);
	}
	public function index()
	{
		return view('/v_kalender/kalender');
	}

	public function loadData()
	{
		$event = new KalenderModel();
		// on page load this ajax code block will be run
		$data = $event->where([
			'tgl_mulai >=' => $this->request->getVar('tgl_mulai'),
			'tgl_selesai <='=> $this->request->getVar('tgl_selesai')
		])->findAll();

		return json_encode($data);
	}

	public function ajax()
	{
		$event = new KalenderModel();

		switch ($this->request->getVar('type')) {

				// For add EventModel
			case 'add':
				$data = [
					'judul' => $this->request->getVar('judul'),
					'tgl_mulai' => $this->request->getVar('tgl_mulai'),
					'tgl_selesai' => $this->request->getVar('tgl_selesai'),
				];
				$event->insert($data);
				return json_encode($event);
				break;

				// For update EventModel        
			case 'update':
				$data = [
					'judul' => $this->request->getVar('judul'),
					'tgl_mulai' => $this->request->getVar('tgl_mulai'),
					'tgl_selesai' => $this->request->getVar('tgl_selesai'),
				];

				$event_id = $this->request->getVar('id');
				
				$event->update($event_id, $data);

				return json_encode($event);
				break;

				// For delete EventModel    
			case 'delete':

				$event_id = $this->request->getVar('id');

				$event->delete($event_id);

				return json_encode($event);
				break;

			default:
				break;
		}
	}
}