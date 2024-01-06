<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class All extends Seeder
{
    public function run()
    {
        $role = new DataRole($this->config, $this->db);
        $role->run();

        $kelas = new DataKelas($this->config, $this->db);
        $kelas->run();

        $admin = new DataAdmin($this->config, $this->db);
        $admin->run();

        $guru = new DataGuru($this->config, $this->db);
        $guru->run();

        $siswa = new DataSiswa($this->config, $this->db);
        $siswa->run();
    }
}
