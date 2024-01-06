<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbOrtuSiswa extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'ortu_id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'ortu_ayah' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'ortu_ibu' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'ortu_alamat' => [
                'type'       => 'TEXT',
            ],
            'ortu_telepon' => [
                'type'       => 'VARCHAR',
                'constraint' => '16',
                'unique'     => true
            ],
            'ortu_pekerjaan_ayah' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'ortu_pekerjaan_ibu' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'ortu_siswa_id' => [
                'type'       => 'INT',
                'unsigned'   => true,
                'unique'     => true
            ],
            'ortu_created_at' => [
                'type'       => 'DATETIME'
            ],
            'ortu_created_by' => [
                'type'       => 'INT',
                'unsigned'   => true
            ],
            'ortu_updated_at' => [
                'type'       => 'DATETIME',
                'null'       => true
            ],
            'ortu_updated_by' => [
                'type'       => 'INT',
                'unsigned'   => true,
                'null'       => true
            ]
        ]);
        $this->forge->addKey('ortu_id', true);
        $this->forge->addForeignKey('ortu_siswa_id', 'tb_siswa', 'siswa_id', 'cascade', 'cascade', 'ortu_siswa_reference');
        $this->forge->addForeignKey('ortu_created_by', 'tb_account', 'account_id', 'restrict', 'restrict', 'ortu_creator_reference');
        $this->forge->addForeignKey('ortu_updated_by', 'tb_account', 'account_id', 'restrict', 'restrict', 'ortu_editor_reference');
        $this->forge->createTable('tb_ortu_siswa');
    }

    public function down()
    {
        $this->forge->dropTable('tb_ortu_siswa');
    }
}
