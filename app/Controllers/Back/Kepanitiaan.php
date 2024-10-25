<?php

namespace App\Controllers\Back;

use App\Controllers\BaseController;
use App\Libraries\Datatable;
use App\Models\MKepanitiaan;
use App\Models\MMedia;

class Kepanitiaan extends BaseController
{
    protected $kepanitiaanModel;
    protected $mediaModel;

    public function __construct()
    {
        $this->kepanitiaanModel = new MKepanitiaan();
        $this->mediaModel = new MMedia();
    }

    public function index()
    {
        return view('dashboard/kepanitiaan/index');
    }

    public function getDatatable()
    {
        return view('dashboard/kepanitiaan/data_list');
    }

    public function list()
    {
        $req = $this->request;
        if ($req->isAJAX()) {
            $columns = [
                ['dt' => 'id', 'cond' => 'kepanitiaan_id', 'select' => 'kepanitiaan_id'],
                ['dt' => 'oleh', 'cond' => 'user_nama', 'select' => 'user_nama'],
                ['dt' => 'slug', 'cond' => 'media_slug', 'select' => 'media_slug'],
                ['dt' => 'nama', 'cond' => 'kepanitiaan_nama', 'select' => 'kepanitiaan_nama'],
                ['dt' => 'sebagai', 'cond' => 'kepanitiaan_sebagai', 'select' => 'kepanitiaan_sebagai'],
                ['dt' => 'penulis', 'cond' => 'kepanitiaan_user_id', 'select' => 'kepanitiaan_user_id'],
                [
                    'dt' => 'tgl_simpan',
                    'cond' => 'kepanitiaan_created_at',
                    'select' => 'kepanitiaan_created_at',
                    'formatter' => function ($d) {
                        return $d != null ? date('d-m-Y H:i', strtotime($d)) : '';
                    }
                ],
                [
                    'dt' => 'tgl_update',
                    'cond' => 'kepanitiaan_updated_at',
                    'select' => 'kepanitiaan_updated_at',
                    'formatter' => function ($d) {
                        return $d != null ? date('d-m-Y H:i', strtotime($d)) : '';
                    }
                ],
            ];

            $model1 = $this->kepanitiaanModel;
            $model2 = new MKepanitiaan();
            if ($req->getVar("id") == null) {
                $model1 = $model1->multiData()->where('kepanitiaan_user_id', AuthUser()->id);
                $model2 = $model2->multiData()->where('kepanitiaan_user_id', AuthUser()->id);
            } else {
                $model1 = $model1->multiData()->where('kepanitiaan_user_id', $req->getVar("id"));
                $model2 = $model2->multiData()->where('kepanitiaan_user_id', $req->getVar("id"));
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
                $data = $this->kepanitiaanModel->find($id);
                if (empty($data['kepanitiaan_id'])) {
                    $result = jsonFormat(false, 'Kepanitiaan tidak ditemukan');
                    return $this->response->setJSON($result);
                } else if ($data['kepanitiaan_user_id'] != AuthUser()->id) {
                    $result = jsonFormat(false, 'Kepanitiaan tidak ditemukan');
                    return $this->response->setJSON($result);
                }
            }

            $tmp = [];

            if ($id != null) {
                $tmp['data'] = $data;
                $tmp['media'] = $this->mediaModel->where('media_id', $data['kepanitiaan_media_id'])->findAll();
            }

            return view('dashboard/kepanitiaan/form', $tmp);
        }
    }

    public function detail()
    {
        $req = $this->request;
        if ($req->isAJAX()) {
            $id = $req->getVar('id') ?? null;
            if ($id != null) {
                $data = $this->kepanitiaanModel->lookDetailKepanitiaan($id);
                if (!empty($data['kepanitiaan_id'])) {
                    if ($data['kepanitiaan_user_id'] != AuthUser()->id && AuthUser()->type != 4) {
                        $result = jsonFormat(false, 'Kepanitiaan tidak ditemukan');
                        return $this->response->setJSON($result);
                    }
                } else {
                    $result = jsonFormat(false, 'Kepanitiaan tidak ditemukan');
                    return $this->response->setJSON($result);
                }
            } else {
                $result = jsonFormat(false, 'Kepanitiaan tidak ditemukan');
                return $this->response->setJSON($result);
            }

            $tmp = [];
            if ($id != null) {
                $tmp['data'] = $data;
            }
            return view('dashboard/kepanitiaan/info', $tmp);
        }
    }

    public function save()
    {
        $req = $this->request;
        if ($req->isAJAX()) {
            $id = $req->getVar('id') ?? null;
            if ($id != null) {
                $find = $this->kepanitiaanModel->find($id);
                if (empty($find['kepanitiaan_id'])) {
                    // Data tidak ditemukan, kirim respons error
                    $result = jsonFormat(false, 'Kepanitiaan tidak ditemukan');
                    return $this->response->setJSON($result);
                } else if ($find['kepanitiaan_user_id'] != AuthUser()->id) {
                    $result = jsonFormat(false, 'Kepanitiaan tidak ditemukan');
                    return $this->response->setJSON($result);
                }
            }
            $data = [
                'kepanitiaan_nama' => $req->getVar('nama'),
                'kepanitiaan_sebagai' => $req->getVar('sebagai'),
                'kepanitiaan_media_id' => $req->getVar('media'),
            ];
            // var_dump($data);die;

            if ($req->getVar('media') === '') {
                $result = jsonFormat(false, 'Silahkan masukkan media');
                return $this->response->setJSON($result);
            }

            if ($id != null ? $this->kepanitiaanModel->update($id, $data) : $this->kepanitiaanModel->insert($data)) {
                $result = jsonFormat(true, 'Kepanitiaan berhasil disimpan');
            } else {
                $result = jsonFormat(false, $this->kepanitiaanModel->errors());
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
                $result = jsonFormat(false, 'Kepanitiaan tidak ditemukan');
                return $this->response->setJSON($result);
            }

            $find = $this->kepanitiaanModel->find($id);
            if (empty($find['kepanitiaan_id'])) {
                // Data tidak ditemukan, kirim respons error
                $result = jsonFormat(false, 'Kepanitiaan tidak ditemukan');
                return $this->response->setJSON($result);
            } else if ($find['kepanitiaan_user_id'] != AuthUser()->id) {
                $result = jsonFormat(false, 'Kepanitiaan tidak ditemukan');
                return $this->response->setJSON($result);
            }

            // menghapus media
            if (($find['kepanitiaan_user_id'] == AuthUser()->id)) {
                if ($this->kepanitiaanModel->delete($id)) {
                    $result = jsonFormat(true, 'Kepanitiaan berhasil dihapus');
                } else {
                    $result = jsonFormat(false, 'Kepanitiaan gagal dihapus');
                }
            } else {
                $result = jsonFormat(false, 'Anda tidak memiliki izin untuk menghapus data ini');
            }
            return $this->response->setJSON($result);
        }
    }
}
