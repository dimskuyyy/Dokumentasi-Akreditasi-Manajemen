<?php

namespace App\Models;

use CodeIgniter\Model;

class MKerjasama extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'kerjasama';
    protected $primaryKey       = 'kerjasama_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['kerjasama_nama', 'kerjasama_mitra', 'kerjasama_skala', 'kerjasama_tahun', 'kerjasama_media_id', 'kerjasama_user_id', 'kerjasama_created_at', 'kerjasama_created_by',  'kerjasama_updated_at', 'kerjasama_updated_by', 'kerjasama_deleted_at', 'kerjasama_deleted_by'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'kerjasama_created_at';
    protected $updatedField  = 'kerjasama_updated_at';
    protected $deletedField  = 'kerjasama_deleted_at';

    // Validation
    protected $validationRules      = [
        'kerjasama_nama' => [
            'label' => 'Nama',
            'rules' => 'required|string',
        ],
        'kerjasama_mitra' => [
            'label' => 'Mitra',
            'rules' => 'required|string',
        ],
        'kerjasama_skala' => [
            'label' => 'Skala',
            'rules' => 'required|in_list[Lokal,Nasional,Internasional]',
        ],
        'kerjasama_tahun' => [
            'label' => 'Tahun',
            'rules' => 'required|exact_length[4]'
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
            ->join('media', 'media_id = kerjasama_media_id')
            ->join('user', 'user_id = kerjasama_user_id')
            ->where('kerjasama_deleted_at', null)
            ->where('user.user_deleted_at', null);
    }

    public function lookDetail($id)
    {
        return $this->builder()
            ->join('media', 'media_id = kerjasama_media_id')
            ->join('user', 'user_id = kerjasama_user_id')
            ->where('kerjasama_deleted_at', null)
            ->where('user.user_deleted_at', null)
            ->where('kerjasama_id',$id)
            ->get()  // Eksekusi query
            ->getRowArray();
    }

    public function beforeInsert($data)
    {
        $data['data']['kerjasama_user_id'] = AuthUser()->id;
        $data['data']['kerjasama_created_at'] = date('Y-m-d H:i:s');
        $data['data']['kerjasama_created_by'] = AuthUser()->id;
        return $data;
    }

    public function beforeUpdate($data)
    {
        $data['data']['kerjasama_updated_at'] = date('Y-m-d H:i:s');
        $data['data']['kerjasama_updated_by'] = AuthUser()->id;
        return $data;
    }

    public function afterDelete($data)
    {
        $id = $data['id'][0];
        $db = \Config\Database::connect();
        $builder = $db->table('kerjasama');
        $builder->set('kerjasama_deleted_by', AuthUser()->id);
        $builder->where('kerjasama_id', $id);
        $builder->update();
    }
}
