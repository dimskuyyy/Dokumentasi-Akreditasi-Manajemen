<?php

namespace App\Models;

use CodeIgniter\Model;

class MAgenda extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'agenda';
    protected $primaryKey       = 'agenda_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['agenda_nama', 'agenda_sebagai', 'agenda_media_id', 'agenda_user_id', 'agenda_type', 'agenda_kegiatan_dosen', 'agenda_created_at', 'agenda_created_by', 'agenda_published_at', 'agenda_published_by', 'agenda_updated_at', 'agenda_updated_by', 'agenda_deleted_at', 'agenda_deleted_by'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'agenda_created_at';
    protected $updatedField  = 'agenda_updated_at';
    protected $deletedField  = 'agenda_deleted_at';

    // Validation
    protected $validationRules      = [
        'agenda_nama'   => [
            'label' => 'Nama',
            'rules' => 'required|string',
        ],
        'agenda_sebagai'    => [
            'label' => 'Sebagai',
            'rules' => 'required|string',
        ],
        'agenda_type'   => [
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

    public function multiDataKegiatan()
    {
        return $this->builder()
            ->join('media', 'media_id = agenda_media_id')
            ->join('user', 'user_id = agenda_user_id')
            ->where('agenda_deleted_at', null)
            ->where('user.user_deleted_at', null)
            ->where('agenda_type',1);
    }

    public function multiDataKegiatanDosen($kegiatan)
    {
        return $this->builder()
            ->join('media', 'media_id = agenda_media_id')
            ->join('user', 'user_id = agenda_user_id')
            ->where('agenda_deleted_at', null)
            ->where('user.user_deleted_at', null)
            ->where('agenda_type',1)
            ->where('agenda_kegiatan_dosen', $kegiatan);
    }

    public function multiDataKepanitiaan()
    {
        return $this->builder()
            ->join('media', 'media_id = agenda_media_id')
            ->join('user', 'user_id = agenda_user_id')
            ->where('agenda_deleted_at', null)
            ->where('user.user_deleted_at', null)
            ->where('agenda_type',2);;
    }

    public function lookDetailKegiatan($id)
    {
        return $this->builder()
            ->join('media', 'media_id = agenda_media_id')
            ->join('user', 'user_id = agenda_user_id')
            ->where('agenda_deleted_at', null)
            ->where('user.user_deleted_at', null)
            ->where('agenda_id',$id)
            ->where('agenda_type',1)
            ->get()  // Eksekusi query
            ->getRowArray();
    }

    public function lookDetailKepanitiaan($id)
    {
        return $this->builder()
            ->join('media', 'media_id = agenda_media_id')
            ->join('user', 'user_id = agenda_user_id')
            ->where('agenda_deleted_at', null)
            ->where('user.user_deleted_at', null)
            ->where('agenda_id',$id)
            ->where('agenda_type',2)
            ->get()  // Eksekusi query
            ->getRowArray();
    }

    public function beforeInsert($data){
        $data['data']['agenda_user_id'] = AuthUser()->id;
        $data['data']['agenda_created_at'] = date('Y-m-d H:i:s');
        $data['data']['agenda_created_by'] = AuthUser()->id; 
        return $data;
    }

    public function beforeUpdate($data)
    {
        $data['data']['agenda_updated_at'] = date('Y-m-d H:i:s');
        $data['data']['agenda_updated_by'] = AuthUser()->id;
        return $data;
    }

    public function afterDelete($data)
    {
        $id = $data['id'][0];
        $db = \Config\Database::connect();
        $builder = $db->table('agenda');
        $builder->set('agenda_deleted_by', AuthUser()->id);
        $builder->where('agenda_id', $id);
        $builder->update();
    }
}
