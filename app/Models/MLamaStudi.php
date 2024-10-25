<?php

namespace App\Models;

use CodeIgniter\Model;

class MLamaStudi extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'studi';
    protected $primaryKey       = 'studi_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['studi_tahun', 'studi_lama', 'studi_media_id','studi_user_id', 'studi_created_at', 'studi_created_by', 'studi_published_at', 'studi_published_by', 'studi_updated_at', 'studi_updated_by', 'studi_deleted_at', 'studi_deleted_by'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'studi_created_at';
    protected $updatedField  = 'studi_updated_at';
    protected $deletedField  = 'studi_deleted_at';

    // Validation
    protected $validationRules      = [
        'studi_tahun'   => [
            'label' => 'Tahun',
            'rules' => 'required|exact_length[4]|numeric',
        ],
        'studi_lama' => [
            'label' => 'Lama Studi',
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
            ->join('media', 'media_id = studi_media_id')
            ->join('user', 'user_id = studi_user_id')
            ->where('studi_deleted_at', null)
            ->where('user.user_deleted_at', null);
    }

    public function lookDetail($id)
    {
        return $this->builder()
            ->join('media', 'media_id = studi_media_id')
            ->join('user', 'user_id = studi_user_id')
            ->where('studi_deleted_at', null)
            ->where('user.user_deleted_at', null)
            ->where('studi_id',$id)
            ->get()  // Eksekusi query
            ->getRowArray();
    }

    public function beforeInsert($data){
        $data['data']['studi_user_id'] = AuthUser()->id;
        $data['data']['studi_created_at'] = date('Y-m-d H:i:s');
        $data['data']['studi_created_by'] = AuthUser()->id; 
        return $data;
    }

    public function beforeUpdate($data)
    {
        $data['data']['studi_updated_at'] = date('Y-m-d H:i:s');
        $data['data']['studi_updated_by'] = AuthUser()->id;
        return $data;
    }

    public function afterDelete($data)
    {
        $id = $data['id'][0];
        $db = \Config\Database::connect();
        $builder = $db->table('studi');
        $builder->set('studi_deleted_by', AuthUser()->id);
        $builder->where('studi_id', $id);
        $builder->update();
    }
}
