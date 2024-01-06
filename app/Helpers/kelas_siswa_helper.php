<?php

use App\Models\ModelKelas;
use App\Models\ModelNilai;
use App\Models\ModelSiswa;

function getKelasSekarang(): ?array
{
    $idAccount = session('log_auth')['accountID'];
    if ($idAccount < 1) {
        return null;
    }
    $modelSiswa = new ModelSiswa();
    $dtSiswa = $modelSiswa->where('siswa_account_id', $idAccount)->first();
    if (empty($dtSiswa)) {
        return null;
    }
    if (is_null($dtSiswa['siswa_kelas_sekarang'])) {
        return null;
    }
    $modelKelas = new ModelKelas();
    $dtKelas = $modelKelas->find($dtSiswa['siswa_kelas_sekarang']);
    if (empty($dtKelas)) {
        return null;
    }
    return $dtKelas;
}

function getAllKelas(): ?array
{
    $idAccount = session('log_auth')['accountID'];
    if ($idAccount < 1) {
        return [];
    }
    $modelSiswa = new ModelSiswa();
    $dtSiswa = $modelSiswa->where('siswa_account_id', $idAccount)->first();
    if (empty($dtSiswa)) {
        return [];
    }
    $modelNilai =  new ModelNilai();
    return $modelNilai->select('gm_kelas_id, gm_th_id, kelas_nama, th_nama')
        ->join('tb_guru_mapel', 'nilai_gm_id = gm_id')
        ->join('tb_kelas', 'gm_kelas_id = kelas_id')
        ->join('tb_tahun_ajar', 'gm_th_id = th_id')
        ->groupBy('gm_th_id')
        ->orderBy('gm_th_id', 'asc')
        ->findAll();
}
