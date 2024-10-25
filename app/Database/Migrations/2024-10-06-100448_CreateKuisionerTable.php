<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateKuisionerTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'kuisioner_id' => [
                'type'              => 'INT',
                'unsigned'          => true,
                'auto_increment'    => true,
            ],
            'college_sarjana'=> [
                'type'          => 'TINYINT',
                'constraint'    => 1,
                'comment'       => '1=Sangat Kurang, 2=Kurang, 3=Cukup, 4=Baik, 5=Sangat Baik'
            ],
            'college_peringkat'=> [
                'type'          => 'TINYINT',
                'constraint'    => 1,
                'comment'       => '1=Sangat Kurang, 2=Kurang, 3=Cukup, 4=Baik, 5=Sangat Baik'
            ],
            'college_akreditasi_prodi'=> [
                'type'          => 'TINYINT',
                'constraint'    => 1,
                'comment'       => '1=Sangat Kurang, 2=Kurang, 3=Cukup, 4=Baik, 5=Sangat Baik'
            ],
            'college_pengalaman_kerja'=> [
                'type'          => 'TINYINT',
                'constraint'    => 1,
                'comment'       => '1=Sangat Kurang, 2=Kurang, 3=Cukup, 4=Baik, 5=Sangat Baik'
            ],
            'college_personality'=> [
                'type'          => 'TINYINT',
                'constraint'    => 1,
                'comment'       => '1=Sangat Kurang, 2=Kurang, 3=Cukup, 4=Baik, 5=Sangat Baik'
            ],
            'college_manfaat'=> [
                'type'          => 'TINYINT',
                'constraint'    => 1,
                'comment'       => '1=Sangat Kurang, 2=Kurang, 3=Cukup, 4=Baik, 5=Sangat Baik'
            ],
            'college_manfaat_kerja'=> [
                'type'          => 'TINYINT',
                'constraint'    => 1,
                'comment'       => '1=Sangat Kurang, 2=Kurang, 3=Cukup, 4=Baik, 5=Sangat Baik'
            ],
            'college_manfaat_karir'=> [
                'type'          => 'TINYINT',
                'constraint'    => 1,
                'comment'       => '1=Sangat Kurang, 2=Kurang, 3=Cukup, 4=Baik, 5=Sangat Baik'
            ],
            'penilaian_bimbingan_pa'=> [
                'type'          => 'TINYINT',
                'constraint'    => 1,
                'comment'       => '1=Sangat Kurang, 2=Kurang, 3=Cukup, 4=Baik, 5=Sangat Baik'
            ],
            'penilaian_konten_matkul'=> [
                'type'          => 'TINYINT',
                'constraint'    => 1,
                'comment'       => '1=Sangat Kurang, 2=Kurang, 3=Cukup, 4=Baik, 5=Sangat Baik'
            ],
            'penilaian_variasi_matkul'=> [
                'type'          => 'TINYINT',
                'constraint'    => 1,
                'comment'       => '1=Sangat Kurang, 2=Kurang, 3=Cukup, 4=Baik, 5=Sangat Baik'
            ],
            'penilaian_dari_dosen'=> [
                'type'          => 'TINYINT',
                'constraint'    => 1,
                'comment'       => '1=Sangat Kurang, 2=Kurang, 3=Cukup, 4=Baik, 5=Sangat Baik'
            ],
            'penilaian_rancangan_kurikulum'=> [
                'type'          => 'TINYINT',
                'constraint'    => 1,
                'comment'       => '1=Sangat Kurang, 2=Kurang, 3=Cukup, 4=Baik, 5=Sangat Baik'
            ],
            'penilaian_milih_matkul'=> [
                'type'          => 'TINYINT',
                'constraint'    => 1,
                'comment'       => '1=Sangat Kurang, 2=Kurang, 3=Cukup, 4=Baik, 5=Sangat Baik'
            ],
            'penilaian_kualitas_dosen'=> [
                'type'          => 'TINYINT',
                'constraint'    => 1,
                'comment'       => '1=Sangat Kurang, 2=Kurang, 3=Cukup, 4=Baik, 5=Sangat Baik'
            ],
            'penilaian_metode_ajar'=> [
                'type'          => 'TINYINT',
                'constraint'    => 1,
                'comment'       => '1=Sangat Kurang, 2=Kurang, 3=Cukup, 4=Baik, 5=Sangat Baik'
            ],
            'penilaian_ikut_penelitian'=> [
                'type'          => 'TINYINT',
                'constraint'    => 1,
                'comment'       => '1=Sangat Kurang, 2=Kurang, 3=Cukup, 4=Baik, 5=Sangat Baik'
            ],
            'penilaian_komunikasi_dosen'=> [
                'type'          => 'TINYINT',
                'constraint'    => 1,
                'comment'       => '1=Sangat Kurang, 2=Kurang, 3=Cukup, 4=Baik, 5=Sangat Baik'
            ],
            'penilaian_kerja_praktik'=> [
                'type'          => 'TINYINT',
                'constraint'    => 1,
                'comment'       => '1=Sangat Kurang, 2=Kurang, 3=Cukup, 4=Baik, 5=Sangat Baik'
            ],
            'penilaian_studi_banding'=> [
                'type'          => 'TINYINT',
                'constraint'    => 1,
                'comment'       => '1=Sangat Kurang, 2=Kurang, 3=Cukup, 4=Baik, 5=Sangat Baik'
            ],
            'penilaian_lab_komputer'=> [
                'type'          => 'TINYINT',
                'constraint'    => 1,
                'comment'       => '1=Sangat Kurang, 2=Kurang, 3=Cukup, 4=Baik, 5=Sangat Baik'
            ],
            'penilaian_internet'=> [
                'type'          => 'TINYINT',
                'constraint'    => 1,
                'comment'       => '1=Sangat Kurang, 2=Kurang, 3=Cukup, 4=Baik, 5=Sangat Baik'
            ],
            'penilaian_pustaka'=> [
                'type'          => 'TINYINT',
                'constraint'    => 1,
                'comment'       => '1=Sangat Kurang, 2=Kurang, 3=Cukup, 4=Baik, 5=Sangat Baik'
            ],
            'penilaian_administrasi'=> [
                'type'          => 'TINYINT',
                'constraint'    => 1,
                'comment'       => '1=Sangat Kurang, 2=Kurang, 3=Cukup, 4=Baik, 5=Sangat Baik'
            ],
            'keahlian_identifikasi'=> [
                'type'          => 'TINYINT',
                'constraint'    => 1,
                'comment'       => '1=Sangat Kurang, 2=Kurang, 3=Cukup, 4=Baik, 5=Sangat Baik'
            ],
            'keahlian_aplikasi_manajerial'=> [
                'type'          => 'TINYINT',
                'constraint'    => 1,
                'comment'       => '1=Sangat Kurang, 2=Kurang, 3=Cukup, 4=Baik, 5=Sangat Baik'
            ],
            'keahlian_leadership'=> [
                'type'          => 'TINYINT',
                'constraint'    => 1,
                'comment'       => '1=Sangat Kurang, 2=Kurang, 3=Cukup, 4=Baik, 5=Sangat Baik'
            ],
            'keahlian_berpendapat'=> [
                'type'          => 'TINYINT',
                'constraint'    => 1,
                'comment'       => '1=Sangat Kurang, 2=Kurang, 3=Cukup, 4=Baik, 5=Sangat Baik'
            ],
            'keahlian_inggris'=> [
                'type'          => 'TINYINT',
                'constraint'    => 1,
                'comment'       => '1=Sangat Kurang, 2=Kurang, 3=Cukup, 4=Baik, 5=Sangat Baik'
            ],
            'keahlian_memimpin'=> [
                'type'          => 'TINYINT',
                'constraint'    => 1,
                'comment'       => '1=Sangat Kurang, 2=Kurang, 3=Cukup, 4=Baik, 5=Sangat Baik'
            ],
            'keahlian_etika_profesi'=> [
                'type'          => 'TINYINT',
                'constraint'    => 1,
                'comment'       => '1=Sangat Kurang, 2=Kurang, 3=Cukup, 4=Baik, 5=Sangat Baik'
            ],
            'kritik_saran'=> [
                'type'          => 'TEXT'
            ],
        
            'kuisioner_user_id' => [
                'type'          => 'INT',
                'unsigned'      => true,
                'unique'        => true,
            ],
            'kuisioner_created_at'  => [
                'type'          => 'TIMESTAMP',
                'null'          => true,
            ],
            'kuisioner_created_by'  => [
                'type'          => 'INT',
                'null'          => true
            ],
            'kuisioner_updated_at'  => [
                'type'          => 'TIMESTAMP',
                'null'          => true
            ],
            'kuisioner_updated_by'  => [
                'type'          => 'INT',
                'null'          => true
            ],
            'kuisioner_deleted_at'   => [
                'type'          => 'TIMESTAMP',
                'null'          => true
            ],
            'kuisioner_deleted_by'   => [
                'type'          => 'INT',
                'null'          => true
            ]
        ]);

        $this->forge->addKey('kuisioner_id',true);
        $this->forge->addForeignKey('kuisioner_user_id', 'user', 'user_id', 'CASCADE', 'CASCADE', 'kuisioner_user_id');
        $this->forge->createTable('kuisioner');
    }

    public function down()
    {
        $this->forge->dropTable('kuisioner');
    }
}
