<?php

namespace App\Models;

use CodeIgniter\Model;

class MKuisioner extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'kuisioner';
    protected $primaryKey       = 'kuisioner_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'umri_sarjana',
        'umri_peringkat',
        'umri_akreditasi_prodi',
        'umri_pengalaman_kerja',
        'umri_personality',
        'umri_manfaat',
        'umri_manfaat_kerja',
        'umri_manfaat_karir',
        'umri_manfaat_karir',
        'penilaian_bimbingan_pa',
        'penilaian_konten_matkul',
        'penilaian_variasi_matkul',
        'penilaian_dari_dosen',
        'penilaian_rancangan_kurikulum',
        'penilaian_milih_matkul',
        'penilaian_kualitas_dosen',
        'penilaian_metode_ajar',
        'penilaian_ikut_penelitian',
        'penilaian_komunikasi_dosen',
        'penilaian_kerja_praktik',
        'penilaian_studi_banding',
        'penilaian_lab_komputer',
        'penilaian_internet',
        'penilaian_pustaka',
        'penilaian_administrasi',
        'keahlian_identifikasi',
        'keahlian_aplikasi_manajerial',
        'keahlian_leadership',
        'keahlian_berpendapat',
        'keahlian_inggris',
        'keahlian_memimpin',
        'keahlian_etika_profesi',
        'kritik_saran',
        'kuisioner_user_id',
        'kuisioner_created_at',
        'kuisioner_created_by',
        'kuisioner_updated_at',
        'kuisioner_updated_by',
        'kuisioner_deleted_at',
        'kuisioner_deleted_by',
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'kuisioner_created_at';
    protected $updatedField  = 'kuisioner_updated_at';
    protected $deletedField  = 'kuisioner_deleted_at';

    // Validation
    protected $validationRules      = [
        'umri_sarjana' => [
            'rules' => 'required|in_list[1,2,3,4,5]'
        ],
        'umri_peringkat' => [
            'rules' => 'required|in_list[1,2,3,4,5]'
        ],
        'umri_akreditasi_prodi' => [
            'rules' => 'required|in_list[1,2,3,4,5]'
        ],
        'umri_pengalaman_kerja' => [
            'rules' => 'required|in_list[1,2,3,4,5]'
        ],
        'umri_personality' => [
            'rules' => 'required|in_list[1,2,3,4,5]'
        ],
        'umri_manfaat' => [
            'rules' => 'required|in_list[1,2,3,4,5]'
        ],
        'umri_manfaat_kerja' => [
            'rules' => 'required|in_list[1,2,3,4,5]'
        ],
        'umri_manfaat_karir' => [
            'rules' => 'required|in_list[1,2,3,4,5]'
        ],
        'umri_manfaat_karir' => [
            'rules' => 'required|in_list[1,2,3,4,5]'
        ],
        'penilaian_bimbingan_pa' => [
            'rules' => 'required|in_list[1,2,3,4,5]'
        ],
        'penilaian_konten_matkul' => [
            'rules' => 'required|in_list[1,2,3,4,5]'
        ],
        'penilaian_variasi_matkul' => [
            'rules' => 'required|in_list[1,2,3,4,5]'
        ],
        'penilaian_dari_dosen' => [
            'rules' => 'required|in_list[1,2,3,4,5]'
        ],
        'penilaian_rancangan_kurikulum' => [
            'rules' => 'required|in_list[1,2,3,4,5]'
        ],
        'penilaian_milih_matkul' => [
            'rules' => 'required|in_list[1,2,3,4,5]'
        ],
        'penilaian_kualitas_dosen' => [
            'rules' => 'required|in_list[1,2,3,4,5]'
        ],
        'penilaian_metode_ajar' => [
            'rules' => 'required|in_list[1,2,3,4,5]'
        ],
        'penilaian_ikut_penelitian' => [
            'rules' => 'required|in_list[1,2,3,4,5]'
        ],
        'penilaian_komunikasi_dosen' => [
            'rules' => 'required|in_list[1,2,3,4,5]'
        ],
        'penilaian_kerja_praktik' => [
            'rules' => 'required|in_list[1,2,3,4,5]'
        ],
        'penilaian_studi_banding' => [
            'rules' => 'required|in_list[1,2,3,4,5]'
        ],
        'penilaian_lab_komputer' => [
            'rules' => 'required|in_list[1,2,3,4,5]'
        ],
        'penilaian_internet' => [
            'rules' => 'required|in_list[1,2,3,4,5]'
        ],
        'penilaian_pustaka' => [
            'rules' => 'required|in_list[1,2,3,4,5]'
        ],
        'penilaian_administrasi' => [
            'rules' => 'required|in_list[1,2,3,4,5]'
        ],
        'keahlian_identifikasi' => [
            'rules' => 'required|in_list[1,2,3,4,5]'
        ],
        'keahlian_aplikasi_manajerial' => [
            'rules' => 'required|in_list[1,2,3,4,5]'
        ],
        'keahlian_leadership' => [
            'rules' => 'required|in_list[1,2,3,4,5]'
        ],
        'keahlian_berpendapat' => [
            'rules' => 'required|in_list[1,2,3,4,5]'
        ],
        'keahlian_inggris' => [
            'rules' => 'required|in_list[1,2,3,4,5]'
        ],
        'keahlian_memimpin' => [
            'rules' => 'required|in_list[1,2,3,4,5]'
        ],
        'keahlian_etika_profesi' => [
            'rules' => 'required|in_list[1,2,3,4,5]'
        ],
        'kritik_saran' => [
            'label' => 'Kritik Saran',
            'rules' => 'required|string'
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

    public function beforeInsert($data)
    {
        $data['data']['kuisioner_user_id'] = AuthUser()->id;
        $data['data']['kuisioner_created_at'] = date('Y-m-d H:i:s');
        $data['data']['kuisioner_created_by'] = AuthUser()->id;
        return $data;
    }

    public function beforeUpdate($data)
    {
        $data['data']['kuisioner_updated_at'] = date('Y-m-d H:i:s');
        $data['data']['kuisioner_updated_by'] = AuthUser()->id;
        return $data;
    }

    public function afterDelete($data)
    {
        $id = $data['id'][0];
        $db = \Config\Database::connect();
        $builder = $db->table('kuisioner');
        $builder->set('kuisioner_deleted_by', AuthUser()->id);
        $builder->where('kuisioner_id', $id);
        $builder->update();
    }
}
