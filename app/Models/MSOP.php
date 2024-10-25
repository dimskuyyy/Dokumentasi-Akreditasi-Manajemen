<?php

namespace App\Models;

use CodeIgniter\Model;

class MSOP extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'sop';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['sop_nama', 'sop_media_id','sop_user_id', 'sop_created_at', 'sop_created_by', 'sop_published_at', 'sop_published_by', 'sop_updated_at', 'sop_updated_by', 'sop_deleted_at', 'sop_deleted_by'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'sop_created_at';
    protected $updatedField  = 'sop_updated_at';
    protected $deletedField  = 'sop_deleted_at';

    // Validation
    protected $validationRules      = [
        'sop_nama'   => [
            'label' => 'Nama',
            'rules' => 'required|string',
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

    public function multiData()
    {
        return $this->builder()
            ->join('media', 'media_id = sop_media_id')
            ->join('user', 'user_id = sop_user_id')
            ->where('sop_deleted_at', null)
            ->where('user.user_deleted_at', null);
    }

    public function lookDetail($id)
    {
        return $this->builder()
            ->join('media', 'media_id = sop_media_id')
            ->join('user', 'user_id = sop_user_id')
            ->where('sop_deleted_at', null)
            ->where('user.user_deleted_at', null)
            ->where('sop_id',$id)
            ->get()  // Eksekusi query
            ->getRowArray();
    }

    public function beforeInsert($data){
        $data['data']['sop_user_id'] = AuthUser()->id;
        $data['data']['sop_created_at'] = date('Y-m-d H:i:s');
        $data['data']['sop_created_by'] = AuthUser()->id; 
        return $data;
    }

    public function beforeUpdate($data)
    {
        $data['data']['sop_updated_at'] = date('Y-m-d H:i:s');
        $data['data']['sop_updated_by'] = AuthUser()->id;
        return $data;
    }

    public function afterDelete($data)
    {
        $id = $data['id'][0];
        $db = \Config\Database::connect();
        $builder = $db->table('sop');
        $builder->set('sop_deleted_by', AuthUser()->id);
        $builder->where('sop_id', $id);
        $builder->update();
    }
}
