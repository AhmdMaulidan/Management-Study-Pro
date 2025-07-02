<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterTugasTable extends Migration
{
    public function up()
    {
        // Modifikasi kolom status yang sudah ada
        $this->forge->modifyColumn('tugas', [
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['Belum Dikerjakan', 'Sedang Dikerjakan', 'Selesai'],
                'default' => 'Belum Dikerjakan',
            ],
        ]);

        // Tambahkan kolom baru
        $this->forge->addColumn('tugas', [
            'kategori_kelas' => [
                'type' => 'ENUM',
                'constraint' => ['Kelas A', 'Kelas B', 'Gabungan'],
                'null' => false,
                'after' => 'nama_tugas',
            ],
            'deadline' => [
                'type' => 'DATE',
                'null' => true,
                'after' => 'kategori_kelas',
            ],
            'keterangan' => [
                'type' => 'TEXT',
                'null' => true,
                'after' => 'status',
            ],
            'file_path' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
                'after' => 'keterangan',
            ]
        ]);
    }

    public function down()
    {
        // Hapus kolom yang ditambahkan
        $this->forge->dropColumn('tugas', ['kategori_kelas', 'deadline', 'keterangan', 'file_path']);

        // Kembalikan definisi kolom status ke semula
        $this->forge->modifyColumn('tugas', [
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['Belum Selesai', 'Selesai'],
                'default' => 'Belum Selesai',
            ],
        ]);
    }
}