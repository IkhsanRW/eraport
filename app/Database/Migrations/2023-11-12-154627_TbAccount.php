<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbAccount extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'account_id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'account_username' => [
                'type'       => 'VARCHAR',
                'constraint' => '16',
            ],
            'account_password' => [
                'type'       => 'VARCHAR',
                'constraint' => '32',
            ],
            'account_role_id' => [
                'type'           => 'INT',
                'unsigned'       => true,
            ],
            'account_created_at' => [
                'type'       => 'datetime',
            ],
            'account_created_by' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'null'           => true
            ],
            'account_updated_at' => [
                'type' => 'datetime',
                'null' => true,
            ],
            'account_deleted_at' => [
                'type' => 'datetime',
                'null' => true
            ],
            'account_deleted_by' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'null'           => true
            ],
        ]);
        $this->forge->addKey('account_id', true);
        $this->forge->addForeignKey('account_role_id', 'tb_role', 'role_id', 'restrict', 'restrict', 'account_role_reference');
        $this->forge->addForeignKey('account_created_by', 'tb_account', 'account_id', 'restrict', 'restrict', 'account_creator_reference');
        $this->forge->addForeignKey('account_deleted_by', 'tb_account', 'account_id', 'restrict', 'restrict', 'account_blocker_reference');
        $this->forge->createTable('tb_account');
    }

    public function down()
    {
        $this->forge->dropTable('tb_account');
    }
}
