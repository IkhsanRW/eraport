<?php

namespace App\Database\Seeds;

use App\Models\ModelKelas;
use CodeIgniter\Database\Seeder;

class DataKelas extends Seeder
{
    public function run()
    {
        // Data ini fixed mohon jangan dirubah
        $dataKelas = [
            [
                "kelas_id" => "1",
                "kelas_grade" => "10",
                "kelas_nama" => "X RPL",
                "kelas_jurusan" => "RPL"
            ],
            [
                "kelas_id" => "2",
                "kelas_grade" => "11",
                "kelas_nama" => "XI RPL",
                "kelas_jurusan" => "RPL"
            ],
            [
                "kelas_id" => "3",
                "kelas_grade" => "12",
                "kelas_nama" => "XII RPL",
                "kelas_jurusan" => "RPL"
            ],
            [
                "kelas_id" => "4",
                "kelas_grade" => "10",
                "kelas_nama" => "X TBSM",
                "kelas_jurusan" => "TBSM"
            ],
            [
                "kelas_id" => "5",
                "kelas_grade" => "11",
                "kelas_nama" => "XI TBSM",
                "kelas_jurusan" => "TBSM"
            ],
            [
                "kelas_id" => "6",
                "kelas_grade" => "12",
                "kelas_nama" => "XII TBSM",
                "kelas_jurusan" => "TBSM"
            ]
        ];
        $kelas = new ModelKelas();
        $this->db->table($kelas->getTB())->emptyTable();
        foreach ($dataKelas as $dt) {
            $kelas->insert($dt);
        }
    }
}
