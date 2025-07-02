<?php

namespace App\Models;

use CodeIgniter\Model;

class TugasModel extends Model
{
    protected $table = 'tugas';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'kelas_id',
        'nama_tugas',
        'kategori_kelas',
        'deadline',
        'deskripsi',
        'status',
        'keterangan',
        'file_path'
    ];
    protected $useTimestamps = true;
}