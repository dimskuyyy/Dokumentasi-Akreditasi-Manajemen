<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePengajaranDosen extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'pengajaran_id' => [
                'type'              => 'INT',
                'unsigned'          => true,
                'auto_increment'    => true,
            ],
            'pengajaran_nama' => [
                'type'          => 'VARCHAR',
                'constraint'    => '255',
            ],
            'pengajaran_media_id' => [
                'type'          => 'INT',
                'unsigned'      => true,
            ],
            'pengajaran_user_id' => [
                'type'          => 'INT',
                'unsigned'      => true
            ],
            'pengajaran_created_at'  => [
                'type'          => 'TIMESTAMP',
                'null'          => true,
            ],
            'pengajaran_created_by'  => [
                'type'          => 'INT',
                'null'          => true
            ],
            'pengajaran_updated_at'  => [
                'type'          => 'TIMESTAMP',
                'null'          => true
            ],
            'pengajaran_updated_by'  => [
                'type'          => 'INT',
                'null'          => true
            ],
            'pengajaran_deleted_at'   => [
                'type'          => 'TIMESTAMP',
                'null'          => true
            ],
            'pengajaran_deleted_by'   => [
                'type'          => 'INT',
                'null'          => true
            ]
        ]);

        $this->forge->addKey('pengajaran_id',true);
        $this->forge->addForeignKey('pengajaran_user_id', 'user', 'user_id', 'CASCADE', 'CASCADE', 'pengajaran_user_id');
        $this->forge->addForeignKey('pengajaran_media_id', 'media', 'media_id', 'CASCADE', 'CASCADE', 'pengajaran_media_id');
        $this->forge->createTable('pengajaran');
    }

    public function down()
    {
        $this->forge->dropTable('pengajaran');
    }
}
