<?php

namespace App\Controllers\Back;

use App\Controllers\BaseController;
use App\Libraries\Datatable;
use App\Models\MMedia;
use App\Models\MLamaStudi;

class LamaStudi extends BaseController
{
    protected $lamaStudiModel;
    protected $mediaModel;

    public function __construct()
    {
        $this->lamaStudiModel = new MLamaStudi();
        $this->mediaModel = new MMedia();
    }

    public function index()
    {
        return view('dashboard/lama-studi/index');
    }

    public function getDatatable()
    {
        return view('dashboard/lama-studi/data_list');
    }

    public function list()
    {
        $req = $this->request;
        if ($req->isAJAX()) {
            $columns = [
                ['dt' => 'id', 'cond' => 'studi_id', 'select' => 'studi_id'],
                ['dt' => 'slug', 'cond' => 'media_slug', 'select' => 'media_slug'],
                ['dt' => 'tahun', 'cond' => 'studi_tahun', 'select' => 'studi_tahun'],
                ['dt' => 'lama', 'cond' => 'studi_lama', 'select' => 'studi_lama'],
                ['dt' => 'oleh', 'cond' => 'user_nama', 'select' => 'user_nama'],
                ['dt' => 'penulis', 'cond' => 'studi_user_id', 'select' => 'studi_user_id'],
                [
                    'dt' => 'tgl_simpan',
                    'cond' => 'studi_created_at',
                    'select' => 'studi_created_at',
                    'formatter' => function ($d) {
                        return $d != null ? date('d-m-Y H:i', strtotime($d)) : '';
                    }
                ],
                [
                    'dt' => 'tgl_update',
                    'cond' => 'studi_updated_at',
                    'select' => 'studi_updated_at',
                    'formatter' => function ($d) {
                        return $d != null ? date('d-m-Y H:i', strtotime($d)) : '';
                    }
                ],
            ];

            $model1 = $this->lamaStudiModel;
            $model2 = new MLamaStudi();
            if($req->getVar("id") == null){
                $model1 = $model1->multiData()->where('studi_user_id', AuthUser()->id);
                $model2 = $model2->multiData()->where('studi_user_id', AuthUser()->id);
            }else{
                $model1 = $model1->multiData()->where('studi_user_id', $req->getVar("id"));
                $model2 = $model2->multiData()->where('studi_user_id', $req->getVar("id"));
            }
            $result = (new Datatable())->run($model1, $model2, $req->getVar('datatables'), $columns);
            return $this->response->setJSON($result);
        }
    }

    public function form()
    {
        $req = $this->request;
        if ($req->isAJAX()) {
            $id = $req->getVar('id') ?? null;
            if ($id != null) {
                $data = $this->lamaStudiModel->find($id);
                if (empty($data['studi_id'])) {
                    $result = jsonFormat(false, 'Lama Studi Mahasiswa tidak ditemukan');
                    return $this->response->setJSON($result);
                }else if($data['studi_user_id'] != AuthUser()->id ){
                    $result = jsonFormat(false, 'Lama Studi Mahasiswa tidak ditemukan');
                    return $this->response->setJSON($result);
                }
            }

            $tmp = [];

            if ($id != null) {
                $tmp['data'] = $data;
                $tmp['media'] = $this->mediaModel->where('media_id', $data['studi_media_id'])->findAll();
            }

            return view('dashboard/lama-studi/form', $tmp);
        }
    }

    public function detail()
    {
        $req = $this->request;
        if ($req->isAJAX()) {
            $id = $req->getVar('id') ?? null;
            if ($id != null) {
                $data = $this->lamaStudiModel->lookDetail($id);
                if (!empty($data['studi_id'])) {
                     if($data['studi_user_id'] != AuthUser()->id && AuthUser()->type != 4){
                        $result = jsonFormat(false, 'Lama Studi Mahasiswa tidak ditemukan');
                        return $this->response->setJSON($result);
                    }
                }else{
                    $result = jsonFormat(false, 'Lama Studi Mahasiswa tidak ditemukan');
                    return $this->response->setJSON($result);
                }
            } else {
                $result = jsonFormat(false, 'Lama Studi Mahasiswa tidak ditemukan');
                return $this->response->setJSON($result);
            }

            $tmp = [];
            if ($id != null) {
                $tmp['data'] = $data;
            }
            return view('dashboard/lama-studi/info', $tmp);
        }
    }

    public function save()
    {
        $req = $this->request;
        if ($req->isAJAX()) {
            $id = $req->getVar('id') ?? null;
            if ($id != null) {
                $find = $this->lamaStudiModel->find($id);
                if (empty($find['studi_id'])) {
                    // Data tidak ditemukan, kirim respons error
                    $result = jsonFormat(false, 'Lama Studi Mahasiswa tidak ditemukan');
                    return $this->response->setJSON($result);
                }else if($find['studi_user_id'] != AuthUser()->id ){
                    $result = jsonFormat(false, 'Lama Studi Mahasiswa tidak ditemukan');
                    return $this->response->setJSON($result);
                }
            }
            $data = [
                'studi_tahun' => $req->getVar('tahun'),
                'studi_lama' => $req->getVar('lama'),
                'studi_media_id' => $req->getVar('media'),
            ];
            // var_dump($data);die;

            if ($req->getVar('media') === '') {
                $result = jsonFormat(false, 'Silahkan masukkan media');
                return $this->response->setJSON($result);
            }

            if ($id != null ? $this->lamaStudiModel->update($id, $data) : $this->lamaStudiModel->insert($data)) {
                $result = jsonFormat(true, 'Lama Studi Mahasiswa berhasil disimpan');
            } else {
                $result = jsonFormat(false, $this->lamaStudiModel->errors());
            }
            return $this->response->setJSON($result);
        }
    }

    public function delete()
    {
        $req = $this->request;
        if ($req->isAJAX()) {
            $id = $req->getVar('id');

            if (empty($id)) {
                // ID kosong, kirim respons error
                $result = jsonFormat(false, 'Lama Studi Mahasiswa tidak ditemukan');
                return $this->response->setJSON($result);
            }

            $find = $this->lamaStudiModel->find($id);
            if (empty($find['studi_id'])) {
                // Data tidak ditemukan, kirim respons error
                $result = jsonFormat(false, 'Lama Studi Mahasiswa tidak ditemukan');
                return $this->response->setJSON($result);
            }else if($find['studi_user_id'] != AuthUser()->id ){
                $result = jsonFormat(false, 'Lama Studi Mahasiswa tidak ditemukan');
                return $this->response->setJSON($result);
            }

            // menghapus media
            if (($find['studi_user_id'] == AuthUser()->id)) {
                if ($this->lamaStudiModel->delete($id)) {
                    $result = jsonFormat(true, 'Lama Studi Mahasiswa berhasil dihapus');
                } else {
                    $result = jsonFormat(false, 'Lama Studi Mahasiswa gagal dihapus');
                }
            } else {
                $result = jsonFormat(false, 'Anda tidak memiliki izin untuk menghapus data ini');
            }
            return $this->response->setJSON($result);
        }
    }
}
