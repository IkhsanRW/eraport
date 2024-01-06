<?php

use App\Models\ModelGuru;
use App\Models\ModelTahunAjar;
use App\Models\ModelWaliKelas;

function getKelas(): ?array
{
    $idAccount = session('log_auth')['accountID'];
    if ($idAccount < 1) {
        return null;
    }
    $modelGuru = new ModelGuru();
    $dtGuru = $modelGuru->where('guru_account_id', $idAccount)->first();
    if (empty($dtGuru)) {
        return null;
    }
    $modelTA = new ModelTahunAjar();
    $dtTA = $modelTA->getTANow();
    if (empty($dtTA)) {
        return null;
    }
    $modelWaliKelas = new ModelWaliKelas();
    $dtWaliKelas = $modelWaliKelas
        ->join('tb_kelas', 'wk_kelas_id = kelas_id')
        ->where('wk_guru_id', $dtGuru['guru_id'])
        ->where('wk_th_id', $dtTA['th_id'])
        ->first();
    return $dtWaliKelas;
}
