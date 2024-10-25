<?php

namespace App\Models;

use CodeIgniter\Model;

class MSurvey extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'survey';
    protected $primaryKey       = 'survey_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nama_lengkap',
        'tahun_masuk',
        'nim',
        'nomor_hp',
        'alamat',
        'alamat_sosmed',
        'konsentrasi',
        'ipk',
        'lama_studi',
        'selesai_skripsi',
        'nilai_toefl',
        'nilai_toefl_kerja',
        'tahun_selesai',
        'bulan_selesai',
        'mulai_cari_kerja',
        'lama_dapat_kerja',
        'tempat_kerja_pertama',
        'posisi_kerja_pertama',
        'tempat_kerja_sekarang',
        'posisi_kerja_sekarang',
        'jenis_perusahaan_sekarang',
        'jenis_perusahaan_other',
        'bidang_usaha_other',
        'bidang_usaha_sekarang',
        'perusahaan_ke_berapa',
        'skala_kerja',
        'nomor_pimpinan',
        'kerja_sesuai_keahlian',
        'cara_dapat_kerja',
        'other_dapat_kerja',
        'kisaran_penghasilan',
        'survey_user_id',
        'survey_created_at',
        'survey_created_by',
        'survey_updated_at',
        'survey_updated_by',
        'survey_deleted_at',
        'survey_deleted_by',
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'survey_created_at';
    protected $updatedField  = 'survey_updated_at';
    protected $deletedField  = 'survey_deleted_at';

    // Validation
    protected $validationRules      = [
        'nama_lengkap' => [
            'label' => 'Nama Lengkap',
            'rules' => 'required|string'
        ],
        'tahun_masuk' => [
            'label' => 'Tahun Masuk',
            'rules' => 'required|exact_length[4]'
        ],
        'nim' => [
            'label' => 'NIM',
            'rules' => 'required|string'
        ],
        'nomor_hp' => [
            'label' => 'Nomor HP',
            'rules' => 'required|numeric'
        ],
        'alamat' => [
            'label' => 'Alamat',
            'rules' => 'required|string'
        ],
        'alamat_sosmed' => [
            'label' => 'Socmed Address',
            'rules' => 'required|string'
        ],
        'konsentrasi' => [
            'label' => 'Konsentrasi',
            'rules' => 'required|in_list[Ekonomi Sumber Daya Manusia,Ekonomi Keuangan Daerah,Ekonomi Pedesaan]'
        ],
        'ipk' => [
            'label' => 'IPK',
            'rules' => 'required|decimal|greater_than_equal_to[0.00]|less_than_equal_to[4.00]'
        ],
        'lama_studi' => [
            'label' => 'Lama Studi',
            'rules' => 'required|string'
        ],
        'selesai_skripsi' => [
            'label' => 'Lama Skripsi',
            'rules' => 'required|string'
        ],
        'nilai_toefl' => [
            'label' => 'Nilai Toefl Kuliah',
            'rules' => 'required|numeric'
        ],
        'nilai_toefl_kerja' => [
            'label' => 'Nilai Toefl Kerja',
            'rules' => 'required|string'
        ],
        'tahun_selesai' => [
            'label' => 'Tahun Selesai Kuliah',
            'rules' => 'required|in_list[2020,2021,2022,2023]'
        ],
        'bulan_selesai' => [
            'label' => 'Bulan Selesai Kuliah',
            'rules' => 'required|in_list[Januari,Februari, Maret,April,Mei,Juni,Juli,Agustus,September,Oktober,November,Desember]'
        ],
        'mulai_cari_kerja'=> [
            'label' => 'Mulai Cari Kerja',
            'rules' => 'required|string'
        ],
        'lama_dapat_kerja' => [
            'label' => 'Lama Dapat Kerja',
            'rules' => 'required|in_list[<3 Bulan,<6 Bulan,6-12 Bulan,13-19 Bulan,19-24 Bulan,25-30 Bulan,31-36 Bulan,>3 Tahun]'
        ],
        'tempat_kerja_pertama' => [
            'label' => 'Tempat Kerja Pertama',
            'rules' => 'required|string'
        ],
        'posisi_kerja_pertama' => [
            'label' => 'Posisi Kerja Pertama',
            'rules' => 'required|string'
        ],
        'tempat_kerja_sekarang' => [
            'label' => 'Tempat Kerja Sekarang',
            'rules' => 'required|string'
        ],
        'posisi_kerja_sekarang' => [
            'label' => 'Posisi Kerja Sekarang',
            'rules' => 'required|string'
        ],
        'jenis_perusahaan_sekarang' => [
            'label' => 'Jenis Perusahaan Sekarang',
            'rules' => 'required|in_list[Perusahaan Swasta,BUMN,Bank Swasta,Instansi Pemerintah,Wiraswasta,Perusahaan Asing,Berwirausaha/Menjalankan Usaha,Other]'
        ],
        'jenis_perusahaan_other' => [
            'label' => 'Other Jenis Perusahaan Sekarang',
            'rules' => 'permit_empty|string'
        ],
        'bidang_usaha_sekarang' => [
            'label' => 'Bidang Usaha Sekarang',
            'rules' => 'required|in_list[Perbankan,Asuransi,Lembaga Keuangan/Pembiayaan lainnya,Pemerintahan,Manufaktur,Transportasi,Telekomunikasi,Pendidikan,Pertambangan,Other]'
        ],
        'bidang_usaha_other' => [
            'label' => 'Other Bidang Perusahaan Sekarang',
            'rules' => 'permit_empty|string'
        ],
        'perusahaan_ke_berapa' => [
            'label' => 'Perusahaan Ke Berapa',
            'rules' => 'required|string'
        ],
        'skala_kerja' => [
            'label' => 'Skala Kerja',
            'rules' => 'required|in_list[Lokal,Nasional,Internasional,Berizin,Tidak Berizin]'
        ],
        'nomor_pimpinan' => [
            'label' => 'Nomor HP Pimpinan',
            'rules' => 'required|numeric'
        ],
        'kerja_sesuai_keahlian' => [
            'label' => 'Kerja Sesuai Keahlian',
            'rules' => 'required|in_list[Sesuai,Tidak Sesuai]'
        ],
        'cara_dapat_kerja' => [
            'label' => 'Cara Mendapat Pekerjaan',
            'rules' => 'required|in_list[Iklan,Melamar Langsung,Internet/Email,Job Fair,Orang Tua,Wirausaha,Other]'
        ],
        'other_dapat_kerja' => [
            'label' => 'Other Cara Mendapat Pekerjaan',
            'rules' => 'permit_empty|string'
        ],
        'kisaran_penghasilan' => [
            'label' => 'Kisaran Penghasilan',
            'rules' => 'required|in_list[<2500000,2500000-5000000,5000000-7500000,7500000-10000000,>10000000]'
        ],
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = ['beforeInsert'];
    protected $afterInsert    = [];
    protected $beforeUpdate   = ['beforeUpdate'];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = ['afterDelete'];

    public function getData($user){
        return $this->builder()
            ->join('kuisioner', 'survey_user_id = kuisioner_user_id')
            ->where('survey_deleted_at',null)
            ->where('kuisioner.kuisioner_deleted_at',null)
            ->where('survey_user_id', $user)
            ->get()  // Eksekusi query
            ->getRowArray();;
    }

    public function beforeInsert($data)
    {
        $data['data']['survey_user_id'] = AuthUser()->id;
        $data['data']['survey_created_at'] = date('Y-m-d H:i:s');
        $data['data']['survey_created_by'] = AuthUser()->id;
        return $data;
    }

    public function beforeUpdate($data)
    {
        $data['data']['survey_updated_at'] = date('Y-m-d H:i:s');
        $data['data']['survey_updated_by'] = AuthUser()->id;
        return $data;
    }

    public function afterDelete($data)
    {
        $id = $data['id'][0];
        $db = \Config\Database::connect();
        $builder = $db->table('survey');
        $builder->set('survey_deleted_by', AuthUser()->id);
        $builder->where('survey_id', $id);
        $builder->update();
    }
}
