<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbAdmin extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'admin_id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'admin_nama' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'admin_email' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'admin_nip' => [
                'type'       => 'VARCHAR',
                'constraint' => '16',
            ],
            'admin_account_id' => [
                'type'           => 'INT',
                'unsigned'       => true
            ],
        ]);
        $this->forge->addKey('admin_id', true);
        $this->forge->addForeignKey('admin_account_id', 'tb_account', 'account_id', 'restrict', 'restrict', 'admin_account_reference');
        $this->forge->createTable('tb_admin');
    }

    public function down()
    {
        $this->forge->dropTable('tb_admin');
    }
}
