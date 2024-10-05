<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAgenda extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'agenda_id' => [
                'type'              => 'INT',
                'unsigned'          => true,
                'auto_increment'    => true,
            ],
            'agenda_nama' => [
                'type'          => 'VARCHAR',
                'constraint'    => '255',
            ],
            'agenda_sebagai' => [
                'type'          => 'VARCHAR',
                'constraint'    => '255',
            ],
            'agenda_media_id' => [
                'type'          => 'INT',
                'unsigned'      => true,
            ],
            'agenda_user_id' => [
                'type'          => 'INT',
                'unsigned'      => true
            ],
            'agenda_type' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'comment' => '1=kegiatan,2=kepanitiaan'
            ],
            'agenda_created_at'  => [
                'type'          => 'TIMESTAMP',
                'null'          => true,
            ],
            'agenda_created_by'  => [
                'type'          => 'INT',
                'null'          => true
            ],
            'agenda_updated_at'  => [
                'type'          => 'TIMESTAMP',
                'null'          => true
            ],
            'agenda_updated_by'  => [
                'type'          => 'INT',
                'null'          => true
            ],
            'agenda_deleted_at'   => [
                'type'          => 'TIMESTAMP',
                'null'          => true
            ],
            'agenda_deleted_by'   => [
                'type'          => 'INT',
                'null'          => true
            ]
        ]);

        $this->forge->addKey('agenda_id',true);
        $this->forge->addForeignKey('agenda_user_id', 'user', 'user_id', 'CASCADE', 'CASCADE', 'agenda_user_id');
        $this->forge->addForeignKey('agenda_media_id', 'media', 'media_id', 'CASCADE', 'CASCADE', 'agenda_media_id');
        $this->forge->createTable('agenda');
    }

    public function down()
    {
        $this->forge->dropTable('agenda');
    }
}
