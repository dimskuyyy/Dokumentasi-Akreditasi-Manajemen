<?php

namespace App\Models;

use CodeIgniter\Model;

class MKegiatan extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'kegiatan';
    protected $primaryKey       = 'kegiatan_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['kegiatan_nama', 'kegiatan_sebagai', 'kegiatan_media_id', 'kegiatan_user_id', 'kegiatan_type', 'kegiatan_dosen', 'kegiatan_tahun', 'kegiatan_created_at', 'kegiatan_created_by', 'kegiatan_published_at', 'kegiatan_published_by', 'kegiatan_updated_at', 'kegiatan_updated_by', 'kegiatan_deleted_at', 'kegiatan_deleted_by'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'kegiatan_created_at';
    protected $updatedField  = 'kegiatan_updated_at';
    protected $deletedField  = 'kegiatan_deleted_at';

    // Validation
    protected $validationRules      = [
        'kegiatan_nama'   => [
            'label' => 'Nama',
            'rules' => 'required|string',
        ],
        'kegiatan_tahun'    => [
            'label' => 'Tahun',
            'rules' => 'permit_empty|exact_length[4]|numeric',
        ],
        'kegiatan_sebagai'    => [
            'label' => 'Sebagai',
            'rules' => 'permit_empty|string',
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

    public function multiDataKegiatan()
    {
        return $this->builder()
            ->join('media', 'media_id = kegiatan_media_id')
            ->join('user', 'user_id = kegiatan_user_id')
            ->where('kegiatan_deleted_at', null)
            ->where('user.user_deleted_at', null);
    }

    public function multiDataKegiatanDosen($kegiatan)
    {
        return $this->builder()
            ->join('media', 'media_id = kegiatan_media_id')
            ->join('user', 'user_id = kegiatan_user_id')
            ->where('kegiatan_deleted_at', null)
            ->where('user.user_deleted_at', null)
            ->where('kegiatan_dosen', $kegiatan);
    }


    public function lookDetailKegiatan($id)
    {
        return $this->builder()
            ->join('media', 'media_id = kegiatan_media_id')
            ->join('user', 'user_id = kegiatan_user_id')
            ->where('kegiatan_deleted_at', null)
            ->where('user.user_deleted_at', null)
            ->where('kegiatan_id',$id)
            ->get()  // Eksekusi query
            ->getRowArray();
    }

    public function beforeInsert($data){
        $data['data']['kegiatan_user_id'] = AuthUser()->id;
        $data['data']['kegiatan_created_at'] = date('Y-m-d H:i:s');
        $data['data']['kegiatan_created_by'] = AuthUser()->id; 
        return $data;
    }

    public function beforeUpdate($data)
    {
        $data['data']['kegiatan_updated_at'] = date('Y-m-d H:i:s');
        $data['data']['kegiatan_updated_by'] = AuthUser()->id;
        return $data;
    }

    public function afterDelete($data)
    {
        $id = $data['id'][0];
        $db = \Config\Database::connect();
        $builder = $db->table('kegiatan');
        $builder->set('kegiatan_deleted_by', AuthUser()->id);
        $builder->where('kegiatan_id', $id);
        $builder->update();
    }
}
