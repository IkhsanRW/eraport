<?php

use App\Models\ModelSiswa;

function getNisByAccount(): ?int
{
    $idAccount = session('log_auth')['accountID'];
    $modelSiswa = new ModelSiswa();
    $dtSiswa = $modelSiswa->where('siswa_account_id', $idAccount)->first();
    if (empty($dtSiswa)) {
        return null;
    }
    return $dtSiswa['siswa_nis'];
}
