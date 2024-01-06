<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelNilai extends Model
{
    protected $table            = 'tb_nilai';
    protected $primaryKey       = 'nilai_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nilai_id', 'nilai_pengetahuan', 'nilai_keterampilan', 'nilai_siswa_id', 'nilai_gm_id', 'nilai_semester_id', 'nilai_created_by', 'nilai_updated_by'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'nilai_created_at';
    protected $updatedField  = 'nilai_updated_at';

    public $backupkey = "nilai";
}
