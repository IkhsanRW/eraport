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

class Backup extends Seeder
{
    public function run()
    {
        $this->puts(new ModelAccount());
        $this->puts(new ModelAdmin());
        $this->puts(new ModelGuru());
        $this->puts(new ModelSiswa());
        $this->puts(new ModelTahunAjar());
        $this->puts(new ModelSemester());
        $this->puts(new ModelOrtu());
        $this->puts(new ModelWali());
        $this->puts(new ModelMapel());
    }


    private function puts($obj)
    {
        $file = __DIR__ . '/backup' . '/' . $obj->backupkey . '.json';
        try {
            unlink($file);
        } catch (\Throwable $th) {
        }

        file_put_contents($file, json_encode($obj->findAll()));
    }
}
