<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbNilai extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'nilai_id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nilai_pengetahuan' => [
                'type'           => 'TINYINT',
                'unsigned'       => true,
                'default'        => 0
            ],
            'nilai_keterampilan' => [
                'type'           => 'TINYINT',
                'unsigned'       => true,
                'default'        => 0
            ],
            'nilai_siswa_id' => [
                'type'           => 'INT',
                'unsigned'       => true,
            ],
            'nilai_gm_id' => [
                'type'           => 'INT',
                'unsigned'       => true,
            ],
            'nilai_semester_id' => [
                'type'           => 'INT',
                'unsigned'       => true,
            ],
            'nilai_updated_at' => [
                'type'       => 'datetime',
                'null'       => true
            ],
            'nilai_updated_by' => [
                'type'       => 'INT',
                'unsigned'   => true
            ],
            'nilai_created_at' => [
                'type'       => 'datetime',
            ],
            'nilai_created_by' => [
                'type'       => 'INT',
                'unsigned'   => true
            ],
        ]);
        $this->forge->addKey('nilai_id', true);
        $this->forge->addForeignKey('nilai_siswa_id', 'tb_siswa', 'siswa_id', 'restrict', 'restrict', 'nilai_siswa_reference');
        $this->forge->addForeignKey('nilai_semester_id', 'tb_semester', 'semester_id', 'cascade', 'cascade', 'nilai_semester_reference');
        $this->forge->addForeignKey('nilai_gm_id', 'tb_guru_mapel', 'gm_id', 'restrict', 'restrict', 'nilai_gm_reference');
        $this->forge->addForeignKey('nilai_created_by', 'tb_account', 'account_id', 'restrict', 'restrict', 'nilai_creator_reference');
        $this->forge->addForeignKey('nilai_updated_by', 'tb_account', 'account_id', 'restrict', 'restrict', 'nilai_editor_reference');
        $this->forge->createTable('tb_nilai');
    }

    public function down()
    {
        $this->forge->dropTable('tb_nilai');
    }
}
