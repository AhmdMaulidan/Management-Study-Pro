<?php

namespace App\Models;

use CodeIgniter\Model;

class KelasModel extends Model
{
    protected $table = 'kelas';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'nama_kelas', 'pin_kelas'];
    protected $useTimestamps = true;
}