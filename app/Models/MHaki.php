<?php

namespace App\Models;

use CodeIgniter\Model;

class MHaki extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'haki';
    protected $primaryKey       = 'haki_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['haki_nama', 'haki_klasifikasi', 'haki_nomor', 'haki_media_id', 'haki_user_id', 'haki_created_at', 'haki_created_by', 'haki_published_at', 'haki_published_by', 'haki_updated_at', 'haki_updated_by', 'haki_deleted_at', 'haki_deleted_by'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'haki_created_at';
    protected $updatedField  = 'haki_updated_at';
    protected $deletedField  = 'haki_deleted_at';

    // Validation
    protected $validationRules      = [
        'haki_nama'   => [
            'label' => 'Nama',
            'rules' => 'required|string',
        ],
        'haki_klasifikasi'   => [
            'label' => 'Klasifikasi',
            'rules' => 'required|string',
        ],
        'haki_nomor'    => [
            'label' => 'Nomor',
            'rules' => 'required|string',
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

    public function multiData()
    {
        return $this->builder()
            ->join('media', 'media_id = haki_media_id')
            ->join('user', 'user_id = haki_user_id')
            ->where('haki_deleted_at', null)
            ->where('user.user_deleted_at', null);
    }

    public function lookDetail($id)
    {
        return $this->builder()
            ->join('media', 'media_id = haki_media_id')
            ->join('user', 'user_id = haki_user_id')
            ->where('haki_deleted_at', null)
            ->where('user.user_deleted_at', null)
            ->where('haki_id',$id)
            ->get()  // Eksekusi query
            ->getRowArray();
    }


    public function beforeInsert($data){
        $data['data']['haki_user_id'] = AuthUser()->id;
        $data['data']['haki_created_at'] = date('Y-m-d H:i:s');
        $data['data']['haki_created_by'] = AuthUser()->id; 
        return $data;
    }

    public function beforeUpdate($data)
    {
        $data['data']['haki_updated_at'] = date('Y-m-d H:i:s');
        $data['data']['haki_updated_by'] = AuthUser()->id;
        return $data;
    }

    public function afterDelete($data)
    {
        $id = $data['id'][0];
        $db = \Config\Database::connect();
        $builder = $db->table('haki');
        $builder->set('haki_deleted_by', AuthUser()->id);
        $builder->where('haki_id', $id);
        $builder->update();
    }
}
