<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbWaliKelas extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'wk_id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'wk_guru_id' => [
                'type'           => 'INT',
                'unsigned'       => true,
            ],
            'wk_kelas_id' => [
                'type'           => 'TINYINT',
                'unsigned'       => true,
            ],
            'wk_th_id' => [
                'type'           => 'INT',
                'unsigned'       => true,
            ],
            'wk_updated_at' => [
                'type'       => 'datetime',
                'null'       => true
            ],
            'wk_updated_by' => [
                'type'       => 'INT',
                'null'       => true,
                'unsigned'   => true
            ],
            'wk_created_at' => [
                'type'       => 'datetime',
            ],
            'wk_created_by' => [
                'type'       => 'INT',
                'unsigned'   => true
            ],
        ]);
        $this->forge->addKey('wk_id', true);
        $this->forge->addForeignKey('wk_guru_id', 'tb_guru', 'guru_id', 'restrict', 'restrict', 'wk_guru_reference');
        $this->forge->addForeignKey('wk_kelas_id', 'tb_kelas', 'kelas_id', 'restrict', 'restrict', 'wk_kelas_reference');
        $this->forge->addForeignKey('wk_th_id', 'tb_tahun_ajar', 'th_id', 'cascade', 'cascade', 'wk_tahun_ajar_reference');
        $this->forge->addForeignKey('wk_created_by', 'tb_account', 'account_id', 'restrict', 'restrict', 'wk_creator_reference');
        $this->forge->addForeignKey('wk_updated_by', 'tb_account', 'account_id', 'restrict', 'restrict', 'wk_editor_reference');
        $this->forge->createTable('tb_wali_kelas');
    }

    public function down()
    {
        $this->forge->dropTable('tb_wali_kelas');
    }
}
