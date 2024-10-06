<?php

namespace App\Models;

use CodeIgniter\Model;

class MMahasiswaRecords extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'mahasiswa';
    protected $primaryKey       = 'mahasiswa_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['mahasiswa_record', 'mahasiswa_media_id', 'mahasiswa_user_id', 'mahasiswa_user_id', 'mahasiswa_records_type', 'mahasiswa_created_at', 'mahasiswa_created_by', 'mahasiswa_published_at', 'mahasiswa_published_by', 'mahasiswa_updated_at', 'mahasiswa_updated_by', 'mahasiswa_deleted_at', 'mahasiswa_deleted_by'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'mahasiswa_created_at';
    protected $updatedField  = 'mahasiswa_updated_at';
    protected $deletedField  = 'mahasiswa_deleted_at';

    // Validation
    protected $validationRules      = [
        'mahasiswa_record'   => [
            'label' => 'Record',
            'rules' => 'required|string',
        ],
        'mahasiswa_records_type'   => [
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

    public function multiDataAktivitas()
    {
        return $this->builder()
            ->join('media', 'media_id = mahasiswa_media_id')
            ->join('user', 'user_id = mahasiswa_user_id')
            ->where('mahasiswa_deleted_at', null)
            ->where('user.user_deleted_at', null)
            ->where('mahasiswa_records_type',1)
            ->where('mahasiswa_user_id', AuthUser()->id);
    }

    public function lookDetailAktivitas($id)
    {
        return $this->builder()
            ->join('media', 'media_id = mahasiswa_media_id')
            ->join('user', 'user_id = mahasiswa_user_id')
            ->where('mahasiswa_deleted_at', null)
            ->where('user.user_deleted_at', null)
            ->where('mahasiswa_id',$id)
            ->where('mahasiswa_records_type',1)
            ->get()  // Eksekusi query
            ->getRowArray();
    }

    public function multiDataPrestasi()
    {
        return $this->builder()
            ->join('media', 'media_id = mahasiswa_media_id')
            ->join('user', 'user_id = mahasiswa_user_id')
            ->where('mahasiswa_deleted_at', null)
            ->where('user.user_deleted_at', null)
            ->where('mahasiswa_record_type',2)
            ->where('mahasiswa_user_id', AuthUser()->id);
    }

    public function lookDetailPrestasi($id)
    {
        return $this->builder()
            ->join('media', 'media_id = mahasiswa_media_id')
            ->join('user', 'user_id = mahasiswa_user_id')
            ->where('mahasiswa_deleted_at', null)
            ->where('user.user_deleted_at', null)
            ->where('mahasiswa_id',$id)
            ->where('mahasiswa_record_type',2)
            ->get()  // Eksekusi query
            ->getRowArray();
    }

    public function beforeInsert($data)
    {
        $data['data']['mahasiswa_user_id'] = AuthUser()->id;
        $data['data']['mahasiswa_created_at'] = date('Y-m-d H:i:s');
        $data['data']['mahasiswa_created_by'] = AuthUser()->id;
        return $data;
    }

    public function beforeUpdate($data)
    {
        $data['data']['mahasiswa_updated_at'] = date('Y-m-d H:i:s');
        $data['data']['mahasiswa_updated_by'] = AuthUser()->id;
        return $data;
    }

    public function afterDelete($data)
    {
        $id = $data['id'][0];
        $db = \Config\Database::connect();
        $builder = $db->table('mahasiswa');
        $builder->set('mahasiswa_deleted_by', AuthUser()->id);
        $builder->where('mahasiswa_id', $id);
        $builder->update();
    }
}
