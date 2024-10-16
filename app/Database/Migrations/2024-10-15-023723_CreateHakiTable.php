<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateHakiTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'haki_id' => [
                'type'              => 'INT',
                'unsigned'          => true,
                'auto_increment'    => true,
            ],
            'haki_nama' => [
                'type'          => 'VARCHAR',
                'constraint'    => '255',
            ],
            'haki_klasifikasi' => [
                'type'          => 'VARCHAR',
                'constraint'    => '255',
            ],
            'haki_nomor' => [
                'type'          => 'VARCHAR',
                'constraint'    => '255',
            ],
            'haki_media_id' => [
                'type'          => 'INT',
                'unsigned'      => true,
            ],
            'haki_user_id' => [
                'type'          => 'INT',
                'unsigned'      => true
            ],
            'haki_created_at'  => [
                'type'          => 'TIMESTAMP',
                'null'          => true,
            ],
            'haki_created_by'  => [
                'type'          => 'INT',
                'null'          => true
            ],
            'haki_updated_at'  => [
                'type'          => 'TIMESTAMP',
                'null'          => true
            ],
            'haki_updated_by'  => [
                'type'          => 'INT',
                'null'          => true
            ],
            'haki_deleted_at'   => [
                'type'          => 'TIMESTAMP',
                'null'          => true
            ],
            'haki_deleted_by'   => [
                'type'          => 'INT',
                'null'          => true
            ]
        ]);

        $this->forge->addKey('haki_id',true);
        $this->forge->addForeignKey('haki_user_id', 'user', 'user_id', 'CASCADE', 'CASCADE', 'haki_user_id');
        $this->forge->addForeignKey('haki_media_id', 'media', 'media_id', 'CASCADE', 'CASCADE', 'haki_media_id');
        $this->forge->createTable('haki');
    }

    public function down()
    {
        $this->forge->dropTable('haki');
    }
}
