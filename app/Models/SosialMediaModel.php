<?php

namespace App\Models;

use CodeIgniter\Model;

class SosialMediaModel extends Model
{
    protected $table = 'tbl_sosialmedia';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'website', 'github', 'twitter', 'instagram', 'facebook', 'linkedin'];
    protected $request;
    protected $session;
    protected $db;
    protected $dt;
    

}
