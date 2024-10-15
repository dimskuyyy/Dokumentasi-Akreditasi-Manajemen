<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDokumenTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'dokumen_id' => [
                'type'              => 'INT',
                'unsigned'          => true,
                'auto_increment'    => true,
            ],
            'dokumen_nama' => [
                'type'          => 'VARCHAR',
                'constraint'    => '255',
            ],
            'dokumen_nomor' => [
                'type'          => 'VARCHAR',
                'constraint'    => '255',
            ],
            'dokumen_media_id' => [
                'type'          => 'INT',
                'unsigned'      => true,
            ],
            'dokumen_user_id' => [
                'type'          => 'INT',
                'unsigned'      => true
            ],
            'dokumen_type' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'comment' => '1=surat keputusan,2=surat tugas,3=sertifikat'
            ],
            'dokumen_created_at'  => [
                'type'          => 'TIMESTAMP',
                'null'          => true,
            ],
            'dokumen_created_by'  => [
                'type'          => 'INT',
                'null'          => true
            ],
            'dokumen_updated_at'  => [
                'type'          => 'TIMESTAMP',
                'null'          => true
            ],
            'dokumen_updated_by'  => [
                'type'          => 'INT',
                'null'          => true
            ],
            'dokumen_deleted_at'   => [
                'type'          => 'TIMESTAMP',
                'null'          => true
            ],
            'dokumen_deleted_by'   => [
                'type'          => 'INT',
                'null'          => true
            ]
        ]);

        $this->forge->addKey('dokumen_id',true);
        $this->forge->addForeignKey('dokumen_user_id', 'user', 'user_id', 'CASCADE', 'CASCADE', 'dokumen_user_id');
        $this->forge->addForeignKey('dokumen_media_id', 'media', 'media_id', 'CASCADE', 'CASCADE', 'dokumen_media_id');
        $this->forge->createTable('dokumen');
    }

    public function down()
    {
        $this->forge->dropTable('dokumen');
    }
}
