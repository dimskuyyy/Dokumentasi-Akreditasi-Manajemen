<?php

namespace App\Controllers\Back;

use App\Controllers\BaseController;
use App\Libraries\Datatable;
use App\Models\MMedia;
use App\Models\MPengajaranDosen;

class Pengajaran extends BaseController
{
    protected $pengajaranModel;
    protected $mediaModel;

    public function __construct()
    {
        $this->pengajaranModel = new MPengajaranDosen();
        $this->mediaModel = new MMedia();
    }

    public function index()
    {
        return view('dashboard/pengajaran-dosen/index');
    }

    public function getDatatable()
    {
        return view('dashboard/pengajaran-dosen/data_list');
    }

    public function list()
    {
        $req = $this->request;
        if ($req->isAJAX()) {
            $columns = [
                ['dt' => 'id', 'cond' => 'pengajaran_id', 'select' => 'pengajaran_id'],
                ['dt' => 'slug', 'cond' => 'media_slug', 'select' => 'media_slug'],
                ['dt' => 'nama', 'cond' => 'pengajaran_nama', 'select' => 'pengajaran_nama'],
                ['dt' => 'oleh', 'cond' => 'user_nama', 'select' => 'user_nama'],
                ['dt' => 'penulis', 'cond' => 'pengajaran_user_id', 'select' => 'pengajaran_user_id'],
                [
                    'dt' => 'tgl_simpan',
                    'cond' => 'pengajaran_created_at',
                    'select' => 'pengajaran_created_at',
                    'formatter' => function ($d) {
                        return $d != null ? date('d-m-Y H:i', strtotime($d)) : '';
                    }
                ],
                [
                    'dt' => 'tgl_update',
                    'cond' => 'pengajaran_updated_at',
                    'select' => 'pengajaran_updated_at',
                    'formatter' => function ($d) {
                        return $d != null ? date('d-m-Y H:i', strtotime($d)) : '';
                    }
                ],
            ];

            $model1 = $this->pengajaranModel;
            $model2 = new MPengajaranDosen();
            if($req->getVar("id") == null){
                $model1 = $model1->multiData()->where('pengajaran_user_id', AuthUser()->id);
                $model2 = $model2->multiData()->where('pengajaran_user_id', AuthUser()->id);
            }else{
                $model1 = $model1->multiData()->where('pengajaran_user_id', $req->getVar("id"));
                $model2 = $model2->multiData()->where('pengajaran_user_id', $req->getVar("id"));
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
                $data = $this->pengajaranModel->find($id);
                if (empty($data['pengajaran_id'])) {
                    $result = jsonFormat(false, 'SK Pengajaran tidak ditemukan');
                    return $this->response->setJSON($result);
                }else if($data['pengajaran_user_id'] != AuthUser()->id ){
                    $result = jsonFormat(false, 'SK Pengajaran tidak ditemukan');
                    return $this->response->setJSON($result);
                }
            }

            $tmp = [];

            if ($id != null) {
                $tmp['data'] = $data;
                $tmp['media'] = $this->mediaModel->where('media_id', $data['pengajaran_media_id'])->findAll();
            }

            return view('dashboard/pengajaran-dosen/form', $tmp);
        }
    }

    public function detail()
    {
        $req = $this->request;
        if ($req->isAJAX()) {
            $id = $req->getVar('id') ?? null;
            if ($id != null) {
                $data = $this->pengajaranModel->lookDetail($id);
                if (!empty($data['pengajaran_id'])) {
                     if($data['pengajaran_user_id'] != AuthUser()->id && AuthUser()->type != 4){
                        $result = jsonFormat(false, 'SK Pengajaran tidak ditemukan');
                        return $this->response->setJSON($result);
                    }
                }else{
                    $result = jsonFormat(false, 'SK Pengajaran tidak ditemukan');
                    return $this->response->setJSON($result);
                }
            } else {
                $result = jsonFormat(false, 'SK Pengajaran tidak ditemukan');
                return $this->response->setJSON($result);
            }

            $tmp = [];
            if ($id != null) {
                $tmp['data'] = $data;
            }
            return view('dashboard/pengajaran-dosen/info', $tmp);
        }
    }

    public function save()
    {
        $req = $this->request;
        if ($req->isAJAX()) {
            $id = $req->getVar('id') ?? null;
            if ($id != null) {
                $find = $this->pengajaranModel->find($id);
                if (empty($find['pengajaran_id'])) {
                    // Data tidak ditemukan, kirim respons error
                    $result = jsonFormat(false, 'SK Pengajaran tidak ditemukan');
                    return $this->response->setJSON($result);
                }else if($find['pengajaran_user_id'] != AuthUser()->id ){
                    $result = jsonFormat(false, 'SK Pengajaran tidak ditemukan');
                    return $this->response->setJSON($result);
                }
            }
            $data = [
                'pengajaran_nama' => $req->getVar('nama'),
                'pengajaran_media_id' => $req->getVar('media'),
            ];
            // var_dump($data);die;

            if ($req->getVar('media') === '') {
                $result = jsonFormat(false, 'Silahkan masukkan media');
                return $this->response->setJSON($result);
            }

            if ($id != null ? $this->pengajaranModel->update($id, $data) : $this->pengajaranModel->insert($data)) {
                $result = jsonFormat(true, 'SK Pengajaran berhasil disimpan');
            } else {
                $result = jsonFormat(false, $this->pengajaranModel->errors());
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
                $result = jsonFormat(false, 'SK Pengajaran tidak ditemukan');
                return $this->response->setJSON($result);
            }

            $find = $this->pengajaranModel->find($id);
            if (empty($find['pengajaran_id'])) {
                // Data tidak ditemukan, kirim respons error
                $result = jsonFormat(false, 'SK Pengajaran tidak ditemukan');
                return $this->response->setJSON($result);
            }else if($find['pengajaran_user_id'] != AuthUser()->id ){
                $result = jsonFormat(false, 'SK Pengajaran tidak ditemukan');
                return $this->response->setJSON($result);
            }

            // menghapus media
            if (($find['pengajaran_user_id'] == AuthUser()->id)) {
                if ($this->pengajaranModel->delete($id)) {
                    $result = jsonFormat(true, 'SK Pengajaran berhasil dihapus');
                } else {
                    $result = jsonFormat(false, 'SK Pengajaran gagal dihapus');
                }
            } else {
                $result = jsonFormat(false, 'Anda tidak memiliki izin untuk menghapus data ini');
            }
            return $this->response->setJSON($result);
        }
    }
}
