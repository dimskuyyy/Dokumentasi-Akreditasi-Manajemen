<?php

namespace App\Controllers\Back;

use App\Controllers\BaseController;
use App\Libraries\Datatable;
use App\Models\MRenstraAnggaran;
use App\Models\MMedia;

class Anggaran extends BaseController
{
    protected $anggaranModel;
    protected $mediaModel;

    public function __construct()
    {
        $this->anggaranModel = new MRenstraAnggaran();
        $this->mediaModel = new MMedia();
    }

    public function index()
    {
        return view('dashboard/anggaran/index');
    }

    public function getDatatable()
    {
        return view('dashboard/anggaran/data_list');
    }

    public function list()
    {
        $req = $this->request;
        if ($req->isAJAX()) {
            $columns = [
                ['dt' => 'id', 'cond' => 'ra_id', 'select' => 'ra_id'],
                ['dt' => 'oleh', 'cond' => 'user_nama', 'select' => 'user_nama'],
                ['dt' => 'slug', 'cond' => 'media_slug', 'select' => 'media_slug'],
                ['dt' => 'tahun', 'cond' => 'ra_tahun', 'select' => 'ra_tahun'],
                ['dt' => 'penulis', 'cond' => 'ra_user_id', 'select' => 'ra_user_id'],
                [
                    'dt' => 'tgl_simpan',
                    'cond' => 'ra_created_at',
                    'select' => 'ra_created_at',
                    'formatter' => function ($d) {
                        return $d != null ? date('d-m-Y H:i', strtotime($d)) : '';
                    }
                ],
                [
                    'dt' => 'tgl_update',
                    'cond' => 'ra_updated_at',
                    'select' => 'ra_updated_at',
                    'formatter' => function ($d) {
                        return $d != null ? date('d-m-Y H:i', strtotime($d)) : '';
                    }
                ],
            ];

            $model1 = $this->anggaranModel;
            $model2 = new MRenstraAnggaran();
            if($req->getVar("id") == null){
                $model1 = $model1->multiDataAnggaran()->where('ra_user_id', AuthUser()->id);
                $model2 = $model2->multiDataAnggaran()->where('ra_user_id', AuthUser()->id);
            }else{
                $model1 = $model1->multiDataAnggaran()->where('ra_user_id', $req->getVar("id"));
                $model2 = $model2->multiDataAnggaran()->where('ra_user_id', $req->getVar("id"));
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
                $data = $this->anggaranModel->find($id);
                if (empty($data['ra_id'])) {
                    $result = jsonFormat(false, 'Dokumen Anggaran tidak ditemukan');
                    return $this->response->setJSON($result);
                }else if($data['ra_user_id'] != AuthUser()->id && $data['ra_type'] != 2){
                    $result = jsonFormat(false, 'Dokumen Anggaran tidak ditemukan');
                    return $this->response->setJSON($result);
                }
            }

            $tmp = [];

            if ($id != null) {
                $tmp['data'] = $data;
                $tmp['media'] = $this->mediaModel->where('media_id', $data['ra_media_id'])->findAll();
            }

            return view('dashboard/anggaran/form', $tmp);
        }
    }

    public function detail()
    {
        $req = $this->request;
        if ($req->isAJAX()) {
            $id = $req->getVar('id') ?? null;
            if ($id != null) {
                $data = $this->anggaranModel->lookDetailAnggaran($id);
                if (!empty($data['ra_id']) && $data['ra_type'] == 2) {
                     if($data['ra_user_id'] != AuthUser()->id && AuthUser()->type != 4){
                        $result = jsonFormat(false, 'Dokumen Anggaran tidak ditemukan');
                        return $this->response->setJSON($result);
                    }
                }else{
                    $result = jsonFormat(false, 'Dokumen Anggaran tidak ditemukan');
                    return $this->response->setJSON($result);
                }
            } else {
                $result = jsonFormat(false, 'Dokumen Anggaran tidak ditemukan');
                return $this->response->setJSON($result);
            }

            $tmp = [];
            if ($id != null) {
                $tmp['data'] = $data;
            }
            return view('dashboard/anggaran/info', $tmp);
        }
    }

    public function save()
    {
        $req = $this->request;
        if ($req->isAJAX()) {
            $id = $req->getVar('id') ?? null;
            if ($id != null) {
                $find = $this->anggaranModel->find($id);
                if (empty($find['ra_id'])) {
                    // Data tidak ditemukan, kirim respons error
                    $result = jsonFormat(false, 'Dokumen Anggaran tidak ditemukan');
                    return $this->response->setJSON($result);
                }else if($find['ra_user_id'] != AuthUser()->id && $find['ra_type'] != 2){
                    $result = jsonFormat(false, 'Dokumen Anggaran tidak ditemukan');
                    return $this->response->setJSON($result);
                }
            }
            $data = [
                'ra_tahun' => $req->getVar('tahun'),
                'ra_type' => 2,
                'ra_media_id' => $req->getVar('media'),
            ];
            // var_dump($data);die;

            if ($req->getVar('media') === '') {
                $result = jsonFormat(false, 'Silahkan masukkan media');
                return $this->response->setJSON($result);
            }

            if ($id != null ? $this->anggaranModel->update($id, $data) : $this->anggaranModel->insert($data)) {
                $result = jsonFormat(true, 'Dokumen Anggaran berhasil disimpan');
            } else {
                $result = jsonFormat(false, $this->anggaranModel->errors());
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
                $result = jsonFormat(false, 'Dokumen Anggaran tidak ditemukan');
                return $this->response->setJSON($result);
            }

            $find = $this->anggaranModel->find($id);
            if (empty($find['ra_id'])) {
                // Data tidak ditemukan, kirim respons error
                $result = jsonFormat(false, 'Dokumen Anggaran tidak ditemukan');
                return $this->response->setJSON($result);
            }else if($find['ra_user_id'] != AuthUser()->id && $find['ra_type'] != 2){
                $result = jsonFormat(false, 'Dokumen Anggaran tidak ditemukan');
                return $this->response->setJSON($result);
            }

            // menghapus media
            if (($find['ra_user_id'] == AuthUser()->id)) {
                if ($this->anggaranModel->delete($id)) {
                    $result = jsonFormat(true, 'Dokumen Anggaran berhasil dihapus');
                } else {
                    $result = jsonFormat(false, 'Dokumen Anggaran gagal dihapus');
                }
            } else {
                $result = jsonFormat(false, 'Anda tidak memiliki izin untuk menghapus data ini');
            }
            return $this->response->setJSON($result);
        }
    }
}
