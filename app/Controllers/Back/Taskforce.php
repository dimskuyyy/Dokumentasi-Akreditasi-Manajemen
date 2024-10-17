<?php

namespace App\Controllers\Back;

use App\Controllers\BaseController;
use App\Libraries\Datatable;
use App\Models\User;

class Taskforce extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    // Divide index by user type -> fast development purpose
    public function dekan()
    {
        return view('dashboard/taskforce/dekan/index');
    }

    public function kajur()
    {
        return view('dashboard/taskforce/kajur/index');
    }

    public function koor()
    {
        return view('dashboard/taskforce/koor/index');
    }

    public function dosen()
    {
        return view('dashboard/taskforce/dosen/index');
    }

    public function getDataTableDekan()
    {
        return view('dashboard/taskforce/dekan/dekan_list');
    }

    public function getDataTableKajur()
    {
        return view('dashboard/taskforce/kajur/kajur_list');
    }

    public function getDataTableKoor()
    {
        return view('dashboard/taskforce/koor/koor_list');
    }

    public function getDataTableDosen()
    {
        return view('dashboard/taskforce/dosen/dosen_list');
    }

    // Dekan Feature
    public function getDataTableFiturDekan($page)
    {
        $req = $this->request;
        $tmp = [
            'uid' => $req->getVar("id")
        ];
        return view('dashboard/taskforce/dekan/' . $page . '_list', $tmp);
    }

    // Kajur Feature
    public function getDataTableFiturKajur($page)
    {
        $req = $this->request;
        $tmp = [
            'uid' => $req->getVar("id")
        ];
        return view('dashboard/taskforce/kajur/' . $page . '_list', $tmp);
    }


    // Koor Feature
    public function getDataTableFiturKoor($page)
    {
        $req = $this->request;
        $tmp = [
            'uid' => $req->getVar("id")
        ];
        return view('dashboard/taskforce/koor/' . $page . '_list', $tmp);
    }

    // Dosen Feature
    public function getDataTableFiturDosen($page)
    {
        $req = $this->request;
        $tmp = [
            'uid' => $req->getVar("id")
        ];
        return view('dashboard/taskforce/dosen/' . $page . '_list', $tmp);
    }

    public function dekanList()
    {
        $req = $this->request;
        if ($req->isAJAX()) {
            $columns = [
                ['dt' => 'id', 'cond' => 'user_id', 'select' => 'user_id'],
                ['dt' => 'nama', 'cond' => 'user_nama', 'select' => 'user_nama'],
                ['dt' => 'kerjasama', 'cond' => 'jumlah_kerjasama', 'select' => 'jumlah_kerjasama'],
                ['dt' => 'surat_keputusan', 'cond' => 'jumlah_sk', 'select' => 'jumlah_sk'],
                ['dt' => 'surat_tugas', 'cond' => 'jumlah_surat_tugas', 'select' => 'jumlah_surat_tugas'],
                ['dt' => 'kegiatan', 'cond' => 'jumlah_kegiatan', 'select' => 'jumlah_kegiatan'],
            ];

            $model1 = $this->userModel;
            $model2 = new User();
            $model1 = $model1->checkDekan();
            $model2 = $model2->checkDekan();
            $result = (new Datatable())->run($model1, $model2, $req->getVar('datatables'), $columns);
            return $this->response->setJSON($result);
        }
    }

    public function kajurList()
    {
        $req = $this->request;
        if ($req->isAJAX()) {
            $columns = [
                ['dt' => 'id', 'cond' => 'user_id', 'select' => 'user_id'],
                ['dt' => 'nama', 'cond' => 'user_nama', 'select' => 'user_nama'],
                ['dt' => 'surat_tugas', 'cond' => 'jumlah_surat_tugas', 'select' => 'jumlah_surat_tugas'],
                ['dt' => 'kegiatan', 'cond' => 'jumlah_kegiatan', 'select' => 'jumlah_kegiatan'],
            ];

            $model1 = $this->userModel;
            $model2 = new User();
            $model1 = $model1->checkKajur();
            $model2 = $model2->checkKajur();
            $result = (new Datatable())->run($model1, $model2, $req->getVar('datatables'), $columns);
            return $this->response->setJSON($result);
        }
    }

    public function koorList()
    {
        $req = $this->request;
        if ($req->isAJAX()) {
            $columns = [
                ['dt' => 'id', 'cond' => 'user_id', 'select' => 'user_id'],
                ['dt' => 'nama', 'cond' => 'user_nama', 'select' => 'user_nama'],
                ['dt' => 'kerjasama', 'cond' => 'jumlah_kerjasama', 'select' => 'jumlah_kerjasama'],
                ['dt' => 'kegiatan', 'cond' => 'jumlah_kegiatan', 'select' => 'jumlah_kegiatan'],
            ];

            $model1 = $this->userModel;
            $model2 = new User();
            $model1 = $model1->checkKoor();
            $model2 = $model2->checkKoor();
            $result = (new Datatable())->run($model1, $model2, $req->getVar('datatables'), $columns);
            return $this->response->setJSON($result);
        }
    }

    public function dosenList()
    {
        $req = $this->request;
        if ($req->isAJAX()) {
            $columns = [
                ['dt' => 'id', 'cond' => 'user_id', 'select' => 'user_id'],
                ['dt' => 'nama', 'cond' => 'user_nama', 'select' => 'user_nama'],
                ['dt' => 'pengajaran', 'cond' => 'jumlah_pengajaran', 'select' => 'jumlah_pengajaran'],
                ['dt' => 'penelitian', 'cond' => 'jumlah_penelitian', 'select' => 'jumlah_penelitian'],
                ['dt' => 'pengabdian', 'cond' => 'jumlah_pengabdian', 'select' => 'jumlah_pengabdian'],
                ['dt' => 'sertifikat', 'cond' => 'jumlah_sertifikat', 'select' => 'jumlah_sertifikat'],
                ['dt' => 'haki', 'cond' => 'jumlah_haki', 'select' => 'jumlah_haki'],
                ['dt' => 'kegiatan_luar', 'cond' => 'jumlah_kegiatan_luar', 'select' => 'jumlah_kegiatan_luar'],
                ['dt' => 'kegiatan_dalam', 'cond' => 'jumlah_kegiatan_dalam', 'select' => 'jumlah_kegiatan_dalam'],
                ['dt' => 'kepanitiaan', 'cond' => 'jumlah_kepanitiaan', 'select' => 'jumlah_kepanitiaan'],
            ];

            $model1 = $this->userModel;
            $model2 = new User();
            $model1 = $model1->checkDosen();
            $model2 = $model2->checkDosen();
            $result = (new Datatable())->run($model1, $model2, $req->getVar('datatables'), $columns);
            return $this->response->setJSON($result);
        }
    }
}
