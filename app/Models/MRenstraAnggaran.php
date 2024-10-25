<?php

namespace App\Models;

use CodeIgniter\Model;

class MRenstraAnggaran extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'renstra_anggaran';
    protected $primaryKey       = 'ra_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['ra_tahun', 'ra_media_id', 'ra_user_id', 'ra_type', 'ra_created_at', 'ra_created_by', 'ra_published_at', 'ra_published_by', 'ra_updated_at', 'ra_updated_by', 'ra_deleted_at', 'ra_deleted_by'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'ra_created_at';
    protected $updatedField  = 'ra_updated_at';
    protected $deletedField  = 'ra_deleted_at';

    // Validation
    protected $validationRules      = [
        'ra_tahun'   => [
            'label' => 'Tahun',
            'rules' => 'required|exact_length[4]|numeric',
        ],
        'ra_type'   => [
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

    public function multiDataRenstra()
    {
        return $this->builder()
            ->join('media', 'media_id = ra_media_id')
            ->join('user', 'user_id = ra_user_id')
            ->where('ra_deleted_at', null)
            ->where('user.user_deleted_at', null)
            ->where('ra_type',1);
    }

    public function multiDataAnggaran()
    {
        return $this->builder()
            ->join('media', 'media_id = ra_media_id')
            ->join('user', 'user_id = ra_user_id')
            ->where('ra_deleted_at', null)
            ->where('user.user_deleted_at', null)
            ->where('ra_type',2);;
    }

    public function lookDetailRenstra($id)
    {
        return $this->builder()
            ->join('media', 'media_id = ra_media_id')
            ->join('user', 'user_id = ra_user_id')
            ->where('ra_deleted_at', null)
            ->where('user.user_deleted_at', null)
            ->where('ra_id',$id)
            ->where('ra_type',1)
            ->get()  // Eksekusi query
            ->getRowArray();
    }

    public function lookDetailAnggaran($id)
    {
        return $this->builder()
            ->join('media', 'media_id = ra_media_id')
            ->join('user', 'user_id = ra_user_id')
            ->where('ra_deleted_at', null)
            ->where('user.user_deleted_at', null)
            ->where('ra_id',$id)
            ->where('ra_type',2)
            ->get()  // Eksekusi query
            ->getRowArray();
    }

    public function beforeInsert($data){
        $data['data']['ra_user_id'] = AuthUser()->id;
        $data['data']['ra_created_at'] = date('Y-m-d H:i:s');
        $data['data']['ra_created_by'] = AuthUser()->id; 
        return $data;
    }

    public function beforeUpdate($data)
    {
        $data['data']['ra_updated_at'] = date('Y-m-d H:i:s');
        $data['data']['ra_updated_by'] = AuthUser()->id;
        return $data;
    }

    public function afterDelete($data)
    {
        $id = $data['id'][0];
        $db = \Config\Database::connect();
        $builder = $db->table('dokumen');
        $builder->set('ra_deleted_by', AuthUser()->id);
        $builder->where('ra_id', $id);
        $builder->update();
    }
}
