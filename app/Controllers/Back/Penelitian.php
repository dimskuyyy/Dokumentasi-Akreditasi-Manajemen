<?php

namespace App\Controllers\Back;

use App\Models\MProyek;
use App\Libraries\Datatable;
use CodeIgniter\I18n\Time;

class Penelitian extends BaseController
{
    protected $penelitianModel;

    public function __construct()
    {
        $this->penelitianModel = new MProyek();
    }

    public function index()
    {
        return view('dashboard/penelitian/index');
    }

    public function getDatatable()
    {
        return view('dashboard/penelitian/data_list');
    }

    public function list()
    {
        $req = $this->request;
        if ($req->isAJAX()) {
            $columns = [
                ['dt' => 'id', 'cond' => 'proyek_id', 'select' => 'proyek_id'],
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

            $model1 = $this->penelitianModel;
            $model2 = new MProyek();
            $model1 = $model1->multiDataPenelitian();
            $model2 = $model2->multiDataPenelitian();
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
                $data = $this->penelitianModel->find($id);
                if (empty($data['proyek_id'])) {
                    $result = jsonFormat(false, 'Penelitian tidak ditemukan');
                    return $this->response->setJSON($result);
                }else if($data['proyek_user_id'] != AuthUser()->id && $data['proyek_type'] != 1){
                    $result = jsonFormat(false, 'Penelitian tidak ditemukan');
                    return $this->response->setJSON($result);
                }
            }

            $tmp = [];

            if ($id != null) {
                $tmp['data'] = $data;
            }

            return view('dashboard/penelitian/form', $tmp);
        }
    }

    public function detail()
    {
        $req = $this->request;
        if ($req->isAJAX()) {
            $id = $req->getVar('id') ?? null;
            if ($id != null) {
                $data = $this->penelitianModel->lookDetailPenelitian($id);
                if (!empty($data['proyek_id'])) {
                     if($data['proyek_user_id'] != AuthUser()->id && $data['proyek_type'] != 1){
                        $result = jsonFormat(false, 'Penelitian tidak ditemukan');
                        return $this->response->setJSON($result);
                    }
                }else{
                    $result = jsonFormat(false, 'Penelitian tidak ditemukan');
                    return $this->response->setJSON($result);
                }
            } else {
                $result = jsonFormat(false, 'Penelitian tidak ditemukan');
                return $this->response->setJSON($result);
            }

            $tmp = [];
            if ($id != null) {
                $tmp['data'] = $data;
            }
            return view('dashboard/penelitian/info', $tmp);
        }
    }

    public function save()
    {
        $req = $this->request;
        if ($req->isAJAX()) {
            $id = $req->getVar('id') ?? null;
            if ($id != null) {
                $find = $this->penelitianModel->find($id);
                if (empty($find['proyek_id'])) {
                    // Data tidak ditemukan, kirim respons error
                    $result = jsonFormat(false, 'Penelitian tidak ditemukan');
                    return $this->response->setJSON($result);
                }else if($find['proyek_user_id'] != AuthUser()->id && $find['proyek_type'] != 1){
                    $result = jsonFormat(false, 'Penelitian tidak ditemukan');
                    return $this->response->setJSON($result);
                }
            }
            $data = [
                'proyek_judul'      => $req->getVar('judul'),
                'proyek_sebagai'    => $req->getVar('sebagai'),
                'proyek_tahapan'    => $req->getVar('tahapan'),
                'proyek_type'       => 1,
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

            if ($id != null ? $this->penelitianModel->update($id, $data) : $this->penelitianModel->insert($data)) {
                $result = jsonFormat(true, 'Penelitian berhasil disimpan');
            } else {
                $result = jsonFormat(false, $this->penelitianModel->errors());
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
                $result = jsonFormat(false, 'Penelitian tidak ditemukan');
                return $this->response->setJSON($result);
            }

            $find = $this->penelitianModel->find($id);
            if (empty($find['proyek_id'])) {
                // Data tidak ditemukan, kirim respons error
                $result = jsonFormat(false, 'Penelitian tidak ditemukan');
                return $this->response->setJSON($result);
            }else if($find['proyek_user_id'] != AuthUser()->id  && $find['proyek_type'] != 1){
                $result = jsonFormat(false, 'Penelitian tidak ditemukan');
                return $this->response->setJSON($result);
            }

            // menghapus media
            if (($find['proyek_user_id'] == AuthUser()->id)) {
                if ($this->penelitianModel->delete($id)) {
                    $result = jsonFormat(true, 'Penelitian berhasil dihapus');
                } else {
                    $result = jsonFormat(false, 'Penelitian gagal dihapus');
                }
            } else {
                $result = jsonFormat(false, 'Anda tidak memiliki izin untuk menghapus data ini');
            }
            return $this->response->setJSON($result);
        }
    }
}
