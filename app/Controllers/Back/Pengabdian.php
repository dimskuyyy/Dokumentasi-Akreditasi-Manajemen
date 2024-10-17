<?php

namespace App\Controllers\Back;

use App\Models\MProyek;
use App\Libraries\Datatable;
use CodeIgniter\I18n\Time;

class Pengabdian extends BaseController
{
    protected $pengabdianModel;

    public function __construct()
    {
        $this->pengabdianModel = new MProyek();
    }

    public function index()
    {
        return view('dashboard/pengabdian/index');
    }

    public function getDatatable()
    {
        return view('dashboard/pengabdian/data_list');
    }

    public function list()
    {
        $req = $this->request;
        if ($req->isAJAX()) {
            $columns = [
                ['dt' => 'id', 'cond' => 'proyek_id', 'select' => 'proyek_id'],
                ['dt' => 'oleh', 'cond' => 'user_nama', 'select' => 'user_nama'],
                ['dt' => 'judul', 'cond' => 'proyek_judul', 'select' => 'proyek_judul'],
                ['dt' => 'sebagai', 'cond' => 'proyek_sebagai', 'select' => 'proyek_sebagai'],
                ['dt' => 'tahapan', 'cond' => 'proyek_tahapan', 'select' => 'proyek_tahapan'],
                ['dt' => 'artikel', 'cond' => 'proyek_artikel', 'select' => 'proyek_artikel'],
                ['dt' => 'penulis', 'cond' => 'proyek_user_id', 'select' => 'proyek_user_id'],
                [
                    'dt' => 'tgl_simpan',
                    'cond' => 'proyek_created_at',
                    'select' => 'proyek_created_at',
                    'formatter' => function ($d) {
                        return $d != null ? date('d-m-Y H:i', strtotime($d)) : '';
                    }
                ],
                [
                    'dt' => 'tgl_update',
                    'cond' => 'proyek_updated_at',
                    'select' => 'proyek_updated_at',
                    'formatter' => function ($d) {
                        return $d != null ? date('d-m-Y H:i', strtotime($d)) : '';
                    }
                ],
            ];

            $model1 = $this->pengabdianModel;
            $model2 = new MProyek();
            if($req->getVar("id") == null){
                $model1 = $model1->multiDataPengabdian()->where('proyek_user_id', AuthUser()->id);
                $model2 = $model2->multiDataPengabdian()->where('proyek_user_id', AuthUser()->id);
            }else{
                $model1 = $model1->multiDataPengabdian()->where('proyek_user_id', $req->getVar("id"));
                $model2 = $model2->multiDataPengabdian()->where('proyek_user_id', $req->getVar("id"));
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
                $data = $this->pengabdianModel->find($id);
                if (empty($data['proyek_id'])) {
                    $result = jsonFormat(false, 'Pengabdian tidak ditemukan');
                    return $this->response->setJSON($result);
                }else if($data['proyek_user_id'] != AuthUser()->id && $data['proyek_type'] != 2){
                    $result = jsonFormat(false, 'Pengabdian tidak ditemukan');
                    return $this->response->setJSON($result);
                }
            }

            $tmp = [];

            if ($id != null) {
                $tmp['data'] = $data;
            }

            return view('dashboard/pengabdian/form', $tmp);
        }
    }

    public function detail()
    {
        $req = $this->request;
        if ($req->isAJAX()) {
            $id = $req->getVar('id') ?? null;
            if ($id != null) {
                $data = $this->pengabdianModel->lookDetailPengabdian($id);
                if (!empty($data['proyek_id']) && $data['proyek_type'] == 2) {
                     if($data['proyek_user_id'] != AuthUser()->id && AuthUser()->type != 4){
                        $result = jsonFormat(false, 'Pengabdian tidak ditemukan');
                        return $this->response->setJSON($result);
                    }
                }else{
                    $result = jsonFormat(false, 'Pengabdian tidak ditemukan');
                    return $this->response->setJSON($result);
                }
            } else {
                $result = jsonFormat(false, 'Pengabdian tidak ditemukan');
                return $this->response->setJSON($result);
            }

            $tmp = [];
            if ($id != null) {
                $tmp['data'] = $data;
            }
            return view('dashboard/pengabdian/info', $tmp);
        }
    }

    public function save()
    {
        $req = $this->request;
        if ($req->isAJAX()) {
            $id = $req->getVar('id') ?? null;
            if ($id != null) {
                $find = $this->pengabdianModel->find($id);
                if (empty($find['proyek_id'])) {
                    // Data tidak ditemukan, kirim respons error
                    $result = jsonFormat(false, 'Pengabdian tidak ditemukan');
                    return $this->response->setJSON($result);
                }else if($find['proyek_user_id'] != AuthUser()->id && $find['proyek_type'] != 2){
                    $result = jsonFormat(false, 'Pengabdian tidak ditemukan');
                    return $this->response->setJSON($result);
                }
            }
            $data = [
                'proyek_judul'      => $req->getVar('judul'),
                'proyek_sebagai'    => $req->getVar('sebagai'),
                'proyek_tahapan'    => $req->getVar('tahapan'),
                'proyek_type'       => 2,
            ];

            if($data['proyek_tahapan'] == 'Terbit'){
                if($req->getVar('artikel') !== ''){
                    $data['proyek_artikel'] = $req->getVar('artikel');
                }else{
                    $result = jsonFormat(false, 'Artikel Wajib Diisi Jika Terbit');
                    return $this->response->setJSON($result);
                }
            }else{
                $data['proyek_artikel'] = null;
            }
            // var_dump($data);die;

            if ($id != null ? $this->pengabdianModel->update($id, $data) : $this->pengabdianModel->insert($data)) {
                $result = jsonFormat(true, 'Pengabdian berhasil disimpan');
            } else {
                $result = jsonFormat(false, $this->pengabdianModel->errors());
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
                $result = jsonFormat(false, 'Pengabdian tidak ditemukan');
                return $this->response->setJSON($result);
            }

            $find = $this->pengabdianModel->find($id);
            if (empty($find['proyek_id'])) {
                // Data tidak ditemukan, kirim respons error
                $result = jsonFormat(false, 'Pengabdian tidak ditemukan');
                return $this->response->setJSON($result);
            }else if($find['proyek_user_id'] != AuthUser()->id  && $find['proyek_type'] != 2){
                $result = jsonFormat(false, 'Pengabdian tidak ditemukan');
                return $this->response->setJSON($result);
            }

            // menghapus media
            if (($find['proyek_user_id'] == AuthUser()->id)) {
                if ($this->pengabdianModel->delete($id)) {
                    $result = jsonFormat(true, 'Pengabdian berhasil dihapus');
                } else {
                    $result = jsonFormat(false, 'Pengabdian gagal dihapus');
                }
            } else {
                $result = jsonFormat(false, 'Anda tidak memiliki izin untuk menghapus data ini');
            }
            return $this->response->setJSON($result);
        }
    }
}
