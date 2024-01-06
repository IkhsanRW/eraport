<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbSiswa extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'siswa_id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'siswa_nis' => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
                'unique'    => true
            ],
            'siswa_nisn' => [
                'type'       => 'VARCHAR',
                'constraint' => '15',
                'unique'    => true
            ],
            'siswa_nama' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'siswa_tempat_lahir' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'siswa_tanggal_lahir' => [
                'type'       => 'date'
            ],
            'siswa_jenis_kelamin' => [
                'type'       => 'ENUM',
                'constraint' => '"Laki-Laki","Perempuan"',
            ],
            'siswa_agama' => [
                'type'       => 'ENUM',
                'constraint' => '"Islam","Kristen","Katolik","Hindu","Buddha","Khonghucu"',
            ],
            'siswa_status_dalam_keluarga' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'siswa_anak_ke' => [
                'type'       => 'TINYINT',
            ],
            'siswa_alamat' => [
                'type'       => 'VARCHAR',
                'constraint' => '225',
            ],
            'siswa_telepon' => [
                'type'       => 'VARCHAR',
                'constraint' => '15',
                'unique'     => true
            ],
            'siswa_sekolah_asal' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'siswa_alamat_sekolah_asal' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'siswa_kelas_awal' => [
                'type'       => 'TINYINT',
                'unsigned'       => true,
            ],
            'siswa_kelas_sekarang' => [
                'type'       => 'TINYINT',
                'unsigned'       => true,
            ],
            'siswa_foto' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'siswa_account_id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'null'           => true
            ],
            'siswa_tanggal_diterima' => [
                'type'           => 'date',
                'null'           => true
            ],
            'siswa_deleted_at' => [
                'type'       => 'datetime',
                'null'           => true
            ],
            'siswa_deleted_by' => [
                'type'       => 'INT',
                'unsigned'       => true,
                'null'           => true
            ],
            'siswa_updated_at' => [
                'type'       => 'datetime',
                'null'           => true
            ],
            'siswa_updated_by' => [
                'type'       => 'INT',
                'unsigned'       => true,
                'null'           => true
            ],
            'siswa_created_at' => [
                'type'       => 'datetime',
                'null'           => true
            ],
            'siswa_created_by' => [
                'type'       => 'INT',
                'unsigned'       => true,
                'null'           => true
            ],
        ]);
        $this->forge->addKey('siswa_id', true);
        $this->forge->addForeignKey('siswa_account_id', 'tb_account', 'account_id', 'restrict', 'restrict', 'siswa_account_reference');
        $this->forge->addForeignKey('siswa_created_by', 'tb_account', 'account_id', 'restrict', 'restrict', 'siswa_creator_reference');
        $this->forge->addForeignKey('siswa_updated_by', 'tb_account', 'account_id', 'restrict', 'restrict', 'siswa_editor_reference');
        $this->forge->addForeignKey('siswa_deleted_by', 'tb_account', 'account_id', 'restrict', 'restrict', 'siswa_blocker_reference');
        $this->forge->addForeignKey('siswa_kelas_awal', 'tb_kelas', 'kelas_id', 'restrict', 'restrict', 'siswa_kelas_awal_reference');
        $this->forge->addForeignKey('siswa_kelas_sekarang', 'tb_kelas', 'kelas_id', 'restrict', 'restrict', 'siswa_kelas_sekarang_reference');
        $this->forge->createTable('tb_siswa');
    }

    public function down()
    {
        $this->forge->dropTable('tb_siswa');
    }
}
