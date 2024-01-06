<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelGuruMapel extends Model
{
    protected $table            = 'tb_guru_mapel';
    protected $primaryKey       = 'gm_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'gm_id', 'gm_guru_id', 'gm_mapel_id', 'gm_kelas_id', 'gm_th_id', 'gm_created_by', 'gm_updated_by'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'gm_created_at';
    protected $updatedField  = 'gm_updated_at';

    public $backupkey = "gurumapel";
}
