<?php

namespace App\Models;

use CodeIgniter\Model;

class ProfileModel extends Model
{
    protected $table = 'tbl_pendaftaran';
    protected $allowedFields = ['foto','keahlian'];
    protected $useTimestamps = true;

    public function updateProfile($userId, $foto)
    {
        $this->set('foto', $foto);
        $this->where('user_id', $userId);
        $this->update();
    }
}
