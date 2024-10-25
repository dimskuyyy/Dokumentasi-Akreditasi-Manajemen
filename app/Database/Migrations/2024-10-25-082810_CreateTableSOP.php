<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableSOP extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'sop_id' => [
                'type'              => 'INT',
                'unsigned'          => true,
                'auto_increment'    => true,
            ],
            'sop_nama' => [
                'type'          => 'VARCHAR',
                'constraint'    => '255',
            ],
            'sop_media_id' => [
                'type'          => 'INT',
                'unsigned'      => true,
            ],
            'sop_user_id' => [
                'type'          => 'INT',
                'unsigned'      => true
            ],
            'sop_created_at'  => [
                'type'          => 'TIMESTAMP',
                'null'          => true,
            ],
            'sop_created_by'  => [
                'type'          => 'INT',
                'null'          => true
            ],
            'sop_updated_at'  => [
                'type'          => 'TIMESTAMP',
                'null'          => true
            ],
            'sop_updated_by'  => [
                'type'          => 'INT',
                'null'          => true
            ],
            'sop_deleted_at'   => [
                'type'          => 'TIMESTAMP',
                'null'          => true
            ],
            'sop_deleted_by'   => [
                'type'          => 'INT',
                'null'          => true
            ]
        ]);

        $this->forge->addKey('sop_id',true);
        $this->forge->addForeignKey('sop_user_id', 'user', 'user_id', 'CASCADE', 'CASCADE', 'sop_user_id');
        $this->forge->addForeignKey('sop_media_id', 'media', 'media_id', 'CASCADE', 'CASCADE', 'sop_media_id');
        $this->forge->createTable('sop');
    }

    public function down()
    {
        $this->forge->dropTable('sop');
    }
}
