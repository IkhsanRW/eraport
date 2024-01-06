<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbGuruMapel extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'gm_id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'gm_guru_id' => [
                'type'           => 'INT',
                'unsigned'       => true,
            ],
            'gm_mapel_id' => [
                'type'           => 'INT',
                'unsigned'       => true,
            ],
            'gm_kelas_id' => [
                'type'           => 'TINYINT',
                'unsigned'       => true,
            ],
            'gm_th_id' => [
                'type'           => 'INT',
                'unsigned'       => true,
            ],
            'gm_updated_at' => [
                'type'       => 'datetime',
                'null'       => true
            ],
            'gm_updated_by' => [
                'type'       => 'INT',
                'unsigned'   => true
            ],
            'gm_created_at' => [
                'type'       => 'datetime',
            ],
            'gm_created_by' => [
                'type'       => 'INT',
                'unsigned'   => true
            ],
        ]);
        $this->forge->addKey('gm_id', true);
        $this->forge->addForeignKey('gm_guru_id', 'tb_guru', 'guru_id', 'restrict', 'restrict', 'gm_guru_reference');
        $this->forge->addForeignKey('gm_kelas_id', 'tb_kelas', 'kelas_id', 'restrict', 'restrict', 'gm_kelas_reference');
        $this->forge->addForeignKey('gm_mapel_id', 'tb_mapel', 'mapel_id', 'restrict', 'restrict', 'gm_mapel_reference');
        $this->forge->addForeignKey('gm_th_id', 'tb_tahun_ajar', 'th_id', 'cascade', 'cascade', 'gm_tahun_ajar_reference');
        $this->forge->addForeignKey('gm_created_by', 'tb_account', 'account_id', 'restrict', 'restrict', 'gm_creator_reference');
        $this->forge->addForeignKey('gm_updated_by', 'tb_account', 'account_id', 'restrict', 'restrict', 'gm_editor_reference');
        $this->forge->createTable('tb_guru_mapel');
    }

    public function down()
    {
        $this->forge->dropTable('tb_guru_mapel');
    }
}
