<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTables extends Migration
{
    public function up()
    {
        // Tabel Kelas
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'user_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'nama_kelas' => ['type' => 'VARCHAR', 'constraint' => 255],
            'pin_kelas' => ['type' => 'VARCHAR', 'constraint' => 10, 'unique' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('kelas', true);

        // Tabel Users
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'email' => ['type' => 'VARCHAR', 'constraint' => 255, 'unique' => true],
            'password' => ['type' => 'VARCHAR', 'constraint' => 255],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('users', true);

        // Tabel Tugas
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'kelas_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'nama_tugas' => ['type' => 'VARCHAR', 'constraint' => 255],
            'deskripsi' => ['type' => 'TEXT', 'null' => true],
            'status' => ['type' => 'ENUM', 'constraint' => ['Belum Selesai', 'Selesai'], 'default' => 'Belum Selesai'],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('kelas_id', 'kelas', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tugas', true);
    }

    public function down()
    {
        $this->forge->dropTable('tugas', true);
        $this->forge->dropTable('kelas', true);
        $this->forge->dropTable('users', true);
    }
}