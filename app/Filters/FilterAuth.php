<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class FilterAuth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Do something here
        if(session()->get() != true){
            session()->setFlashdata('pesan','Anda Belum Login', 'Silahkan Login Terlebih Dahulu!!!');
            return redirect()->to(base_url('login'));
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
        if(session()->get() == true){
            session()->setFlashdata('pesan','Anda Belum Login', 'Silahkan Login Terlebih Dahulu!!!');
            return redirect()->to(base_url('login'));
        }
    }
}