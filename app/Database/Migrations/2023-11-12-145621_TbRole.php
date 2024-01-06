<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbRole extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'role_id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'role_name' => [
                'type'       => 'enum',
                'constraint' => '"Guru Mapel","Admin","Siswa"',
            ],

        ]);
        $this->forge->addKey('role_id', true);
        $this->forge->createTable('tb_role');
    }

    public function down()
    {
        $this->forge->dropTable('tb_role');
    }
}
