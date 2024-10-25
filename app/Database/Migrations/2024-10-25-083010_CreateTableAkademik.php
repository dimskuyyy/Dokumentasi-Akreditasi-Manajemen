<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableAkademik extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'akademik_id' => [
                'type'              => 'INT',
                'unsigned'          => true,
                'auto_increment'    => true,
            ],
            'akademik_media_id' => [
                'type'          => 'INT',
                'unsigned'      => true,
            ],
            'akademik_user_id' => [
                'type'          => 'INT',
                'unsigned'      => true
            ],
            'akademik_type' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'comment' => '1=Panduan Akademik,2=Etika Akademik',
                'unique'     => true,
            ],
            'akademik_created_at'  => [
                'type'          => 'TIMESTAMP',
                'null'          => true,
            ],
            'akademik_created_by'  => [
                'type'          => 'INT',
                'null'          => true
            ],
            'akademik_updated_at'  => [
                'type'          => 'TIMESTAMP',
                'null'          => true
            ],
            'akademik_updated_by'  => [
                'type'          => 'INT',
                'null'          => true
            ],
            'akademik_deleted_at'   => [
                'type'          => 'TIMESTAMP',
                'null'          => true
            ],
            'akademik_deleted_by'   => [
                'type'          => 'INT',
                'null'          => true
            ]
        ]);

        $this->forge->addKey('akademik_id', true);
        $this->forge->addForeignKey('akademik_user_id', 'user', 'user_id', 'CASCADE', 'CASCADE', 'akademik_user_id');
        $this->forge->addForeignKey('akademik_media_id', 'media', 'media_id', 'CASCADE', 'CASCADE', 'akademik_media_id');
        $this->forge->createTable('akademik');
    }

    public function down()
    {
        $this->forge->dropTable('akademik');
    }
}
