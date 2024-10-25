<?php

namespace App\Models;

use CodeIgniter\Model;

class MKepanitiaan extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'kepanitiaan';
    protected $primaryKey       = 'kepanitiaan_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['kepanitiaan_nama', 'kepanitiaan_sebagai', 'kepanitiaan_media_id', 'kepanitiaan_user_id', 'kepanitiaan_created_at', 'kepanitiaan_created_by', 'kepanitiaan_published_at', 'kepanitiaan_published_by', 'kepanitiaan_updated_at', 'kepanitiaan_updated_by', 'kepanitiaan_deleted_at', 'kepanitiaan_deleted_by'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'kepanitiaan_created_at';
    protected $updatedField  = 'kepanitiaan_updated_at';
    protected $deletedField  = 'kepanitiaan_deleted_at';

    // Validation
    protected $validationRules      = [
        'kepanitiaan_nama'   => [
            'label' => 'Nama',
            'rules' => 'required|string',
        ],
        'kepanitiaan_sebagai'    => [
            'label' => 'Sebagai',
            'rules' => 'string',
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
            ->join('media', 'media_id = kepanitiaan_media_id')
            ->join('user', 'user_id = kepanitiaan_user_id')
            ->where('kepanitiaan_deleted_at', null)
            ->where('user.user_deleted_at', null);
    }



    public function lookDetail($id)
    {
        return $this->builder()
            ->join('media', 'media_id = kepanitiaan_media_id')
            ->join('user', 'user_id = kepanitiaan_user_id')
            ->where('kepanitiaan_deleted_at', null)
            ->where('user.user_deleted_at', null)
            ->where('kepanitiaan_id',$id)
            ->get()  // Eksekusi query
            ->getRowArray();
    }

    public function beforeInsert($data){
        $data['data']['kepanitiaan_user_id'] = AuthUser()->id;
        $data['data']['kepanitiaan_created_at'] = date('Y-m-d H:i:s');
        $data['data']['kepanitiaan_created_by'] = AuthUser()->id; 
        return $data;
    }

    public function beforeUpdate($data)
    {
        $data['data']['kepanitiaan_updated_at'] = date('Y-m-d H:i:s');
        $data['data']['kepanitiaan_updated_by'] = AuthUser()->id;
        return $data;
    }

    public function afterDelete($data)
    {
        $id = $data['id'][0];
        $db = \Config\Database::connect();
        $builder = $db->table('kepanitiaan');
        $builder->set('kepanitiaan_deleted_by', AuthUser()->id);
        $builder->where('kepanitiaan_id', $id);
        $builder->update();
    }
}
