<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProyekAkademik extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'proyek_id' => [
                'type'              => 'INT',
                'unsigned'          => true,
                'auto_increment'    => true,
            ],
            'proyek_judul' => [
                'type'          => 'VARCHAR',
                'constraint'    => '255',
            ],
            'proyek_sebagai' => [
                'type'          => 'VARCHAR',
                'constraint'    => '255',
            ],
            'proyek_tahapan' => [
                'type'          => 'VARCHAR',
                'constraint'    => '255',
            ],
            'proyek_artikel' => [
                'type'          => 'TEXT',
                'null'          => true,
            ],
            'proyek_user_id' => [
                'type'          => 'INT',
                'unsigned'      => true
            ],
            'proyek_type' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'comment' => '1=penelitian,2=pengabdian'
            ],
            'proyek_created_at'  => [
                'type'          => 'TIMESTAMP',
                'null'          => true,
            ],
            'proyek_created_by'  => [
                'type'          => 'INT',
                'null'          => true
            ],
            'proyek_updated_at'  => [
                'type'          => 'TIMESTAMP',
                'null'          => true
            ],
            'proyek_updated_by'  => [
                'type'          => 'INT',
                'null'          => true
            ],
            'proyek_deleted_at'   => [
                'type'          => 'TIMESTAMP',
                'null'          => true
            ],
            'proyek_deleted_by'   => [
                'type'          => 'INT',
                'null'          => true
            ]
        ]);

        $this->forge->addKey('proyek_id',true);
        $this->forge->addForeignKey('proyek_user_id', 'user', 'user_id', 'CASCADE', 'CASCADE', 'proyek_user_id');
        $this->forge->createTable('proyek');
    }

    public function down()
    {
        $this->forge->dropTable('proyek');
    }
}
