<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateKepanitiaanTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'kepanitiaan_id' => [
                'type'              => 'INT',
                'unsigned'          => true,
                'auto_increment'    => true,
            ],
            'kepanitiaan_nama' => [
                'type'          => 'VARCHAR',
                'constraint'    => '255',
            ],
            'kepanitiaan_sebagai' => [
                'type'          => 'VARCHAR',
                'constraint'    => '255',
            ],
            'kepanitiaan_media_id' => [
                'type'          => 'INT',
                'unsigned'      => true,
            ],
            'kepanitiaan_user_id' => [
                'type'          => 'INT',
                'unsigned'      => true
            ],
            'kepanitiaan_created_at'  => [
                'type'          => 'TIMESTAMP',
                'null'          => true,
            ],
            'kepanitiaan_created_by'  => [
                'type'          => 'INT',
                'null'          => true
            ],
            'kepanitiaan_updated_at'  => [
                'type'          => 'TIMESTAMP',
                'null'          => true
            ],
            'kepanitiaan_updated_by'  => [
                'type'          => 'INT',
                'null'          => true
            ],
            'kepanitiaan_deleted_at'   => [
                'type'          => 'TIMESTAMP',
                'null'          => true
            ],
            'kepanitiaan_deleted_by'   => [
                'type'          => 'INT',
                'null'          => true
            ]
        ]);

        $this->forge->addKey('kepanitiaan_id', true);
        $this->forge->addForeignKey('kepanitiaan_user_id', 'user', 'user_id', 'CASCADE', 'CASCADE', 'kepanitiaan_user_id');
        $this->forge->addForeignKey('kepanitiaan_media_id', 'media', 'media_id', 'CASCADE', 'CASCADE', 'kepanitiaan_media_id');
        $this->forge->createTable('kepanitiaan');
    }

    public function down()
    {
        $this->forge->dropTable('kepanitiaan');
    }
}
