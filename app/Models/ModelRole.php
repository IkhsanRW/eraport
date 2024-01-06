<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelRole extends Model
{
    protected $table            = 'tb_role';
    protected $primaryKey       = 'role_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['role_id', 'role_name'];

    function getTBName(): string
    {
        return $this->table;
    }
}
