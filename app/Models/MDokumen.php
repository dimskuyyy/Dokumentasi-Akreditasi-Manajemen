<?php

namespace App\Models;

use CodeIgniter\Model;

class MDokumen extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'dokumen';
    protected $primaryKey       = 'dokumen_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['dokumen_nama', 'dokumen_nomor', 'dokumen_media_id', 'dokumen_user_id', 'dokumen_type', 'dokumen_created_at', 'dokumen_created_by', 'dokumen_published_at', 'dokumen_published_by', 'dokumen_updated_at', 'dokumen_updated_by', 'dokumen_deleted_at', 'dokumen_deleted_by'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'dokumen_created_at';
    protected $updatedField  = 'dokumen_updated_at';
    protected $deletedField  = 'dokumen_deleted_at';

    // Validation
    protected $validationRules      = [
        'dokumen_nama'   => [
            'label' => 'Nama',
            'rules' => 'required|string',
        ],
        'dokumen_nomor'    => [
            'label' => 'Sebagai',
            'rules' => 'required|string',
        ],
        'dokumen_type'   => [
            'label' => 'Type',
            'rules' => 'required|in_list[1,2,3]'
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

    public function multiDataSuratKeputusan()
    {
        return $this->builder()
            ->join('media', 'media_id = dokumen_media_id')
            ->join('user', 'user_id = dokumen_user_id')
            ->where('dokumen_deleted_at', null)
            ->where('user.user_deleted_at', null)
            ->where('dokumen_user_id', AuthUser()->id)
            ->where('dokumen_type',1);
    }

    public function multiDataSuratTugas()
    {
        return $this->builder()
            ->join('media', 'media_id = dokumen_media_id')
            ->join('user', 'user_id = dokumen_user_id')
            ->where('dokumen_deleted_at', null)
            ->where('user.user_deleted_at', null)
            ->where('dokumen_user_id', AuthUser()->id)
            ->where('dokumen_type',2);;
    }

    public function multiDataSertifikat()
    {
        return $this->builder()
            ->join('media', 'media_id = dokumen_media_id')
            ->join('user', 'user_id = dokumen_user_id')
            ->where('dokumen_deleted_at', null)
            ->where('user.user_deleted_at', null)
            ->where('dokumen_user_id', AuthUser()->id)
            ->where('dokumen_type',3);;
    }

    public function lookDetailSuratKeputusan($id)
    {
        return $this->builder()
            ->join('media', 'media_id = dokumen_media_id')
            ->join('user', 'user_id = dokumen_user_id')
            ->where('dokumen_deleted_at', null)
            ->where('user.user_deleted_at', null)
            ->where('dokumen_id',$id)
            ->where('dokumen_type',1)
            ->get()  // Eksekusi query
            ->getRowArray();
    }

    public function lookDetailSuratTugas($id)
    {
        return $this->builder()
            ->join('media', 'media_id = dokumen_media_id')
            ->join('user', 'user_id = dokumen_user_id')
            ->where('dokumen_deleted_at', null)
            ->where('user.user_deleted_at', null)
            ->where('dokumen_id',$id)
            ->where('dokumen_type',2)
            ->get()  // Eksekusi query
            ->getRowArray();
    }
    public function lookDetailSertifikat($id)
    {
        return $this->builder()
            ->join('media', 'media_id = dokumen_media_id')
            ->join('user', 'user_id = dokumen_user_id')
            ->where('dokumen_deleted_at', null)
            ->where('user.user_deleted_at', null)
            ->where('dokumen_id',$id)
            ->where('dokumen_type',3)
            ->get()  // Eksekusi query
            ->getRowArray();
    }

    public function beforeInsert($data){
        $data['data']['dokumen_user_id'] = AuthUser()->id;
        $data['data']['dokumen_created_at'] = date('Y-m-d H:i:s');
        $data['data']['dokumen_created_by'] = AuthUser()->id; 
        return $data;
    }

    public function beforeUpdate($data)
    {
        $data['data']['dokumen_updated_at'] = date('Y-m-d H:i:s');
        $data['data']['dokumen_updated_by'] = AuthUser()->id;
        return $data;
    }

    public function afterDelete($data)
    {
        $id = $data['id'][0];
        $db = \Config\Database::connect();
        $builder = $db->table('dokumen');
        $builder->set('dokumen_deleted_by', AuthUser()->id);
        $builder->where('dokumen_id', $id);
        $builder->update();
    }
}
