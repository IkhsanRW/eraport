<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelGuru extends Model
{
    protected $table            = 'tb_guru';
    protected $primaryKey       = 'guru_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'guru_id',
        'guru_nip',
        'guru_nama',
        'guru_email',
        'guru_foto',
        'guru_account_id',
        'guru_deleted_at',
        'guru_deleted_by',
        'guru_updated_at',
        'guru_updated_by',
        'guru_created_at',
        'guru_created_by'
    ];

    public $backupkey = "guru";
}
