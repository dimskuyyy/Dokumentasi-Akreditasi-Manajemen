<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateKerjasamaTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'kerjasama_id' => [
                'type'              => 'INT',
                'unsigned'          => true,
                'auto_increment'    => true,
            ],
            'kerjasama_nama' => [
                'type'          => 'VARCHAR',
                'constraint'    => '255',
            ],
            'kerjasama_skala' => [
                'type'          => 'ENUM',
                'constraint'    => ['Lokal','Nasional', 'Internasional'],
                'default'       => 'Lokal',
            ],
            'kerjasama_tahun' => [
                'type'          => 'YEAR',
                'null'          => true
            ],
            'kerjasama_media_id' => [
                'type'          => 'INT',
                'unsigned'      => true,
            ],
            'kerjasama_user_id' => [
                'type'          => 'INT',
                'unsigned'      => true
            ],
            'kerjasama_created_at'  => [
                'type'          => 'TIMESTAMP',
                'null'          => true,
            ],
            'kerjasama_created_by'  => [
                'type'          => 'INT',
                'null'          => true
            ],
            'kerjasama_updated_at'  => [
                'type'          => 'TIMESTAMP',
                'null'          => true
            ],
            'kerjasama_updated_by'  => [
                'type'          => 'INT',
                'null'          => true
            ],
            'kerjasama_deleted_at'   => [
                'type'          => 'TIMESTAMP',
                'null'          => true
            ],
            'kerjasama_deleted_by'   => [
                'type'          => 'INT',
                'null'          => true
            ]
        ]);

        $this->forge->addKey('kerjasama_id',true);
        $this->forge->addForeignKey('kerjasama_user_id', 'user', 'user_id', 'CASCADE', 'CASCADE', 'kerjasama_user_id');
        $this->forge->addForeignKey('kerjasama_media_id', 'media', 'media_id', 'CASCADE', 'CASCADE', 'kerjasama_media_id');
        $this->forge->createTable('kerjasama');
    }

    public function down()
    {
        $this->forge->dropTable('kerjasama');
    }
}
