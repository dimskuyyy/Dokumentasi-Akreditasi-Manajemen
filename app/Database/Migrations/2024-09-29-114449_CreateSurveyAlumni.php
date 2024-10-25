<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSurveyAlumni extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'survey_id' => [
                'type'              => 'INT',
                'unsigned'          => true,
                'auto_increment'    => true,
            ],
            'nama_lengkap' => [
                'type'          => 'VARCHAR',
                'constraint'    => '255',
            ],
            'tahun_masuk'   => [
                'type'          => 'YEAR'
            ],
            'nim'   => [
                'type'          => 'VARCHAR',
                'constraint'    =>  20,
            ],
            'nomor_hp'  => [
                'type'          => 'VARCHAR',
                'constraint'    => 20,
            ],
            'alamat'    => [
                'type'          => 'TEXT'
            ],
            'alamat_sosmed' => [
                'type'          => 'TEXT'
            ],
            'konsentrasi'   => [
                'type'          => 'VARCHAR',
                'constraint'    => 100
            ],
            'ipk' => [
                'type'          => 'VARCHAR',
                'constraint'    => 10
            ],
            'lama_studi'    => [
                'type'          => 'VARCHAR',
                'constraint'    => 50
            ],
            'selesai_skripsi' => [
                'type'          => 'VARCHAR',
                'constraint'    => 50
            ],
            'nilai_toefl'   => [
                'type'          => 'VARCHAR',
                'constraint'    => 10
            ],
            'nilai_toefl_kerja' => [
                'type'          => 'VARCHAR',
                'constraint'    => 10
            ],
            'tahun_selesai' => [
                'type'          => 'YEAR'
            ],
            'bulan_selesai' => [
                'type'          => 'VARCHAR',
                'constraint'    => 15
            ],
            'mulai_cari_kerja'  => [
                'type'          => 'VARCHAR',
                'constraint'    => 30
            ], 
            'lama_dapat_kerja'  => [
                'type'          => 'VARCHAR',
                'constraint'    => 100
            ],
            'tempat_kerja_pertama'  => [
                'type'          => 'VARCHAR',
                'constraint'    => 100
            ],
            'posisi_kerja_pertama' => [
                'type'          => 'VARCHAR',
                'constraint'    => 100
            ],
            'tempat_kerja_sekarang' => [
                'type'          => 'VARCHAR',
                'constraint'    => 100
            ],
            'posisi_kerja_sekarang' => [
                'type'          => 'VARCHAR',
                'constraint'    => 100
            ],
            'jenis_perusahaan_sekarang'  => [
                'type'          => 'VARCHAR',
                'constraint'    => 150,
            ],
            'jenis_perusahaan_other' => [
                'type'          => 'VARCHAR',
                'constraint'    => 255,
                'null'          => true
            ],
            'bidang_usaha_sekarang' => [
                'type'          => 'VARCHAR',
                'constraint'    => 150,
            ],
            'bidang_usaha_other' => [
                'type'          => 'VARCHAR',
                'constraint'    => 255,
                'null'          => true
            ],
            'perusahaan_ke_berapa' => [
                'type'          => 'VARCHAR',
                'constraint'    => 150,
            ],
            'skala_kerja'   => [
                'type'          => 'VARCHAR',
                'constraint'    => 100
            ],
            'nomor_pimpinan'    => [
                'type'          => 'VARCHAR',
                'constraint'    => 100
            ],
            'kerja_sesuai_keahlian' => [
                'type'          => 'VARCHAR',
                'constraint'    => 100
            ],
            'cara_dapat_kerja'  => [
                'type'          => 'VARCHAR',
                'constraint'    => 150
            ],
            'other_dapat_kerja' => [
                'type'          => 'VARCHAR',
                'constraint'    => 255,
                'null'          => true
            ],
            'kisaran_penghasilan'   => [
                'type'          => 'VARCHAR',
                'constraint'    => 150
            ],
            'survey_user_id' => [
                'type'          => 'INT',
                'unsigned'      => true,
                'unique'        => true,
            ],
            'survey_created_at'  => [
                'type'          => 'TIMESTAMP',
                'null'          => true,
            ],
            'survey_created_by'  => [
                'type'          => 'INT',
                'null'          => true
            ],
            'survey_updated_at'  => [
                'type'          => 'TIMESTAMP',
                'null'          => true
            ],
            'survey_updated_by'  => [
                'type'          => 'INT',
                'null'          => true
            ],
            'survey_deleted_at'   => [
                'type'          => 'TIMESTAMP',
                'null'          => true
            ],
            'survey_deleted_by'   => [
                'type'          => 'INT',
                'null'          => true
            ]
        ]);

        $this->forge->addKey('survey_id',true);
        $this->forge->addForeignKey('survey_user_id', 'user', 'user_id', 'CASCADE', 'CASCADE', 'survey_user_id');
        $this->forge->createTable('survey');
    }

    public function down()
    {
        $this->forge->dropTable('survey');
    }
}
