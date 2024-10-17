<?php

namespace App\Models;

use CodeIgniter\Model;

class MPengajaranDosen extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'pengajaran';
    protected $primaryKey       = 'pengajaran_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['pengajaran_nama', 'pengajaran_media_id','pengajaran_user_id', 'pengajaran_created_at', 'pengajaran_created_by', 'pengajaran_published_at', 'pengajaran_published_by', 'pengajaran_updated_at', 'pengajaran_updated_by', 'pengajaran_deleted_at', 'pengajaran_deleted_by'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'pengajaran_created_at';
    protected $updatedField  = 'pengajaran_updated_at';
    protected $deletedField  = 'pengajaran_deleted_at';

    // Validation
    protected $validationRules      = [
        'pengajaran_nama'   => [
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
            ->join('media', 'media_id = pengajaran_media_id')
            ->join('user', 'user_id = pengajaran_user_id')
            ->where('pengajaran_deleted_at', null)
            ->where('user.user_deleted_at', null);
    }

    public function lookDetail($id)
    {
        return $this->builder()
            ->join('media', 'media_id = pengajaran_media_id')
            ->join('user', 'user_id = pengajaran_user_id')
            ->where('pengajaran_deleted_at', null)
            ->where('user.user_deleted_at', null)
            ->where('pengajaran_id',$id)
            ->get()  // Eksekusi query
            ->getRowArray();
    }

    public function beforeInsert($data){
        $data['data']['pengajaran_user_id'] = AuthUser()->id;
        $data['data']['pengajaran_created_at'] = date('Y-m-d H:i:s');
        $data['data']['pengajaran_created_by'] = AuthUser()->id; 
        return $data;
    }

    public function beforeUpdate($data)
    {
        $data['data']['pengajaran_updated_at'] = date('Y-m-d H:i:s');
        $data['data']['pengajaran_updated_by'] = AuthUser()->id;
        return $data;
    }

    public function afterDelete($data)
    {
        $id = $data['id'][0];
        $db = \Config\Database::connect();
        $builder = $db->table('pengajaran');
        $builder->set('pengajaran_deleted_by', AuthUser()->id);
        $builder->where('pengajaran_id', $id);
        $builder->update();
    }
}
