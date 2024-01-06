<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelOrtu extends Model
{
    protected $table            = 'tb_ortu_siswa';
    protected $primaryKey       = 'ortu_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'ortu_id',
        'ortu_ayah',
        'ortu_ibu',
        'ortu_alamat',
        'ortu_telepon',
        'ortu_pekerjaan_ayah',
        'ortu_pekerjaan_ibu',
        'ortu_siswa_id',
        'ortu_updated_at',
        'ortu_updated_by',
        'ortu_created_at',
        'ortu_created_by'
    ];

    public $backupkey = "ortu";
}
