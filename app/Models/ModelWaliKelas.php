<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelWaliKelas extends Model
{
    protected $table            = 'tb_wali_kelas';
    protected $primaryKey       = 'wk_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'wk_id', 'wk_guru_id', 'wk_kelas_id', 'wk_th_id', 'wk_created_by', 'wk_updated_by'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'wk_created_at';
    protected $updatedField  = 'wk_updated_at';

    public $backupkey = "walikelas";
}
