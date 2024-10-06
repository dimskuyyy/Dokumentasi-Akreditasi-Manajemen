<?php

namespace App\Controllers\Back;

use App\Controllers\BaseController;
use App\Libraries\Datatable;
use App\Models\MMahasiswaRecords;
use App\Models\MMedia;

class Prestasi extends BaseController
{
    protected $prestasiModel;
    protected $mediaModel;

    public function __construct()
    {
        $this->prestasiModel = new MMahasiswaRecords();
        $this->mediaModel = new MMedia();
    }

    public function index()
    {
        return view('dashboard/prestasi/index');
    }

    public function getDatatable()
    {
        return view('dashboard/prestasi/data_list');
    }

    public function list()
    {
        $req = $this->request;
        if ($req->isAJAX()) {
            $columns = [
                ['dt' => 'id', 'cond' => 'mahasiswa_id', 'select' => 'mahasiswa_id'],
                ['dt' => 'slug', 'cond' => 'media_slug', 'select' => 'media_slug'],
                ['dt' => 'nama', 'cond' => 'mahasiswa_record', 'select' => 'mahasiswa_record'],
                ['dt' => 'oleh', 'cond' => 'user_nama', 'select' => 'user_nama'],
                ['dt' => 'penulis', 'cond' => 'mahasiswa_user_id', 'select' => 'mahasiswa_user_id'],
                [
                    'dt' => 'tgl_simpan',
                    'cond' => 'mahasiswa_created_at',
                    'select' => 'mahasiswa_created_at',
                    'formatter' => function ($d) {
                        return $d != null ? date('d-m-Y H:i', strtotime($d)) : '';
                    }
                ],
                [
                    'dt' => 'tgl_update',
                    'cond' => 'mahasiswa_updated_at',
                    'select' => 'mahasiswa_updated_at',
                    'formatter' => function ($d) {
                        return $d != null ? date('d-m-Y H:i', strtotime($d)) : '';
                    }
                ],
            ];

            $model1 = $this->prestasiModel;
            $model2 = new MMahasiswaRecords();
            $model1 = $model1->multiDataPrestasi();
            $model2 = $model2->multiDataPrestasi();
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
                $data = $this->prestasiModel->find($id);
                if (empty($data['mahasiswa_id'])) {
                    $result = jsonFormat(false, 'Prestasi Mahasiswa tidak ditemukan');
                    return $this->response->setJSON($result);
                }else if($data['mahasiswa_user_id'] != AuthUser()->id && $data['mahasiswa_records_type'] != 1){
                    $result = jsonFormat(false, 'Prestasi Mahasiswa tidak ditemukan');
                    return $this->response->setJSON($result);
                }
            }

            $tmp = [];

            if ($id != null) {
                $tmp['data'] = $data;
                $tmp['media'] = $this->mediaModel->where('media_id', $data['mahasiswa_media_id'])->findAll();
            }

            return view('dashboard/prestasi/form', $tmp);
        }
    }

    public function detail()
    {
        $req = $this->request;
        if ($req->isAJAX()) {
            $id = $req->getVar('id') ?? null;
            if ($id != null) {
                $data = $this->prestasiModel->lookDetailPrestasi($id);
                if (!empty($data['mahasiswa_id'])) {
                     if($data['mahasiswa_user_id'] != AuthUser()->id && $data['mahasiswa_records_type'] != 1){
                        $result = jsonFormat(false, 'Prestasi Mahasiswa tidak ditemukan');
                        return $this->response->setJSON($result);
                    }
                }else{
                    $result = jsonFormat(false, 'Prestasi Mahasiswa tidak ditemukan');
                    return $this->response->setJSON($result);
                }
            } else {
                $result = jsonFormat(false, 'Prestasi Mahasiswa tidak ditemukan');
                return $this->response->setJSON($result);
            }

            $tmp = [];
            if ($id != null) {
                $tmp['data'] = $data;
            }
            return view('dashboard/prestasi/info', $tmp);
        }
    }

    public function save()
    {
        $req = $this->request;
        if ($req->isAJAX()) {
            $id = $req->getVar('id') ?? null;
            if ($id != null) {
                $find = $this->prestasiModel->find($id);
                if (empty($find['mahasiswa_id'])) {
                    // Data tidak ditemukan, kirim respons error
                    $result = jsonFormat(false, 'Prestasi Mahasiswa tidak ditemukan');
                    return $this->response->setJSON($result);
                }else if($find['mahasiswa_user_id'] != AuthUser()->id && $find['mahasiswa_records_type'] != 1){
                    $result = jsonFormat(false, 'Prestasi Mahasiswa tidak ditemukan');
                    return $this->response->setJSON($result);
                }
            }
            $data = [
                'mahasiswa_record' => $req->getVar('record'),
                'mahasiswa_records_type' => 2,
                'mahasiswa_media_id' => $req->getVar('media'),
            ];
            // var_dump($data);die;

            if ($req->getVar('media') === '') {
                $result = jsonFormat(false, 'Silahkan masukkan media');
                return $this->response->setJSON($result);
            }

            if ($id != null ? $this->prestasiModel->update($id, $data) : $this->prestasiModel->insert($data)) {
                $result = jsonFormat(true, 'Prestasi Mahasiswa berhasil disimpan');
            } else {
                $result = jsonFormat(false, $this->prestasiModel->errors());
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
                $result = jsonFormat(false, 'Prestasi Mahasiswa tidak ditemukan');
                return $this->response->setJSON($result);
            }

            $find = $this->prestasiModel->find($id);
            if (empty($find['mahasiswa_id'])) {
                // Data tidak ditemukan, kirim respons error
                $result = jsonFormat(false, 'Prestasi Mahasiswa tidak ditemukan');
                return $this->response->setJSON($result);
            }else if($find['mahasiswa_user_id'] != AuthUser()->id && $find['mahasiswa_records_type'] != 1){
                $result = jsonFormat(false, 'Prestasi Mahasiswa tidak ditemukan');
                return $this->response->setJSON($result);
            }

            // menghapus media
            if (($find['mahasiswa_user_id'] == AuthUser()->id)) {
                if ($this->prestasiModel->delete($id)) {
                    $result = jsonFormat(true, 'Prestasi Mahasiswa berhasil dihapus');
                } else {
                    $result = jsonFormat(false, 'Prestasi Mahasiswa gagal dihapus');
                }
            } else {
                $result = jsonFormat(false, 'Anda tidak memiliki izin untuk menghapus data ini');
            }
            return $this->response->setJSON($result);
        }
    }
}
