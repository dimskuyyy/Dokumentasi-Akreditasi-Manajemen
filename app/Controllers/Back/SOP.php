<?php

namespace App\Controllers\Back;

use App\Controllers\BaseController;
use App\Libraries\Datatable;
use App\Models\MMedia;
use App\Models\MSOP;

class SOP extends BaseController
{
    protected $sopModel;
    protected $mediaModel;

    public function __construct()
    {
        $this->sopModel = new MSOP();
        $this->mediaModel = new MMedia();
    }

    public function index()
    {
        return view('dashboard/sop/index');
    }

    public function getDatatable()
    {
        return view('dashboard/sop/data_list');
    }

    public function list()
    {
        $req = $this->request;
        if ($req->isAJAX()) {
            $columns = [
                ['dt' => 'id', 'cond' => 'sop_id', 'select' => 'sop_id'],
                ['dt' => 'slug', 'cond' => 'media_slug', 'select' => 'media_slug'],
                ['dt' => 'nama', 'cond' => 'sop_nama', 'select' => 'sop_nama'],
                ['dt' => 'oleh', 'cond' => 'user_nama', 'select' => 'user_nama'],
                ['dt' => 'penulis', 'cond' => 'sop_user_id', 'select' => 'sop_user_id'],
                [
                    'dt' => 'tgl_simpan',
                    'cond' => 'sop_created_at',
                    'select' => 'sop_created_at',
                    'formatter' => function ($d) {
                        return $d != null ? date('d-m-Y H:i', strtotime($d)) : '';
                    }
                ],
                [
                    'dt' => 'tgl_update',
                    'cond' => 'sop_updated_at',
                    'select' => 'sop_updated_at',
                    'formatter' => function ($d) {
                        return $d != null ? date('d-m-Y H:i', strtotime($d)) : '';
                    }
                ],
            ];

            $model1 = $this->sopModel;
            $model2 = new MSOP();
            if($req->getVar("id") == null){
                $model1 = $model1->multiData()->where('sop_user_id', AuthUser()->id);
                $model2 = $model2->multiData()->where('sop_user_id', AuthUser()->id);
            }else{
                $model1 = $model1->multiData()->where('sop_user_id', $req->getVar("id"));
                $model2 = $model2->multiData()->where('sop_user_id', $req->getVar("id"));
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
                $data = $this->sopModel->find($id);
                if (empty($data['sop_id'])) {
                    $result = jsonFormat(false, 'Dokumen SOP tidak ditemukan');
                    return $this->response->setJSON($result);
                }else if($data['sop_user_id'] != AuthUser()->id ){
                    $result = jsonFormat(false, 'Dokumen SOP tidak ditemukan');
                    return $this->response->setJSON($result);
                }
            }

            $tmp = [];

            if ($id != null) {
                $tmp['data'] = $data;
                $tmp['media'] = $this->mediaModel->where('media_id', $data['sop_media_id'])->findAll();
            }

            return view('dashboard/sop/form', $tmp);
        }
    }

    public function detail()
    {
        $req = $this->request;
        if ($req->isAJAX()) {
            $id = $req->getVar('id') ?? null;
            if ($id != null) {
                $data = $this->sopModel->lookDetail($id);
                if (!empty($data['sop_id'])) {
                     if($data['sop_user_id'] != AuthUser()->id && AuthUser()->type != 4){
                        $result = jsonFormat(false, 'Dokumen SOP tidak ditemukan');
                        return $this->response->setJSON($result);
                    }
                }else{
                    $result = jsonFormat(false, 'Dokumen SOP tidak ditemukan');
                    return $this->response->setJSON($result);
                }
            } else {
                $result = jsonFormat(false, 'Dokumen SOP tidak ditemukan');
                return $this->response->setJSON($result);
            }

            $tmp = [];
            if ($id != null) {
                $tmp['data'] = $data;
            }
            return view('dashboard/sop/info', $tmp);
        }
    }

    public function save()
    {
        $req = $this->request;
        if ($req->isAJAX()) {
            $id = $req->getVar('id') ?? null;
            if ($id != null) {
                $find = $this->sopModel->find($id);
                if (empty($find['sop_id'])) {
                    // Data tidak ditemukan, kirim respons error
                    $result = jsonFormat(false, 'Dokumen SOP tidak ditemukan');
                    return $this->response->setJSON($result);
                }else if($find['sop_user_id'] != AuthUser()->id ){
                    $result = jsonFormat(false, 'Dokumen SOP tidak ditemukan');
                    return $this->response->setJSON($result);
                }
            }
            $data = [
                'sop_nama' => $req->getVar('nama'),
                'sop_media_id' => $req->getVar('media'),
            ];
            // var_dump($data);die;

            if ($req->getVar('media') === '') {
                $result = jsonFormat(false, 'Silahkan masukkan media');
                return $this->response->setJSON($result);
            }

            if ($id != null ? $this->sopModel->update($id, $data) : $this->sopModel->insert($data)) {
                $result = jsonFormat(true, 'Dokumen SOP berhasil disimpan');
            } else {
                $result = jsonFormat(false, $this->sopModel->errors());
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
                $result = jsonFormat(false, 'Dokumen SOP tidak ditemukan');
                return $this->response->setJSON($result);
            }

            $find = $this->sopModel->find($id);
            if (empty($find['sop_id'])) {
                // Data tidak ditemukan, kirim respons error
                $result = jsonFormat(false, 'Dokumen SOP tidak ditemukan');
                return $this->response->setJSON($result);
            }else if($find['sop_user_id'] != AuthUser()->id ){
                $result = jsonFormat(false, 'Dokumen SOP tidak ditemukan');
                return $this->response->setJSON($result);
            }

            // menghapus media
            if (($find['sop_user_id'] == AuthUser()->id)) {
                if ($this->sopModel->delete($id)) {
                    $result = jsonFormat(true, 'Dokumen SOP berhasil dihapus');
                } else {
                    $result = jsonFormat(false, 'Dokumen SOP gagal dihapus');
                }
            } else {
                $result = jsonFormat(false, 'Anda tidak memiliki izin untuk menghapus data ini');
            }
            return $this->response->setJSON($result);
        }
    }
}
