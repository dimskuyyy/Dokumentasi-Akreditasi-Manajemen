<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableRenstraAnggaran extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'ra_id' => [
                'type'              => 'INT',
                'unsigned'          => true,
                'auto_increment'    => true,
            ],
            'ra_tahun' => [
                'type'          => 'YEAR',
            ],
            'ra_media_id' => [
                'type'          => 'INT',
                'unsigned'      => true,
            ],
            'ra_user_id' => [
                'type'          => 'INT',
                'unsigned'      => true
            ],
            'ra_type' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'comment' => '1=renstra,2=anggaran'
            ],
            'ra_created_at'  => [
                'type'          => 'TIMESTAMP',
                'null'          => true,
            ],
            'ra_created_by'  => [
                'type'          => 'INT',
                'null'          => true
            ],
            'ra_updated_at'  => [
                'type'          => 'TIMESTAMP',
                'null'          => true
            ],
            'ra_updated_by'  => [
                'type'          => 'INT',
                'null'          => true
            ],
            'ra_deleted_at'   => [
                'type'          => 'TIMESTAMP',
                'null'          => true
            ],
            'ra_deleted_by'   => [
                'type'          => 'INT',
                'null'          => true
            ]
        ]);

        $this->forge->addKey('ra_id',true);
        $this->forge->addForeignKey('ra_user_id', 'user', 'user_id', 'CASCADE', 'CASCADE', 'ra_user_id');
        $this->forge->addForeignKey('ra_media_id', 'media', 'media_id', 'CASCADE', 'CASCADE', 'ra_media_id');
        $this->forge->createTable('renstra_anggaran');
    }

    public function down()
    {
        $this->forge->dropTable('renstra_anggaran');
    }
}
