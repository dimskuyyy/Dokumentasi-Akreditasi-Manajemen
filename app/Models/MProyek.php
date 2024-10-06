<?php

namespace App\Models;

use CodeIgniter\Model;

class MProyek extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'proyek';
    protected $primaryKey       = 'proyek_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['proyek_judul', 'proyek_sebagai', 'proyek_tahapan', 'proyek_artikel', 'proyek_user_id', 'proyek_type', 'proyek_created_at', 'proyek_created_by', 'proyek_published_at', 'proyek_published_by', 'proyek_updated_at', 'proyek_updated_by', 'proyek_deleted_at', 'proyek_deleted_by'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'proyek_created_at';
    protected $updatedField  = 'proyek_updated_at';
    protected $deletedField  = 'proyek_deleted_at';

    // Validation
    protected $validationRules      = [
        'proyek_judul'  => [
            'label' => 'Judul',
            'rules' => 'required|string'
        ],
        'proyek_sebagai'    => [
            'label' => 'Sebagai',
            'rules' => 'required|string|in_list[Ketua,Anggota]'
        ],
        'proyek_tahapan'    => [
            'label' => 'Tahapan',
            'rules' => 'required|string|in_list[Proses,Terbit]'
        ],
        'proyek_artikel'    => [
            'label' => 'Artikel',
            'rules' => 'permit_empty|valid_url_strict[https,http]'
        ]
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

    public function multiDataPenelitian()
    {
        return $this->builder()
            ->join('user', 'user_id = proyek_user_id')
            ->where('proyek_deleted_at', null)
            ->where('user.user_deleted_at', null)
            ->where('proyek_user_id', AuthUser()->id)
            ->where('proyek_type',1);
    }

    public function lookDetailPenelitian($id)
    {
        return $this->builder()
            ->join('user', 'user_id = proyek_user_id')
            ->where('proyek_deleted_at', null)
            ->where('user.user_deleted_at', null)
            ->where('proyek_id',$id)
            ->where('proyek_type',1)
            ->get()  // Eksekusi query
            ->getRowArray();
    }

    public function multiDataPengabdian()
    {
        return $this->builder()
            ->join('user', 'user_id = proyek_user_id')
            ->where('proyek_deleted_at', null)
            ->where('user.user_deleted_at', null)
            ->where('proyek_user_id', AuthUser()->id)
            ->where('proyek_type',2);
    }

    public function lookDetailPengabdian($id)
    {
        return $this->builder()
            ->join('user', 'user_id = proyek_user_id')
            ->where('proyek_deleted_at', null)
            ->where('user.user_deleted_at', null)
            ->where('proyek_id',$id)
            ->where('proyek_type',2)
            ->get()  // Eksekusi query
            ->getRowArray();
    }

    public function beforeInsert($data){
        $data['data']['proyek_user_id'] = AuthUser()->id;
        $data['data']['proyek_created_at'] = date('Y-m-d H:i:s');
        $data['data']['proyek_created_by'] = AuthUser()->id; 
        return $data;
    }

    public function beforeUpdate($data)
    {
        $data['data']['proyek_updated_at'] = date('Y-m-d H:i:s');
        $data['data']['proyek_updated_by'] = AuthUser()->id;
        return $data;
    }

    public function afterDelete($data)
    {
        $id = $data['id'][0];
        $db = \Config\Database::connect();
        $builder = $db->table('proyek');
        $builder->set('proyek_deleted_by', AuthUser()->id);
        $builder->where('proyek_id', $id);
        $builder->update();
    }
}
