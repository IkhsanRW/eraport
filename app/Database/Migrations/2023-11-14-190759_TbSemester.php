<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbSemester extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'semester_id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'semester_nama' => [
                'type'       => 'ENUM',
                'constraint' => '"1","2"',
            ],
            'semester_start_at' => [
                'type'       => 'datetime',
                'null'       => true
            ],
            'semester_finish_at' => [
                'type'       => 'datetime',
                'null'       => true
            ],
            'semester_th_id' => [
                'type'       => 'INT',
                'unsigned'   => true
            ],
            'semester_updated_at' => [
                'type'       => 'datetime',
                'null'       => true
            ],
            'semester_updated_by' => [
                'type'       => 'INT',
                'null'       => true,
                'unsigned'   => true
            ],
            'semester_created_at' => [
                'type'       => 'datetime',
            ],
            'semester_created_by' => [
                'type'       => 'INT',
                'unsigned'   => true
            ],

        ]);
        $this->forge->addKey('semester_id', true);
        $this->forge->addForeignKey('semester_th_id', 'tb_tahun_ajar', 'th_id', 'cascade', 'cascade', 'semester_tahun_ajar_reference');
        $this->forge->addForeignKey('semester_created_by', 'tb_account', 'account_id', 'restrict', 'restrict', 'semester_creator_reference');
        $this->forge->addForeignKey('semester_updated_by', 'tb_account', 'account_id', 'restrict', 'restrict', 'semester_editor_reference');
        $this->forge->createTable('tb_semester');
    }

    public function down()
    {
        $this->forge->dropTable('tb_semester');
    }
}
