<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMahasiswaRecords extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'mahasiswa_id' => [
                'type'              => 'INT',
                'unsigned'          => true,
                'auto_increment'    => true,
            ],
            'mahasiswa_record' => [
                'type'          => 'VARCHAR',
                'constraint'    => '255',
            ],
            'mahasiswa_media_id' => [
                'type'          => 'INT',
                'unsigned'      => true,
            ],
            'mahasiswa_user_id' => [
                'type'          => 'INT',
                'unsigned'      => true
            ],
            'mahasiswa_records_type' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'comment' => '1=aktivitas,2=prestasi'
            ],
            'mahasiswa_created_at'  => [
                'type'          => 'TIMESTAMP',
                'null'          => true,
            ],
            'mahasiswa_created_by'  => [
                'type'          => 'INT',
                'null'          => true
            ],
            'mahasiswa_updated_at'  => [
                'type'          => 'TIMESTAMP',
                'null'          => true
            ],
            'mahasiswa_updated_by'  => [
                'type'          => 'INT',
                'null'          => true
            ],
            'mahasiswa_deleted_at'   => [
                'type'          => 'TIMESTAMP',
                'null'          => true
            ],
            'mahasiswa_deleted_by'   => [
                'type'          => 'INT',
                'null'          => true
            ]
        ]);

        $this->forge->addKey('mahasiswa_id',true);
        $this->forge->addForeignKey('mahasiswa_user_id', 'user', 'user_id', 'CASCADE', 'CASCADE', 'mahasiswa_user_id');
        $this->forge->addForeignKey('mahasiswa_media_id', 'media', 'media_id', 'CASCADE', 'CASCADE', 'mahasiswa_media_id');
        $this->forge->createTable('mahasiswa');
    }

    public function down()
    {
        $this->forge->dropTable('mahasiswa');
    }
}
