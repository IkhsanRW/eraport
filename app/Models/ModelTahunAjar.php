<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelTahunAjar extends Model
{
    protected $table            = 'tb_tahun_ajar';
    protected $primaryKey       = 'th_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'th_id',
        'th_nama',
        'th_updated_at',
        'th_updated_by',
        'th_created_at',
        'th_created_by'
    ];
    public function getTANow()
    {
        return $this->orderBy('th_id', 'desc')->first();
    }

    public function isFinished(): bool
    {
        $semester = new ModelSemester();
        if (empty($this->getTANow())) {
            return true;
        }
        $dt = $semester->where('semester_th_id', $this->getTANow()['th_id'])->where('semester_nama', '2')->first();
        if (!is_null($dt['semester_finish_at'])) {
            return true;
        }
        return false;
    }
    public $backupkey = "tahunajar";
}
