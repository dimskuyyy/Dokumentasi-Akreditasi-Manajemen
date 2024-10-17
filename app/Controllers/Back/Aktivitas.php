<?php

namespace App\Controllers\Back;

use App\Controllers\BaseController;
use App\Libraries\Datatable;
use App\Models\MMahasiswaRecords;
use App\Models\MMedia;

class Aktivitas extends BaseController
{
    protected $aktivitasModel;
    protected $mediaModel;

    public function __construct()
    {
        $this->aktivitasModel = new MMahasiswaRecords();
        $this->mediaModel = new MMedia();
    }

    public function index()
    {
        return view('dashboard/aktivitas/index');
    }

    public function getDatatable()
    {
        return view('dashboard/aktivitas/data_list');
    }

    public function list()
    {
        $req = $this->request;
        if ($req->isAJAX()) {
            $columns = [
                ['dt' => 'id', 'cond' => 'mahasiswa_id', 'select' => 'mahasiswa_id'],
                ['dt' => 'slug', 'cond' => 'media_slug', 'select' => 'media_slug'],
                ['dt' => 'oleh', 'cond' => 'user_nama', 'select' => 'user_nama'],
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

            $model1 = $this->aktivitasModel;
            $model2 = new MMahasiswaRecords();
            if($req->getVar("id") == null){
                $model1 = $model1->multiDataAktivitas()->where('mahasiswa_user_id', AuthUser()->id);
                $model2 = $model2->multiDataAktivitas()->where('mahasiswa_user_id', AuthUser()->id);
            }else{
                $model1 = $model1->multiDataAktivitas()->where('mahasiswa_user_id', $req->getVar("id"));
                $model2 = $model2->multiDataAktivitas()->where('mahasiswa_user_id', $req->getVar("id"));
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
                $data = $this->aktivitasModel->find($id);
                if (empty($data['mahasiswa_id'])) {
                    $result = jsonFormat(false, 'Aktivitas Mahasiswa tidak ditemukan');
                    return $this->response->setJSON($result);
                }else if($data['mahasiswa_user_id'] != AuthUser()->id && $data['mahasiswa_records_type'] != 1){
                    $result = jsonFormat(false, 'Aktivitas Mahasiswa tidak ditemukan');
                    return $this->response->setJSON($result);
                }
            }

            $tmp = [];

            if ($id != null) {
                $tmp['data'] = $data;
                $tmp['media'] = $this->mediaModel->where('media_id', $data['mahasiswa_media_id'])->findAll();
            }

            return view('dashboard/aktivitas/form', $tmp);
        }
    }

    public function detail()
    {
        $req = $this->request;
        if ($req->isAJAX()) {
            $id = $req->getVar('id') ?? null;
            if ($id != null) {
                $data = $this->aktivitasModel->lookDetailAktivitas($id);
                if (!empty($data['mahasiswa_id']) && $data['mahasiswa_records_type'] == 1) {
                     if($data['mahasiswa_user_id'] != AuthUser()->id && AuthUser()->type != 4){
                        $result = jsonFormat(false, 'Aktivitas Mahasiswa tidak ditemukan');
                        return $this->response->setJSON($result);
                    }
                }else{
                    $result = jsonFormat(false, 'Aktivitas Mahasiswa tidak ditemukan');
                    return $this->response->setJSON($result);
                }
            } else {
                $result = jsonFormat(false, 'Aktivitas Mahasiswa tidak ditemukan');
                return $this->response->setJSON($result);
            }

            $tmp = [];
            if ($id != null) {
                $tmp['data'] = $data;
            }
            return view('dashboard/aktivitas/info', $tmp);
        }
    }

    public function save()
    {
        $req = $this->request;
        if ($req->isAJAX()) {
            $id = $req->getVar('id') ?? null;
            if ($id != null) {
                $find = $this->aktivitasModel->find($id);
                if (empty($find['mahasiswa_id'])) {
                    // Data tidak ditemukan, kirim respons error
                    $result = jsonFormat(false, 'Aktivitas Mahasiswa tidak ditemukan');
                    return $this->response->setJSON($result);
                }else if($find['mahasiswa_user_id'] != AuthUser()->id && $find['mahasiswa_records_type'] != 1){
                    $result = jsonFormat(false, 'Aktivitas Mahasiswa tidak ditemukan');
                    return $this->response->setJSON($result);
                }
            }
            $data = [
                'mahasiswa_record' => $req->getVar('record'),
                'mahasiswa_records_type' => 1,
                'mahasiswa_media_id' => $req->getVar('media'),
            ];
            // var_dump($data);die;

            if ($req->getVar('media') === '') {
                $result = jsonFormat(false, 'Silahkan masukkan media');
                return $this->response->setJSON($result);
            }

            if ($id != null ? $this->aktivitasModel->update($id, $data) : $this->aktivitasModel->insert($data)) {
                $result = jsonFormat(true, 'Aktivitas Mahasiswa berhasil disimpan');
            } else {
                $result = jsonFormat(false, $this->aktivitasModel->errors());
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
                $result = jsonFormat(false, 'Aktivitas Mahasiswa tidak ditemukan');
                return $this->response->setJSON($result);
            }

            $find = $this->aktivitasModel->find($id);
            if (empty($find['mahasiswa_id'])) {
                // Data tidak ditemukan, kirim respons error
                $result = jsonFormat(false, 'Aktivitas Mahasiswa tidak ditemukan');
                return $this->response->setJSON($result);
            }else if($find['mahasiswa_user_id'] != AuthUser()->id && $find['mahasiswa_records_type'] != 1){
                $result = jsonFormat(false, 'Aktivitas Mahasiswa tidak ditemukan');
                return $this->response->setJSON($result);
            }

            // menghapus media
            if (($find['mahasiswa_user_id'] == AuthUser()->id)) {
                if ($this->aktivitasModel->delete($id)) {
                    $result = jsonFormat(true, 'Aktivitas Mahasiswa berhasil dihapus');
                } else {
                    $result = jsonFormat(false, 'Aktivitas Mahasiswa gagal dihapus');
                }
            } else {
                $result = jsonFormat(false, 'Anda tidak memiliki izin untuk menghapus data ini');
            }
            return $this->response->setJSON($result);
        }
    }
}
