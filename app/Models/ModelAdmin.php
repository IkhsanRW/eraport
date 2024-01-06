<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelAdmin extends Model
{
    protected $table            = 'tb_admin';
    protected $primaryKey       = 'admin_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'admin_id',
        'admin_nama',
        'admin_email',
        'admin_nip',
        'admin_account_id'
    ];

    public $backupkey = "admin";
}
