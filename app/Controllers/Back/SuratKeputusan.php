<?php

namespace App\Controllers\Back;

use App\Controllers\BaseController;
use App\Libraries\Datatable;
use App\Models\MDokumen;
use App\Models\MMedia;

class SuratKeputusan extends BaseController
{
    protected $SKModel;
    protected $mediaModel;

    public function __construct()
    {
        $this->SKModel = new MDokumen();
        $this->mediaModel = new MMedia();
    }

    public function index()
    {
        return view('dashboard/surat-keputusan/index');
    }

    public function getDatatable()
    {
        return view('dashboard/surat-keputusan/data_list');
    }

    public function list()
    {
        $req = $this->request;
        if ($req->isAJAX()) {
            $columns = [
                ['dt' => 'id', 'cond' => 'dokumen_id', 'select' => 'dokumen_id'],
                ['dt' => 'slug', 'cond' => 'media_slug', 'select' => 'media_slug'],
                ['dt' => 'nama', 'cond' => 'dokumen_nama', 'select' => 'dokumen_nama'],
                ['dt' => 'oleh', 'cond' => 'user_nama', 'select' => 'user_nama'],
                ['dt' => 'nomor', 'cond' => 'dokumen_nomor', 'select' => 'dokumen_nomor'],
                ['dt' => 'penulis', 'cond' => 'dokumen_user_id', 'select' => 'dokumen_user_id'],
                [
                    'dt' => 'tgl_simpan',
                    'cond' => 'dokumen_created_at',
                    'select' => 'dokumen_created_at',
                    'formatter' => function ($d) {
                        return $d != null ? date('d-m-Y H:i', strtotime($d)) : '';
                    }
                ],
                [
                    'dt' => 'tgl_update',
                    'cond' => 'dokumen_updated_at',
                    'select' => 'dokumen_updated_at',
                    'formatter' => function ($d) {
                        return $d != null ? date('d-m-Y H:i', strtotime($d)) : '';
                    }
                ],
            ];

            $model1 = $this->SKModel;
            $model2 = new MDokumen();
            if($req->getVar("id") == null){
                $model1 = $model1->multiDataSuratKeputusan()->where('dokumen_user_id', AuthUser()->id);
                $model2 = $model2->multiDataSuratKeputusan()->where('dokumen_user_id', AuthUser()->id);
            }else{
                $model1 = $model1->multiDataSuratKeputusan()->where('dokumen_user_id', $req->getVar("id"));
                $model2 = $model2->multiDataSuratKeputusan()->where('dokumen_user_id', $req->getVar("id"));
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
                $data = $this->SKModel->find($id);
                if (empty($data['dokumen_id'])) {
                    $result = jsonFormat(false, 'Surat Keputusan tidak ditemukan');
                    return $this->response->setJSON($result);
                }else if($data['dokumen_user_id'] != AuthUser()->id && $data['dokumen_type'] != 1){
                    $result = jsonFormat(false, 'Surat Keputusan tidak ditemukan');
                    return $this->response->setJSON($result);
                }
            }

            $tmp = [];

            if ($id != null) {
                $tmp['data'] = $data;
                $tmp['media'] = $this->mediaModel->where('media_id', $data['dokumen_media_id'])->findAll();
            }

            return view('dashboard/surat-keputusan/form', $tmp);
        }
    }

    public function detail()
    {
        $req = $this->request;
        if ($req->isAJAX()) {
            $id = $req->getVar('id') ?? null;
            if ($id != null) {
                $data = $this->SKModel->lookDetailSuratKeputusan($id);
                if (!empty($data['dokumen_id']) && $data['dokumen_type'] == 1) {
                     if($data['dokumen_user_id'] != AuthUser()->id && AuthUser()->type != 4){
                        $result = jsonFormat(false, 'Surat Keputusan tidak ditemukan');
                        return $this->response->setJSON($result);
                    }
                }else{
                    $result = jsonFormat(false, 'Surat Keputusan tidak ditemukan');
                    return $this->response->setJSON($result);
                }
            } else {
                $result = jsonFormat(false, 'Surat Keputusan tidak ditemukan');
                return $this->response->setJSON($result);
            }

            

            $tmp = [];
            if ($id != null) {
                $tmp['data'] = $data;
            }
            return view('dashboard/surat-keputusan/info', $tmp);
        }
    }

    public function save()
    {
        $req = $this->request;
        if ($req->isAJAX()) {
            $id = $req->getVar('id') ?? null;
            if ($id != null) {
                $find = $this->SKModel->find($id);
                if (empty($find['dokumen_id'])) {
                    // Data tidak ditemukan, kirim respons error
                    $result = jsonFormat(false, 'Surat Keputusan tidak ditemukan');
                    return $this->response->setJSON($result);
                }else if($find['dokumen_user_id'] != AuthUser()->id && $find['dokumen_type'] != 1){
                    $result = jsonFormat(false, 'Surat Keputusan tidak ditemukan');
                    return $this->response->setJSON($result);
                }
            }
            $data = [
                'dokumen_nama' => $req->getVar('nama'),
                'dokumen_nomor' => $req->getVar('nomor'),
                'dokumen_type' => 1,
                'dokumen_media_id' => $req->getVar('media'),
            ];
            // var_dump($data);die;

            if ($req->getVar('media') === '') {
                $result = jsonFormat(false, 'Silahkan masukkan media');
                return $this->response->setJSON($result);
            }

            if ($id != null ? $this->SKModel->update($id, $data) : $this->SKModel->insert($data)) {
                $result = jsonFormat(true, 'Surat Keputusan berhasil disimpan');
            } else {
                $result = jsonFormat(false, $this->SKModel->errors());
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
                $result = jsonFormat(false, 'Surat Keputusan tidak ditemukan');
                return $this->response->setJSON($result);
            }

            $find = $this->SKModel->find($id);
            if (empty($find['dokumen_id'])) {
                // Data tidak ditemukan, kirim respons error
                $result = jsonFormat(false, 'Surat Keputusan tidak ditemukan');
                return $this->response->setJSON($result);
            }else if($find['dokumen_user_id'] != AuthUser()->id && $find['dokumen_type'] != 1){
                $result = jsonFormat(false, 'Surat Keputusan tidak ditemukan');
                return $this->response->setJSON($result);
            }

            // menghapus media
            if (($find['dokumen_user_id'] == AuthUser()->id)) {
                if ($this->SKModel->delete($id)) {
                    $result = jsonFormat(true, 'Surat Keputusan berhasil dihapus');
                } else {
                    $result = jsonFormat(false, 'Surat Keputusan gagal dihapus');
                }
            } else {
                $result = jsonFormat(false, 'Anda tidak memiliki izin untuk menghapus data ini');
            }
            return $this->response->setJSON($result);
        }
    }
}
