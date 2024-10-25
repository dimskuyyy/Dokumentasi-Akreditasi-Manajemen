<?php

namespace App\Controllers\Back;

use App\Controllers\BaseController;
use App\Libraries\Datatable;
use App\Models\MAkademik;
use App\Models\MMedia;

class PanduanAkademik extends BaseController
{
    protected $panduanModel;
    protected $mediaModel;

    public function __construct()
    {
        $this->panduanModel = new MAkademik();
        $this->mediaModel = new MMedia();
    }

    public function index()
    {
        return view('dashboard/panduan-akademik/index');
    }

    public function getDatatable()
    {   
        $tmp = [
            'data' => $this->panduanModel->where('akademik_type',1)->get()->getRowArray()
        ];
        return view('dashboard/panduan-akademik/data_list',$tmp);
    }

    public function list()
    {
        $req = $this->request;
        if ($req->isAJAX()) {
            $columns = [
                ['dt' => 'id', 'cond' => 'akademik_id', 'select' => 'akademik_id'],
                ['dt' => 'oleh', 'cond' => 'user_nama', 'select' => 'user_nama'],
                ['dt' => 'slug', 'cond' => 'media_slug', 'select' => 'media_slug'],
                ['dt' => 'penulis', 'cond' => 'akademik_user_id', 'select' => 'akademik_user_id'],
                [
                    'dt' => 'tgl_simpan',
                    'cond' => 'akademik_created_at',
                    'select' => 'akademik_created_at',
                    'formatter' => function ($d) {
                        return $d != null ? date('d-m-Y H:i', strtotime($d)) : '';
                    }
                ],
                [
                    'dt' => 'tgl_update',
                    'cond' => 'akademik_updated_at',
                    'select' => 'akademik_updated_at',
                    'formatter' => function ($d) {
                        return $d != null ? date('d-m-Y H:i', strtotime($d)) : '';
                    }
                ],
            ];

            $model1 = $this->panduanModel;
            $model2 = new MAkademik();
            if ($req->getVar("id") == null) {
                $model1 = $model1->multiDataPanduan()->where('akademik_user_id', AuthUser()->id);
                $model2 = $model2->multiDataPanduan()->where('akademik_user_id', AuthUser()->id);
            } else {
                $model1 = $model1->multiDataPanduan()->where('akademik_user_id', $req->getVar("id"));
                $model2 = $model2->multiDataPanduan()->where('akademik_user_id', $req->getVar("id"));
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
            $panduan = $this->panduanModel->where('akademik_type', 1)->get()->getRowArray();
            if (!is_null($panduan) && $id == null) {
                $result = jsonFormat(false, 'Dokumen Panduan Akademik Sudah Ada, Hanya Bisa Input Satu Kali, Lakukan Edit');
                return $this->response->setJSON($result);
            }
            if ($id != null) {
                $data = $this->panduanModel->find($id);
                if (empty($data['akademik_id'])) {
                    $result = jsonFormat(false, 'Dokumen Panduan Akademik tidak ditemukan');
                    return $this->response->setJSON($result);
                } else if ($data['akademik_user_id'] != AuthUser()->id && $data['akademik_type'] != 1) {
                    $result = jsonFormat(false, 'Dokumen Panduan Akademik tidak ditemukan');
                    return $this->response->setJSON($result);
                }
            }

            $tmp = [];

            if ($id != null) {
                $tmp['data'] = $data;
                $tmp['media'] = $this->mediaModel->where('media_id', $data['akademik_media_id'])->findAll();
            }

            return view('dashboard/panduan-akademik/form', $tmp);
        }
    }

    public function detail()
    {
        $req = $this->request;
        if ($req->isAJAX()) {
            $id = $req->getVar('id') ?? null;
            if ($id != null) {
                $data = $this->panduanModel->lookDetailPanduan($id);
                if (!empty($data['akademik_id']) && $data['akademik_type'] == 1) {
                    if ($data['akademik_user_id'] != AuthUser()->id && AuthUser()->type != 4) {
                        $result = jsonFormat(false, 'Dokumen Panduan Akademik tidak ditemukan');
                        return $this->response->setJSON($result);
                    }
                } else {
                    $result = jsonFormat(false, 'Dokumen Panduan Akademik tidak ditemukan');
                    return $this->response->setJSON($result);
                }
            } else {
                $result = jsonFormat(false, 'Dokumen Panduan Akademik tidak ditemukan');
                return $this->response->setJSON($result);
            }

            $tmp = [];
            if ($id != null) {
                $tmp['data'] = $data;
            }
            return view('dashboard/panduan-akademik/info', $tmp);
        }
    }

    public function save()
    {
        $req = $this->request;
        if ($req->isAJAX()) {
            $id = $req->getVar('id') ?? null;
            $panduan = $this->panduanModel->where('akademik_type', 1)->get()->getRowArray();
            if (!is_null($panduan) && $id == null) {
                $result = jsonFormat(false, 'Dokumen Panduan Akademik Sudah Ada, Hanya Bisa Input Satu Kali, Lakukan Edit');
                return $this->response->setJSON($result);
            }
            if ($id != null) {
                $find = $this->panduanModel->find($id);
                if (empty($find['akademik_id'])) {
                    // Data tidak ditemukan, kirim respons error
                    $result = jsonFormat(false, 'Dokumen Panduan Akademik tidak ditemukan');
                    return $this->response->setJSON($result);
                } else if ($find['akademik_user_id'] != AuthUser()->id && $find['akademik_type'] != 1) {
                    $result = jsonFormat(false, 'Dokumen Panduan Akademik tidak ditemukan');
                    return $this->response->setJSON($result);
                }
            }
            $data = [
                'akademik_type' => 1,
                'akademik_media_id' => $req->getVar('media'),
            ];
            // var_dump($data);die;

            if ($req->getVar('media') === '') {
                $result = jsonFormat(false, 'Silahkan masukkan media');
                return $this->response->setJSON($result);
            }

            if ($id != null ? $this->panduanModel->update($id, $data) : $this->panduanModel->insert($data)) {
                $result = jsonFormat(true, 'Dokumen Panduan Akademik berhasil disimpan');
            } else {
                $result = jsonFormat(false, $this->panduanModel->errors());
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
                $result = jsonFormat(false, 'Dokumen Panduan Akademik tidak ditemukan');
                return $this->response->setJSON($result);
            }

            $find = $this->panduanModel->find($id);
            if (empty($find['akademik_id'])) {
                // Data tidak ditemukan, kirim respons error
                $result = jsonFormat(false, 'Dokumen Panduan Akademik tidak ditemukan');
                return $this->response->setJSON($result);
            } else if ($find['akademik_user_id'] != AuthUser()->id && $find['akademik_type'] != 1) {
                $result = jsonFormat(false, 'Dokumen Panduan Akademik tidak ditemukan');
                return $this->response->setJSON($result);
            }

            // menghapus media
            if (($find['akademik_user_id'] == AuthUser()->id)) {
                if ($this->panduanModel->delete($id)) {
                    $result = jsonFormat(true, 'Dokumen Panduan Akademik berhasil dihapus');
                } else {
                    $result = jsonFormat(false, 'Dokumen Panduan Akademik gagal dihapus');
                }
            } else {
                $result = jsonFormat(false, 'Anda tidak memiliki izin untuk menghapus data ini');
            }
            return $this->response->setJSON($result);
        }
    }
}
