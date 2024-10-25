<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableAkademikIPK extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'ipk_id' => [
                'type'              => 'INT',
                'unsigned'          => true,
                'auto_increment'    => true,
            ],
            'ipk_tahun' => [
                'type'          => 'YEAR',
            ],
            'ipk_rata_rata' => [
                'type'          => 'VARCHAR',
                'constraint'    => '255',
            ],
            'ipk_media_id' => [
                'type'          => 'INT',
                'unsigned'      => true,
            ],
            'ipk_user_id' => [
                'type'          => 'INT',
                'unsigned'      => true
            ],
            'ipk_created_at'  => [
                'type'          => 'TIMESTAMP',
                'null'          => true,
            ],
            'ipk_created_by'  => [
                'type'          => 'INT',
                'null'          => true
            ],
            'ipk_updated_at'  => [
                'type'          => 'TIMESTAMP',
                'null'          => true
            ],
            'ipk_updated_by'  => [
                'type'          => 'INT',
                'null'          => true
            ],
            'ipk_deleted_at'   => [
                'type'          => 'TIMESTAMP',
                'null'          => true
            ],
            'ipk_deleted_by'   => [
                'type'          => 'INT',
                'null'          => true
            ]
        ]);

        $this->forge->addKey('ipk_id',true);
        $this->forge->addForeignKey('ipk_user_id', 'user', 'user_id', 'CASCADE', 'CASCADE', 'ipk_user_id');
        $this->forge->addForeignKey('ipk_media_id', 'media', 'media_id', 'CASCADE', 'CASCADE', 'ipk_media_id');
        $this->forge->createTable('ipk');
    }

    public function down()
    {
        $this->forge->dropTable('ipk');
    }
}
