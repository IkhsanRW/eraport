<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelWali extends Model
{
    protected $table            = 'tb_wali_siswa';
    protected $primaryKey       = 'wali_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'wali_id',
        'wali_nama',
        'wali_alamat',
        'wali_telepon',
        'wali_pekerjaan',
        'wali_siswa_id',
        'wali_updated_at',
        'wali_updated_by',
        'wali_created_at',
        'wali_created_by'
    ];
    public $backupkey = "walisiswa";
}
