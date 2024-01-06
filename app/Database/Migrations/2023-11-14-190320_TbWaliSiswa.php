<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbWaliSiswa extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'wali_id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'wali_nama' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'wali_alamat' => [
                'type'       => 'TEXT',
            ],
            'wali_telepon' => [
                'type'       => 'VARCHAR',
                'constraint' => '16',
                'unique'     => true
            ],
            'wali_pekerjaan' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'wali_siswa_id' => [
                'type'       => 'INT',
                'unsigned'   => true,
                'unique'     => true
            ],
            'wali_created_at' => [
                'type'       => 'DATETIME'
            ],
            'wali_created_by' => [
                'type'       => 'INT',
                'unsigned'   => true
            ],
            'wali_updated_at' => [
                'type'       => 'DATETIME',
                'null'       => true
            ],
            'wali_updated_by' => [
                'type'       => 'INT',
                'unsigned'   => true,
                'null'       => true
            ]
        ]);
        $this->forge->addKey('wali_id', true);
        $this->forge->addForeignKey('wali_siswa_id', 'tb_siswa', 'siswa_id', 'cascade', 'cascade', 'wali_siswa_reference');
        $this->forge->addForeignKey('wali_created_by', 'tb_account', 'account_id', 'restrict', 'restrict', 'wali_creator_reference');
        $this->forge->addForeignKey('wali_updated_by', 'tb_account', 'account_id', 'restrict', 'restrict', 'wali_editor_reference');
        $this->forge->createTable('tb_wali_siswa');
    }

    public function down()
    {
        $this->forge->dropTable('tb_wali_siswa');
    }
}
