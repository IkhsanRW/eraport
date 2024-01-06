<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbTahunAjar extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'th_id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'th_nama' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
            ],
            'th_updated_at' => [
                'type'       => 'datetime',
                'null'       => true
            ],
            'th_updated_by' => [
                'type'       => 'INT',
                'null'       => true,
                'unsigned'   => true
            ],
            'th_created_at' => [
                'type'       => 'datetime',
            ],
            'th_created_by' => [
                'type'       => 'INT',
                'unsigned'   => true
            ],

        ]);
        $this->forge->addKey('th_id', true);
        $this->forge->addForeignKey('th_created_by', 'tb_account', 'account_id', 'restrict', 'restrict', 'th_creator_reference');
        $this->forge->addForeignKey('th_updated_by', 'tb_account', 'account_id', 'restrict', 'restrict', 'th_editor_reference');
        $this->forge->createTable('tb_tahun_ajar');
    }

    public function down()
    {
        $this->forge->dropTable('tb_tahun_ajar');
    }
}
