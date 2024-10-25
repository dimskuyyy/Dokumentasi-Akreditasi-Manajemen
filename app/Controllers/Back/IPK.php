<?php

namespace App\Controllers\Back;

use App\Controllers\BaseController;
use App\Libraries\Datatable;
use App\Models\MMedia;
use App\Models\MIPK;

class IPK extends BaseController
{
    protected $ipkMahasiswaModel;
    protected $mediaModel;

    public function __construct()
    {
        $this->ipkMahasiswaModel = new MIPK();
        $this->mediaModel = new MMedia();
    }

    public function index()
    {
        return view('dashboard/ipk-mahasiswa/index');
    }

    public function getDatatable()
    {
        return view('dashboard/ipk-mahasiswa/data_list');
    }

    public function list()
    {
        $req = $this->request;
        if ($req->isAJAX()) {
            $columns = [
                ['dt' => 'id', 'cond' => 'ipk_id', 'select' => 'ipk_id'],
                ['dt' => 'slug', 'cond' => 'media_slug', 'select' => 'media_slug'],
                ['dt' => 'tahun', 'cond' => 'ipk_tahun', 'select' => 'ipk_tahun'],
                ['dt' => 'rata_rata', 'cond' => 'ipk_rata_rata', 'select' => 'ipk_rata_rata'],
                ['dt' => 'oleh', 'cond' => 'user_nama', 'select' => 'user_nama'],
                ['dt' => 'penulis', 'cond' => 'ipk_user_id', 'select' => 'ipk_user_id'],
                [
                    'dt' => 'tgl_simpan',
                    'cond' => 'ipk_created_at',
                    'select' => 'ipk_created_at',
                    'formatter' => function ($d) {
                        return $d != null ? date('d-m-Y H:i', strtotime($d)) : '';
                    }
                ],
                [
                    'dt' => 'tgl_update',
                    'cond' => 'ipk_updated_at',
                    'select' => 'ipk_updated_at',
                    'formatter' => function ($d) {
                        return $d != null ? date('d-m-Y H:i', strtotime($d)) : '';
                    }
                ],
            ];

            $model1 = $this->ipkMahasiswaModel;
            $model2 = new MIPK();
            if($req->getVar("id") == null){
                $model1 = $model1->multiData()->where('ipk_user_id', AuthUser()->id);
                $model2 = $model2->multiData()->where('ipk_user_id', AuthUser()->id);
            }else{
                $model1 = $model1->multiData()->where('ipk_user_id', $req->getVar("id"));
                $model2 = $model2->multiData()->where('ipk_user_id', $req->getVar("id"));
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
                $data = $this->ipkMahasiswaModel->find($id);
                if (empty($data['ipk_id'])) {
                    $result = jsonFormat(false, 'IPK Mahasiswa tidak ditemukan');
                    return $this->response->setJSON($result);
                }else if($data['ipk_user_id'] != AuthUser()->id ){
                    $result = jsonFormat(false, 'IPK Mahasiswa tidak ditemukan');
                    return $this->response->setJSON($result);
                }
            }

            $tmp = [];

            if ($id != null) {
                $tmp['data'] = $data;
                $tmp['media'] = $this->mediaModel->where('media_id', $data['ipk_media_id'])->findAll();
            }

            return view('dashboard/ipk-mahasiswa/form', $tmp);
        }
    }

    public function detail()
    {
        $req = $this->request;
        if ($req->isAJAX()) {
            $id = $req->getVar('id') ?? null;
            if ($id != null) {
                $data = $this->ipkMahasiswaModel->lookDetail($id);
                if (!empty($data['ipk_id'])) {
                     if($data['ipk_user_id'] != AuthUser()->id && AuthUser()->type != 4){
                        $result = jsonFormat(false, 'IPK Mahasiswa tidak ditemukan');
                        return $this->response->setJSON($result);
                    }
                }else{
                    $result = jsonFormat(false, 'IPK Mahasiswa tidak ditemukan');
                    return $this->response->setJSON($result);
                }
            } else {
                $result = jsonFormat(false, 'IPK Mahasiswa tidak ditemukan');
                return $this->response->setJSON($result);
            }

            $tmp = [];
            if ($id != null) {
                $tmp['data'] = $data;
            }
            return view('dashboard/ipk-mahasiswa/info', $tmp);
        }
    }

    public function save()
    {
        $req = $this->request;
        if ($req->isAJAX()) {
            $id = $req->getVar('id') ?? null;
            if ($id != null) {
                $find = $this->ipkMahasiswaModel->find($id);
                if (empty($find['ipk_id'])) {
                    // Data tidak ditemukan, kirim respons error
                    $result = jsonFormat(false, 'IPK Mahasiswa tidak ditemukan');
                    return $this->response->setJSON($result);
                }else if($find['ipk_user_id'] != AuthUser()->id ){
                    $result = jsonFormat(false, 'IPK Mahasiswa tidak ditemukan');
                    return $this->response->setJSON($result);
                }
            }
            $data = [
                'ipk_tahun' => $req->getVar('tahun'),
                'ipk_rata_rata' => $req->getVar('rata_rata'),
                'ipk_media_id' => $req->getVar('media'),
            ];
            // var_dump($data);die;

            if ($req->getVar('media') === '') {
                $result = jsonFormat(false, 'Silahkan masukkan media');
                return $this->response->setJSON($result);
            }

            if ($id != null ? $this->ipkMahasiswaModel->update($id, $data) : $this->ipkMahasiswaModel->insert($data)) {
                $result = jsonFormat(true, 'IPK Mahasiswa berhasil disimpan');
            } else {
                $result = jsonFormat(false, $this->ipkMahasiswaModel->errors());
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
                $result = jsonFormat(false, 'IPK Mahasiswa tidak ditemukan');
                return $this->response->setJSON($result);
            }

            $find = $this->ipkMahasiswaModel->find($id);
            if (empty($find['ipk_id'])) {
                // Data tidak ditemukan, kirim respons error
                $result = jsonFormat(false, 'IPK Mahasiswa tidak ditemukan');
                return $this->response->setJSON($result);
            }else if($find['ipk_user_id'] != AuthUser()->id ){
                $result = jsonFormat(false, 'IPK Mahasiswa tidak ditemukan');
                return $this->response->setJSON($result);
            }

            // menghapus media
            if (($find['ipk_user_id'] == AuthUser()->id)) {
                if ($this->ipkMahasiswaModel->delete($id)) {
                    $result = jsonFormat(true, 'IPK Mahasiswa berhasil dihapus');
                } else {
                    $result = jsonFormat(false, 'IPK Mahasiswa gagal dihapus');
                }
            } else {
                $result = jsonFormat(false, 'Anda tidak memiliki izin untuk menghapus data ini');
            }
            return $this->response->setJSON($result);
        }
    }
}
