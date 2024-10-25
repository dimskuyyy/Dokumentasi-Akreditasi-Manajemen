<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableLamaStudi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'studi_id' => [
                'type'              => 'INT',
                'unsigned'          => true,
                'auto_increment'    => true,
            ],
            'studi_tahun' => [
                'type'          => 'YEAR',
            ],
            'studi_lama' => [
                'type'          => 'VARCHAR',
                'constraint'    => '255',
            ],
            'studi_media_id' => [
                'type'          => 'INT',
                'unsigned'      => true,
            ],
            'studi_user_id' => [
                'type'          => 'INT',
                'unsigned'      => true
            ],
            'studi_created_at'  => [
                'type'          => 'TIMESTAMP',
                'null'          => true,
            ],
            'studi_created_by'  => [
                'type'          => 'INT',
                'null'          => true
            ],
            'studi_updated_at'  => [
                'type'          => 'TIMESTAMP',
                'null'          => true
            ],
            'studi_updated_by'  => [
                'type'          => 'INT',
                'null'          => true
            ],
            'studi_deleted_at'   => [
                'type'          => 'TIMESTAMP',
                'null'          => true
            ],
            'studi_deleted_by'   => [
                'type'          => 'INT',
                'null'          => true
            ]
        ]);

        $this->forge->addKey('studi_id',true);
        $this->forge->addForeignKey('studi_user_id', 'user', 'user_id', 'CASCADE', 'CASCADE', 'studi_user_id');
        $this->forge->addForeignKey('studi_media_id', 'media', 'media_id', 'CASCADE', 'CASCADE', 'studi_media_id');
        $this->forge->createTable('studi');
    }

    public function down()
    {
        $this->forge->dropTable('studi');
    }
}
