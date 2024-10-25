<?php

namespace App\Models;

use CodeIgniter\Model;

class MAkademik extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'akademik';
    protected $primaryKey       = 'akademik_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['akademik_media_id', 'akademik_user_id', 'akademik_type', 'akademik_created_at', 'akademik_created_by', 'akademik_published_at', 'akademik_published_by', 'akademik_updated_at', 'akademik_updated_by', 'akademik_deleted_at', 'akademik_deleted_by'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'akademik_created_at';
    protected $updatedField  = 'akademik_updated_at';
    protected $deletedField  = 'akademik_deleted_at';

    // Validation
    protected $validationRules      = [
        'akademik_type'   => [
            'label' => 'Type',
            'rules' => 'required|in_list[1,2]'
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

    public function multiDataPanduan()
    {
        return $this->builder()
            ->join('media', 'media_id = akademik_media_id')
            ->join('user', 'user_id = akademik_user_id')
            ->where('akademik_deleted_at', null)
            ->where('user.user_deleted_at', null)
            ->where('akademik_type',1);
    }

    public function multiDataEtika()
    {
        return $this->builder()
            ->join('media', 'media_id = akademik_media_id')
            ->join('user', 'user_id = akademik_user_id')
            ->where('akademik_deleted_at', null)
            ->where('user.user_deleted_at', null)
            ->where('akademik_type',2);;
    }

    public function lookDetailPanduan($id)
    {
        return $this->builder()
            ->join('media', 'media_id = akademik_media_id')
            ->join('user', 'user_id = akademik_user_id')
            ->where('akademik_deleted_at', null)
            ->where('user.user_deleted_at', null)
            ->where('akademik_id',$id)
            ->where('akademik_type',1)
            ->get()  // Eksekusi query
            ->getRowArray();
    }

    public function lookDetailEtika($id)
    {
        return $this->builder()
            ->join('media', 'media_id = akademik_media_id')
            ->join('user', 'user_id = akademik_user_id')
            ->where('akademik_deleted_at', null)
            ->where('user.user_deleted_at', null)
            ->where('akademik_id',$id)
            ->where('akademik_type',2)
            ->get()  // Eksekusi query
            ->getRowArray();
    }

    public function beforeInsert($data){
        $data['data']['akademik_user_id'] = AuthUser()->id;
        $data['data']['akademik_created_at'] = date('Y-m-d H:i:s');
        $data['data']['akademik_created_by'] = AuthUser()->id; 
        return $data;
    }

    public function beforeUpdate($data)
    {
        $data['data']['akademik_updated_at'] = date('Y-m-d H:i:s');
        $data['data']['akademik_updated_by'] = AuthUser()->id;
        return $data;
    }

    public function afterDelete($data)
    {
        $id = $data['id'][0];
        $db = \Config\Database::connect();
        $builder = $db->table('dokumen');
        $builder->set('akademik_deleted_by', AuthUser()->id);
        $builder->where('akademik_id', $id);
        $builder->update();
    }
}
