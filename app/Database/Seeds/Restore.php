<?php

namespace App\Database\Seeds;

use App\Models\ModelAccount;
use App\Models\ModelAdmin;
use App\Models\ModelGuru;
use App\Models\ModelMapel;
use App\Models\ModelOrtu;
use App\Models\ModelSemester;
use App\Models\ModelSiswa;
use App\Models\ModelTahunAjar;
use App\Models\ModelWali;
use CodeIgniter\Database\Seeder;

class Restore extends Seeder
{
    private $tmp_fail_truncate = [];
    public function run()
    {
        // Run Seed for Fix data
        try {
            $dataRole = new DataRole($this->config);
            $dataRole->run();
            print("Restore data role berhasil\n\n");
        } catch (\Throwable $th) {
            print("Restore data role gagal\n\n");
        }

        try {
            $dataKelas = new DataKelas($this->config);
            $dataKelas->run();
            print("Restore data kelas berhasil\n\n");
        } catch (\Throwable $th) {
            print("Restore data kelas gagal\n\n");
        }


        // Restore All Data
        $this->restore(new ModelAccount());
        $this->restore(new ModelAdmin());
        $this->restore(new ModelGuru());
        $this->restore(new ModelSiswa());
        $this->restore(new ModelTahunAjar());
        $this->restore(new ModelSemester());
        $this->restore(new ModelOrtu());
        $this->restore(new ModelWali());
        $this->restore(new ModelMapel());
    }

    private function restore($model)
    {
        try {
            $file = __DIR__ . '\backup/' . $model->backupkey . '.json';
            foreach (json_decode(file_get_contents($file), true) as $dt) {
                $model->insert($dt);
            }
            print("Restore " . $model->backupkey . " Berhasil\n\n");
        } catch (\Throwable $th) {
            print("Restore " . $model->backupkey . " Gagal : " . $th->getMessage() . "\n\n");
        }
    }
}
