<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAgenda extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'kegiatan_id' => [
                'type'              => 'INT',
                'unsigned'          => true,
                'auto_increment'    => true,
            ],
            'kegiatan_nama' => [
                'type'          => 'VARCHAR',
                'constraint'    => '255',
            ],
            'kegiatan_sebagai' => [
                'type'          => 'VARCHAR',
                'constraint'    => '255',
                'null'          => true
            ],
            'kegiatan_media_id' => [
                'type'          => 'INT',
                'unsigned'      => true,
            ],
            'kegiatan_user_id' => [
                'type'          => 'INT',
                'unsigned'      => true
            ],
            'kegiatan_tahun' => [
                'type' => 'YEAR',
                'comment' => 'Khusus Dekan, Kajur, Koor',
                'null'  => true
            ],
            'kegiatan_dosen' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'comment' => '1=luar kampus,2=dalam kampus',
                'null'  => true
            ],
            'kegiatan_created_at'  => [
                'type'          => 'TIMESTAMP',
                'null'          => true,
            ],
            'kegiatan_created_by'  => [
                'type'          => 'INT',
                'null'          => true
            ],
            'kegiatan_updated_at'  => [
                'type'          => 'TIMESTAMP',
                'null'          => true
            ],
            'kegiatan_updated_by'  => [
                'type'          => 'INT',
                'null'          => true
            ],
            'kegiatan_deleted_at'   => [
                'type'          => 'TIMESTAMP',
                'null'          => true
            ],
            'kegiatan_deleted_by'   => [
                'type'          => 'INT',
                'null'          => true
            ]
        ]);

        $this->forge->addKey('kegiatan_id',true);
        $this->forge->addForeignKey('kegiatan_user_id', 'user', 'user_id', 'CASCADE', 'CASCADE', 'kegiatan_user_id');
        $this->forge->addForeignKey('kegiatan_media_id', 'media', 'media_id', 'CASCADE', 'CASCADE', 'kegiatan_media_id');
        $this->forge->createTable('kegiatan');
    }

    public function down()
    {
        $this->forge->dropTable('kegiatan');
    }
}
