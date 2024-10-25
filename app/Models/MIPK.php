<?php

namespace App\Models;

use CodeIgniter\Model;

class MIPK extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'ipk';
    protected $primaryKey       = 'ipk_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['ipk_tahun', 'ipk_rata_rata', 'ipk_media_id','ipk_user_id', 'ipk_created_at', 'ipk_created_by', 'ipk_published_at', 'ipk_published_by', 'ipk_updated_at', 'ipk_updated_by', 'ipk_deleted_at', 'ipk_deleted_by'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'ipk_created_at';
    protected $updatedField  = 'ipk_updated_at';
    protected $deletedField  = 'ipk_deleted_at';

    // Validation
    protected $validationRules      = [
        'ipk_tahun'   => [
            'label' => 'Tahun',
            'rules' => 'required|exact_length[4]|numeric',
        ],
        'ipk_rata_rata' => [
            'label' => 'Rata Rata IPK',
            'rules' => 'required|decimal|greater_than_equal_to[0.00]|less_than_equal_to[4.00]',
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
            ->join('media', 'media_id = ipk_media_id')
            ->join('user', 'user_id = ipk_user_id')
            ->where('ipk_deleted_at', null)
            ->where('user.user_deleted_at', null);
    }

    public function lookDetail($id)
    {
        return $this->builder()
            ->join('media', 'media_id = ipk_media_id')
            ->join('user', 'user_id = ipk_user_id')
            ->where('ipk_deleted_at', null)
            ->where('user.user_deleted_at', null)
            ->where('ipk_id',$id)
            ->get()  // Eksekusi query
            ->getRowArray();
    }

    public function beforeInsert($data){
        $data['data']['ipk_user_id'] = AuthUser()->id;
        $data['data']['ipk_created_at'] = date('Y-m-d H:i:s');
        $data['data']['ipk_created_by'] = AuthUser()->id; 
        return $data;
    }

    public function beforeUpdate($data)
    {
        $data['data']['ipk_updated_at'] = date('Y-m-d H:i:s');
        $data['data']['ipk_updated_by'] = AuthUser()->id;
        return $data;
    }

    public function afterDelete($data)
    {
        $id = $data['id'][0];
        $db = \Config\Database::connect();
        $builder = $db->table('ipk');
        $builder->set('ipk_deleted_by', AuthUser()->id);
        $builder->where('ipk_id', $id);
        $builder->update();
    }
}
