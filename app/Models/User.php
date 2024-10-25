<?php

namespace App\Models;

use CodeIgniter\Model;

class User extends Model
{
    protected $table = "user";
    protected $primaryKey = "user_id";
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['user_nama', 'user_username', 'user_password', 'user_level', 'user_status', 'user_created_at', 'user_updated_at', 'user_updated_by', 'user_deleted_at', 'user_deleted_by'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'user_created_at';
    protected $updatedField  = 'user_updated_at';
    protected $deletedField  = 'user_deleted_at';

    // Validation
    // Aturan validasi untuk create
    protected $validationRulesCreate = [
        'user_nama' => [
            'label' => 'Nama',
            'rules' => 'required|string|max_length[255]',
        ],
        'user_username' => [
            'label' => 'Username',
            'rules' => 'required|string|max_length[255]|is_unique[user.user_username]',
        ],
        'user_password' => [
            'label' => 'Password',
            'rules' => 'required|string|max_length[255]',
        ],
        'confirm_password' => [
            'label' => 'Confirm Password',
            'rules' => 'required|string|max_length[255]|matches[user_password]',
        ],
        'user_level' => [
            'label' => 'Level',
            'rules' => 'required|integer|in_list[1,2]',
        ],
        'user_type' => [
            'label' => 'Type',
            'rules' => 'required|integer|in_list[5,6,7]'
        ],
        'user_status' => [
            'label' => 'Username',
            'rules' => 'required|integer|in_list[1,2]',
        ]
    ];
    // Aturan validasi untuk update
    protected $validationRulesUpdate = [];
    public function setValidationRulesUpdate($userId)
    {
        $this->validationRulesUpdate = [
            'user_nama' => [
                'label' => 'Nama',
                'rules' => 'required|string|max_length[255]',
            ],
            'user_username' => [
                'label' => 'Username',
                'rules' => "required|string|max_length[255]|is_unique[user.user_username,user_id,{$userId}]",
            ],
            'user_level' => [
                'label' => 'Level',
                'rules' => 'required|integer|in_list[1,2]',
            ],
            'user_type' => [
                'label' => 'Type',
                'rules' => 'required|integer|in_list[1,2,3,4,5,6,7]'
            ],
            'user_status' => [
                'label' => 'Status',
                'rules' => 'required|integer|in_list[1,2]',
            ]
        ];
    }

    // Aturan validasi untuk reset password
    protected $validationRulesResetPassword = [
        'user_password' => [
            'label' => 'Password',
            'rules' => 'required|string|max_length[255]',
        ],
        'confirm_password' => [
            'label' => 'Confirm Password',
            'rules' => 'required|string|max_length[255]|matches[user_password]',
        ],
    ];

    // Fungsi untuk validasi create data
    public function validateCreate($data)
    {
        return $this->setValidationRules($this->validationRulesCreate)->save($data);
    }

    // Fungsi untuk validasi update data
    public function validateUpdate($data)
    {
        return $this->setValidationRules($this->validationRulesUpdate)->save($data);
    }

    // Fungsi untuk validasi reset password
    public function validateResetPassword($data)
    {
        return $this->setValidationRules($this->validationRulesResetPassword)->save($data);
    }

    // protected $validationRules = [];
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

    public function checkDekan()
    {
        $builder = $this->builder()->select('*')
            // $builder->select('*')
            ->where('user_type', 1)
            ->where('user_deleted_at', null);

        // Grab Feature Total
        $kerjaSama = $this->db->table('kerjasama')
            ->select('COUNT(*)')
            ->where('kerjasama_user_id = user.user_id')
            ->where('kerjasama_deleted_at', null)
            ->getCompiledSelect();
        $builder->select("($kerjaSama) as jumlah_kerjasama", false);

        $suratKeputusan = $this->db->table('dokumen')
            ->select('COUNT(*)')
            ->where('dokumen_user_id = user.user_id')
            ->where('dokumen_type', 1)
            ->where('dokumen_deleted_at', null)
            ->getCompiledSelect();
        $builder->select("($suratKeputusan) as jumlah_sk", false);

        $suratTugas = $this->db->table('dokumen')
            ->select('COUNT(*)')
            ->where('dokumen_user_id = user.user_id')
            ->where('dokumen_type', 2)
            ->where('dokumen_deleted_at', null)
            ->getCompiledSelect();
        $builder->select("($suratTugas) as jumlah_surat_tugas", false);

        $kegiatan = $this->db->table('kegiatan')
            ->select('COUNT(*)')
            ->where('kegiatan_user_id = user.user_id')
            ->where('kegiatan_deleted_at', null)
            ->getCompiledSelect();
        $builder->select("($kegiatan) as jumlah_kegiatan", false);

        return $builder;
    }

    public function checkKajur()
    {
        $builder = $this->builder()->select('*')
            // $builder->select('*')
            ->where('user_type', 2)
            ->where('user_deleted_at', null);

        // Grab Feature Total
        $suratTugas = $this->db->table('dokumen')
            ->select('COUNT(*)')
            ->where('dokumen_user_id = user.user_id')
            ->where('dokumen_type', 2)
            ->where('dokumen_deleted_at', null)
            ->getCompiledSelect();
        $builder->select("($suratTugas) as jumlah_surat_tugas", false);

        $kegiatan = $this->db->table('kegiatan')
            ->select('COUNT(*)')
            ->where('kegiatan_user_id = user.user_id')
            ->where('kegiatan_deleted_at', null)
            ->getCompiledSelect();
        $builder->select("($kegiatan) as jumlah_kegiatan", false);

        return $builder;
    }

    public function checkKoor()
    {
        $builder = $this->builder()->select('*')
            // $builder->select('*')
            ->where('user_type', 3)
            ->where('user_deleted_at', null);

        // Grab Feature Total
        $kerjaSama = $this->db->table('kerjasama')
            ->select('COUNT(*)')
            ->where('kerjasama_user_id = user.user_id')
            ->where('kerjasama_deleted_at', null)
            ->getCompiledSelect();
        $builder->select("($kerjaSama) as jumlah_kerjasama", false);

        $kegiatan = $this->db->table('kegiatan')
            ->select('COUNT(*)')
            ->where('kegiatan_user_id = user.user_id')
            ->where('kegiatan_deleted_at', null)
            ->getCompiledSelect();
        $builder->select("($kegiatan) as jumlah_kegiatan", false);

        return $builder;
    }

    public function checkDosen()
    {
        $builder = $this->builder()->select('*')
            // $builder->select('*')
            ->where('user_type', 5)
            ->where('user_deleted_at', null);

        // Grab Feature Total
        $pengajaran = $this->db->table('pengajaran')
            ->select('COUNT(*)')
            ->where('pengajaran_user_id = user.user_id')
            ->where('pengajaran_deleted_at', null)
            ->getCompiledSelect();
        $builder->select("($pengajaran) as jumlah_pengajaran", false);

        $penelitian = $this->db->table('proyek')
            ->select('COUNT(*)')
            ->where('proyek_user_id = user.user_id')
            ->where('proyek_type', 1)
            ->where('proyek_deleted_at', null)
            ->getCompiledSelect();
        $builder->select("($penelitian) as jumlah_penelitian", false);

        $pengabdian = $this->db->table('proyek')
            ->select('COUNT(*)')
            ->where('proyek_user_id = user.user_id')
            ->where('proyek_type', 2)
            ->where('proyek_deleted_at', null)
            ->getCompiledSelect();
        $builder->select("($pengabdian) as jumlah_pengabdian", false);

        $sertifikat = $this->db->table('dokumen')
            ->select('COUNT(*)')
            ->where('dokumen_user_id = user.user_id')
            ->where('dokumen_type', 3)
            ->where('dokumen_deleted_at', null)
            ->getCompiledSelect();
        $builder->select("($sertifikat) as jumlah_sertifikat", false);

        $haki = $this->db->table('haki')
            ->select('COUNT(*)')
            ->where('haki_user_id = user.user_id')
            ->where('haki_deleted_at', null)
            ->getCompiledSelect();
        $builder->select("($haki) as jumlah_haki", false);

        $kegiatan_luar = $this->db->table('kegiatan')
            ->select('COUNT(*)')
            ->where('kegiatan_user_id = user.user_id')
            ->where('kegiatan_dosen', 1)
            ->where('kegiatan_deleted_at', null)
            ->getCompiledSelect();
        $builder->select("($kegiatan_luar) as jumlah_kegiatan_luar", false);

        $kegiatan_dalam = $this->db->table('kegiatan')
            ->select('COUNT(*)')
            ->where('kegiatan_user_id = user.user_id')
            ->where('kegiatan_dosen', 2)
            ->where('kegiatan_deleted_at', null)
            ->getCompiledSelect();
        $builder->select("($kegiatan_dalam) as jumlah_kegiatan_dalam", false);

        $kepanitiaan = $this->db->table('kepanitiaan')
            ->select('COUNT(*)')
            ->where('kepanitiaan_user_id = user.user_id')
            ->where('kepanitiaan_deleted_at', null)
            ->getCompiledSelect();
        $builder->select("($kepanitiaan) as jumlah_kepanitiaan", false);

        return $builder;
    }

    public function checkMahasiswa()
    {
        $builder = $this->builder()->select('*')
            // $builder->select('*')
            ->where('user_type', 6)
            ->where('user_deleted_at', null);

        // Grab Feature Total
        $aktivitas = $this->db->table('mahasiswa')
            ->select('COUNT(*)')
            ->where('mahasiswa_user_id = user.user_id')
            ->where('mahasiswa_deleted_at', null)
            ->where('mahasiswa_records_type', 1)
            ->getCompiledSelect();
        $builder->select("($aktivitas) as jumlah_aktivitas", false);

        $penelitian = $this->db->table('proyek')
            ->select('COUNT(*)')
            ->where('proyek_user_id = user.user_id')
            ->where('proyek_type', 1)
            ->where('proyek_deleted_at', null)
            ->getCompiledSelect();
        $builder->select("($penelitian) as jumlah_penelitian", false);

        $pengabdian = $this->db->table('proyek')
            ->select('COUNT(*)')
            ->where('proyek_user_id = user.user_id')
            ->where('proyek_type', 2)
            ->where('proyek_deleted_at', null)
            ->getCompiledSelect();
        $builder->select("($pengabdian) as jumlah_pengabdian", false);

        $prestasi = $this->db->table('mahasiswa')
            ->select('COUNT(*)')
            ->where('mahasiswa_user_id = user.user_id')
            ->where('mahasiswa_records_type', 2)
            ->where('mahasiswa_deleted_at', null)
            ->getCompiledSelect();
        $builder->select("($prestasi) as jumlah_prestasi", false);

        $kepanitiaan = $this->db->table('kepanitiaan')
            ->select('COUNT(*)')
            ->where('kepanitiaan_user_id = user.user_id')
            ->where('kepanitiaan_deleted_at', null)
            ->getCompiledSelect();
        $builder->select("($kepanitiaan) as jumlah_kepanitiaan", false);

        return $builder;
    }

    public function checkAlumni()
    {
        $builder = $this->builder()->select('*')
            // $builder->select('*')
            ->where('user_type', 7)
            ->where('user_deleted_at', null);

        //get Survey progress
        $survey = $this->db->table('survey')
            ->select('COUNT(*)')
            ->where('survey_user_id = user.user_id')
            ->where('survey_deleted_at', null)
            ->getCompiledSelect();
        $builder->select("($survey) as filled_survey", false);

        $kuisioner = $this->db->table('kuisioner')
            ->select('COUNT(*)')
            ->where('kuisioner_user_id = user.user_id')
            ->where('kuisioner_deleted_at', null)
            ->getCompiledSelect();
        $builder->select("($kuisioner) as filled_kuisioner", false);

        return $builder;
    }

    public function beforeInsert($data)
    {
        $data['data']['user_password'] = password_hash($data['data']['user_password'], PASSWORD_BCRYPT);
        $data['data']['user_created_at'] = date('Y-m-d H:i:s');
        $data['data']['user_created_by'] = AuthUser()->id;
        return $data;
    }
    public function beforeUpdate($data)
    {
        if (isset($data['data']['user_password'])) {
            $data['data']['user_password'] = password_hash($data['data']['user_password'], PASSWORD_BCRYPT);
        }
        $data['data']['user_updated_at'] = date('Y-m-d H:i:s');
        $data['data']['user_updated_by'] = AuthUser()->id;
        return $data;
    }
    public function afterDelete($data)
    {
        $id = $data['id'][0];
        $builder = $this->table('user');
        $builder->set('user_deleted_by', AuthUser()->id);
        $builder->where('user_id', $id);
        $builder->update();
    }
}
