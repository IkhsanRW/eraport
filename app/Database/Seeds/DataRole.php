<?php

namespace App\Database\Seeds;

use App\Models\ModelRole;
use CodeIgniter\Database\Seeder;

class DataRole extends Seeder
{
    public function run()
    {
        // Data ini fixed tidak boleh dirubah!
        $data = [
            [
                'role_id' => '1',
                'role_name' => 'Admin'
            ],
            [
                'role_id' => '2',
                'role_name' => 'Guru Mapel'
            ],
            [
                'role_id' => '3',
                'role_name' => 'Siswa'
            ],
        ];
        $modelRole = new ModelRole();
        $this->db->table($modelRole->getTBName())->emptyTable();
        foreach ($data as $dt) {
            $modelRole->insert($dt);
        }
    }
}
