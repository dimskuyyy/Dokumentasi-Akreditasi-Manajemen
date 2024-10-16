<?php

namespace App\Controllers\Back;

use App\Controllers\BaseController;
use App\Libraries\Datatable;
use App\Models\MMedia;
use App\Models\MHaki;

class Haki extends BaseController
{
    protected $hakiModel;
    protected $mediaModel;

    public function __construct()
    {
        $this->hakiModel = new MHaki();
        $this->mediaModel = new MMedia();
    }

    public function index()
    {
        return view('dashboard/haki/index');
    }

    public function getDatatable()
    {
        return view('dashboard/haki/data_list');
    }

    public function list()
    {
        $req = $this->request;
        if ($req->isAJAX()) {
            $columns = [
                ['dt' => 'id', 'cond' => 'haki_id', 'select' => 'haki_id'],
                ['dt' => 'slug', 'cond' => 'media_slug', 'select' => 'media_slug'],
                ['dt' => 'nama', 'cond' => 'haki_nama', 'select' => 'haki_nama'],
                ['dt' => 'klasifikasi', 'cond' => 'haki_klasifikasi', 'select' => 'haki_klasifikasi'],
                ['dt' => 'nomor', 'cond' => 'haki_nomor', 'select' => 'haki_nomor'],
                ['dt' => 'penulis', 'cond' => 'haki_user_id', 'select' => 'haki_user_id'],
                [
                    'dt' => 'tgl_simpan',
                    'cond' => 'haki_created_at',
                    'select' => 'haki_created_at',
                    'formatter' => function ($d) {
                        return $d != null ? date('d-m-Y H:i', strtotime($d)) : '';
                    }
                ],
                [
                    'dt' => 'tgl_update',
                    'cond' => 'haki_updated_at',
                    'select' => 'haki_updated_at',
                    'formatter' => function ($d) {
                        return $d != null ? date('d-m-Y H:i', strtotime($d)) : '';
                    }
                ],
            ];

            $model1 = $this->hakiModel;
            $model2 = new MHaki();
            $model1 = $model1->multiData();
            $model2 = $model2->multiData();
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
                $data = $this->hakiModel->find($id);
                if (empty($data['haki_id'])) {
                    $result = jsonFormat(false, 'HaKi tidak ditemukan');
                    return $this->response->setJSON($result);
                }else if($data['haki_user_id'] != AuthUser()->id ){
                    $result = jsonFormat(false, 'HaKi tidak ditemukan');
                    return $this->response->setJSON($result);
                }
            }

            $tmp = [];

            if ($id != null) {
                $tmp['data'] = $data;
                $tmp['media'] = $this->mediaModel->where('media_id', $data['haki_media_id'])->findAll();
            }

            return view('dashboard/haki/form', $tmp);
        }
    }

    public function detail()
    {
        $req = $this->request;
        if ($req->isAJAX()) {
            $id = $req->getVar('id') ?? null;
            if ($id != null) {
                $data = $this->hakiModel->lookDetail($id);
                if (!empty($data['haki_id'])) {
                     if($data['haki_user_id'] != AuthUser()->id ){
                        $result = jsonFormat(false, 'HaKi tidak ditemukan');
                        return $this->response->setJSON($result);
                    }
                }else{
                    $result = jsonFormat(false, 'HaKi tidak ditemukan');
                    return $this->response->setJSON($result);
                }
            } else {
                $result = jsonFormat(false, 'HaKi tidak ditemukan');
                return $this->response->setJSON($result);
            }

            $tmp = [];
            if ($id != null) {
                $tmp['data'] = $data;
            }
            return view('dashboard/haki/info', $tmp);
        }
    }

    public function save()
    {
        $req = $this->request;
        if ($req->isAJAX()) {
            $id = $req->getVar('id') ?? null;
            if ($id != null) {
                $find = $this->hakiModel->find($id);
                if (empty($find['haki_id'])) {
                    // Data tidak ditemukan, kirim respons error
                    $result = jsonFormat(false, 'HaKi tidak ditemukan');
                    return $this->response->setJSON($result);
                }else if($find['haki_user_id'] != AuthUser()->id ){
                    $result = jsonFormat(false, 'HaKi tidak ditemukan');
                    return $this->response->setJSON($result);
                }
            }
            $data = [
                'haki_nama' => $req->getVar('nama'),
                'haki_klasifikasi' => $req->getVar('klasifikasi'),
                'haki_nomor' => $req->getVar('nomor'),
                'haki_media_id' => $req->getVar('media'),
            ];
            // var_dump($data);die;

            if ($req->getVar('media') === '') {
                $result = jsonFormat(false, 'Silahkan masukkan media');
                return $this->response->setJSON($result);
            }

            if ($id != null ? $this->hakiModel->update($id, $data) : $this->hakiModel->insert($data)) {
                $result = jsonFormat(true, 'HaKi berhasil disimpan');
            } else {
                $result = jsonFormat(false, $this->hakiModel->errors());
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
                $result = jsonFormat(false, 'HaKi tidak ditemukan');
                return $this->response->setJSON($result);
            }

            $find = $this->hakiModel->find($id);
            if (empty($find['haki_id'])) {
                // Data tidak ditemukan, kirim respons error
                $result = jsonFormat(false, 'HaKi tidak ditemukan');
                return $this->response->setJSON($result);
            }else if($find['haki_user_id'] != AuthUser()->id ){
                $result = jsonFormat(false, 'HaKi tidak ditemukan');
                return $this->response->setJSON($result);
            }

            // menghapus media
            if (($find['haki_user_id'] == AuthUser()->id)) {
                if ($this->hakiModel->delete($id)) {
                    $result = jsonFormat(true, 'HaKi berhasil dihapus');
                } else {
                    $result = jsonFormat(false, 'HaKi gagal dihapus');
                }
            } else {
                $result = jsonFormat(false, 'Anda tidak memiliki izin untuk menghapus data ini');
            }
            return $this->response->setJSON($result);
        }
    }
}
