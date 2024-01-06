<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelSemester extends Model
{
    protected $table            = 'tb_semester';
    protected $primaryKey       = 'semester_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'semester_id',
        'semester_nama',
        'semester_start_at',
        'semester_finish_at',
        'semester_th_id',
        'semester_created_at',
        'semester_created_by',
        'semester_updated_at',
        'semester_updated_by'
    ];

    public $backupkey = "semester";

    public function getActiveSemester()
    {
        $modelTA = new ModelTahunAjar();
        $dtTA = $modelTA->getTANow();
        if (empty($dtTA)) {
            return null;
        }
        return $this->where('semester_th_id', $dtTA['th_id'])
            ->where('semester_start_at is not null')
            ->where('semester_finish_at is null')
            ->first();
    }
}
