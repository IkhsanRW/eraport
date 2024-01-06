<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelMapel extends Model
{
    protected $table            = 'tb_mapel';
    protected $primaryKey       = 'mapel_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['mapel_id', 'mapel_nama', 'mapel_grade_kelas', 'mapel_kategori', 'mapel_jurusan'];

    public $backupkey = "mapel";
}
