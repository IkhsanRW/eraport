<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbMapel extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'mapel_id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'mapel_nama' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'mapel_kategori' => [
                'type'       => 'ENUM',
                'constraint' => '"A","B","C1","C2"',
            ],
            'mapel_grade_kelas' => [
                'type'       => 'ENUM',
                'constraint' => '"10","11","12"',
                'null' => true
            ],
            'mapel_jurusan' => [
                'type'       => 'ENUM',
                'constraint' => '"TBSM","RPL"',
                'null' => true
            ],
        ]);
        $this->forge->addKey('mapel_id', true);
        $this->forge->createTable('tb_mapel');
    }

    public function down()
    {
        $this->forge->dropTable('tb_mapel');
    }
}
