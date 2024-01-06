<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbGuru extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'guru_id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'guru_nip' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'guru_nama' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'guru_email' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'guru_foto' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'guru_account_id' => [
                'type'           => 'INT',
                'unsigned'       => true,
            ],
            'guru_deleted_at' => [
                'type'       => 'datetime',
                'null'           => true
            ],
            'guru_deleted_by' => [
                'type'       => 'INT',
                'unsigned'       => true,
                'null'           => true
            ],
            'guru_updated_at' => [
                'type'       => 'datetime',
                'null'           => true
            ],
            'guru_updated_by' => [
                'type'       => 'INT',
                'unsigned'       => true,
                'null'           => true
            ],
            'guru_created_at' => [
                'type'       => 'datetime',
                'null'           => true
            ],
            'guru_created_by' => [
                'type'       => 'INT',
                'unsigned'       => true,
                'null'           => true
            ],
        ]);
        $this->forge->addKey('guru_id', true);
        $this->forge->addForeignKey('guru_account_id', 'tb_account', 'account_id', 'restrict', 'restrict', 'guru_account_reference');
        $this->forge->addForeignKey('guru_created_by', 'tb_account', 'account_id', 'restrict', 'restrict', 'guru_creator_reference');
        $this->forge->addForeignKey('guru_updated_by', 'tb_account', 'account_id', 'restrict', 'restrict', 'guru_editor_reference');
        $this->forge->addForeignKey('guru_deleted_by', 'tb_account', 'account_id', 'restrict', 'restrict', 'guru_blocker_reference');
        $this->forge->createTable('tb_guru');
    }

    public function down()
    {
        $this->forge->dropTable('tb_guru');
    }
}
