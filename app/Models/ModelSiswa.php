<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelSiswa extends Model
{
    protected $table            = 'tb_siswa';
    protected $primaryKey       = 'siswa_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'siswa_id',
        'siswa_nis',
        'siswa_nisn',
        'siswa_nama',
        'siswa_tempat_lahir',
        'siswa_tanggal_lahir',
        'siswa_jenis_kelamin',
        'siswa_agama',
        'siswa_status_dalam_keluarga',
        'siswa_anak_ke',
        'siswa_alamat',
        'siswa_telepon',
        'siswa_sekolah_asal',
        'siswa_alamat_sekolah_asal',
        'siswa_kelas_awal',
        'siswa_kelas_sekarang',
        'siswa_foto',
        'siswa_account_id',
        'siswa_tanggal_diterima',
        'siswa_deleted_by',
        'siswa_updated_by',
        'siswa_created_by',
    ];

    protected $useSoftDeletes   = true;
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'siswa_created_at';
    protected $updatedField  = 'siswa_updated_at';
    protected $deletedField  = 'siswa_deleted_at';

    public $backupkey = "siswa";
}
