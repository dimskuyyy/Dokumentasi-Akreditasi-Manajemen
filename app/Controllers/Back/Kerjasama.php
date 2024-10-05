<?php

namespace App\Controllers\Back;

use App\Models\MKerjasama;
use App\Models\MMedia;
use App\Libraries\Datatable;
use CodeIgniter\I18n\Time;

class Kerjasama extends BaseController
{
    protected $kerjasamaModel;
    protected $mediaModel;

    public function __construct()
    {
        $this->kerjasamaModel = new MKerjasama();
        $this->mediaModel = new MMedia();
    }

    public function index()
    {
        return view('dashboard/kerjasama/index');
    }

    public function getDatatable()
    {
        return view('dashboard/kerjasama/data_list');
    }

    public function list()
    {
        $req = $this->request;
        if ($req->isAJAX()) {
            $columns = [
                ['dt' => 'id', 'cond' => 'kerjasama_id', 'select' => 'kerjasama_id'],
                ['dt' => 'slug', 'cond' => 'media_slug', 'select' => 'media_slug'],
                ['dt' => 'nama', 'cond' => 'kerjasama_nama', 'select' => 'kerjasama_nama'],
                ['dt' => 'mitra', 'cond' => 'kerjasama_mitra', 'select' => 'kerjasama_mitra'],
                ['dt' => 'skala', 'cond' => 'kerjasama_skala', 'select' => 'kerjasama_skala'],
                ['dt' => 'tahun', 'cond' => 'kerjasama_tahun', 'select' => 'kerjasama_tahun'],
                ['dt' => 'penulis', 'cond' => 'kerjasama_user_id', 'select' => 'kerjasama_user_id'],
                [
                    'dt' => 'tgl_simpan',
                    'cond' => 'kerjasama_created_at',
                    'select' => 'kerjasama_created_at',
                    'formatter' => function ($d) {
                        return $d != null ? date('d-m-Y H:i', strtotime($d)) : '';
                    }
                ],
                [
                    'dt' => 'tgl_update',
                    'cond' => 'kerjasama_updated_at',
                    'select' => 'kerjasama_updated_at',
                    'formatter' => function ($d) {
                        return $d != null ? date('d-m-Y H:i', strtotime($d)) : '';
                    }
                ],
            ];

            $model1 = $this->kerjasamaModel;
            $model2 = new MKerjasama();
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
                $data = $this->kerjasamaModel->find($id);
                if (empty($data['kerjasama_id'])) {
                    $result = jsonFormat(false, 'Kerjasama tidak ditemukan');
                    return $this->response->setJSON($result);
                }else if($data['kerjasama_user_id'] != AuthUser()->id){
                    $result = jsonFormat(false, 'Kerjasama tidak ditemukan');
                    return $this->response->setJSON($result);
                }
            }

            $tmp = [];

            if ($id != null) {
                $tmp['data'] = $data;
                $tmp['media'] = $this->mediaModel->where('media_id', $data['kerjasama_media_id'])->findAll();
            }

            return view('dashboard/kerjasama/form', $tmp);
        }
    }

    public function detail()
    {
        $req = $this->request;
        if ($req->isAJAX()) {
            $id = $req->getVar('id') ?? null;
            if ($id != null) {
                $data = $this->kerjasamaModel->lookDetail($id);
                if (!empty($data['kerjasama_id'])) {
                     if($data['kerjasama_user_id'] != AuthUser()->id){
                        $result = jsonFormat(false, 'Kerjasama tidak ditemukan');
                        return $this->response->setJSON($result);
                    }
                }else{
                    $result = jsonFormat(false, 'Kerjasama tidak ditemukan');
                    return $this->response->setJSON($result);
                }
            } else {
                $result = jsonFormat(false, 'Kerjasama tidak ditemukan');
                return $this->response->setJSON($result);
            }

            $tmp = [];
            if ($id != null) {
                $tmp['data'] = $data;
            }
            return view('dashboard/kerjasama/info', $tmp);
        }
    }

    public function save()
    {
        $req = $this->request;
        if ($req->isAJAX()) {
            $id = $req->getVar('id') ?? null;
            if ($id != null) {
                $find = $this->kerjasamaModel->find($id);
                if (empty($find['kerjasama_id'])) {
                    // Data tidak ditemukan, kirim respons error
                    $result = jsonFormat(false, 'Kerjasama tidak ditemukan');
                    return $this->response->setJSON($result);
                }else if($find['kerjasama_user_id'] != AuthUser()->id){
                    $result = jsonFormat(false, 'Kerjasama tidak ditemukan');
                    return $this->response->setJSON($result);
                }
            }
            $data = [
                'kerjasama_nama' => $req->getVar('nama'),
                'kerjasama_mitra' => $req->getVar('mitra'),
                'kerjasama_skala' => $req->getVar('skala'),
                'kerjasama_tahun' => $req->getVar('tahun'),
                'kerjasama_media_id' => $req->getVar('media'),
            ];
            // var_dump($data);die;

            if ($req->getVar('media') === '') {
                $result = jsonFormat(false, 'Silahkan masukkan media');
                return $this->response->setJSON($result);
            }

            if ($id != null ? $this->kerjasamaModel->update($id, $data) : $this->kerjasamaModel->insert($data)) {
                $result = jsonFormat(true, 'Kerjasama berhasil disimpan');
            } else {
                $result = jsonFormat(false, $this->kerjasamaModel->errors());
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
                $result = jsonFormat(false, 'Kerjasama tidak ditemukan');
                return $this->response->setJSON($result);
            }

            $find = $this->kerjasamaModel->find($id);
            if (empty($find['kerjasama_id'])) {
                // Data tidak ditemukan, kirim respons error
                $result = jsonFormat(false, 'Kerjasama tidak ditemukan');
                return $this->response->setJSON($result);
            }else if($find['kerjasama_user_id'] != AuthUser()->id){
                $result = jsonFormat(false, 'Kerjasama tidak ditemukan');
                return $this->response->setJSON($result);
            }

            // menghapus media
            if (($find['kerjasama_user_id'] == AuthUser()->id)) {
                if ($this->kerjasamaModel->delete($id)) {
                    $result = jsonFormat(true, 'Kerjasama berhasil dihapus');
                } else {
                    $result = jsonFormat(false, 'Kerjasama gagal dihapus');
                }
            } else {
                $result = jsonFormat(false, 'Anda tidak memiliki izin untuk menghapus data ini');
            }
            return $this->response->setJSON($result);
        }
    }
}
