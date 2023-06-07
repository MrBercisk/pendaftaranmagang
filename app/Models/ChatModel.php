<?php

namespace App\Models;

use CodeIgniter\Model;

class ChatModel extends Model
{
    protected $table = 'chat';
    protected $allowedFields = ['pengirim', 'kategori_id', 'pesan', 'waktu_kirim','dibaca'];

    public function getChatsByUser($user_id)
    {
        $builder = $this->db->table($this->table);
        $builder->select('chat.*, tbl_user.nama as pengirim_nama');
        $builder->join('tbl_pendaftaran', 'tbl_pendaftaran.user_id = chat.pengirim OR tbl_pendaftaran.user_id = chat.penerima');
        $builder->where("(chat.pengirim = $user_id)");
        $builder->orderBy('chat.waktu_kirim', 'DESC');
        $query = $builder->get();
        return $query->getResult();
    }
}