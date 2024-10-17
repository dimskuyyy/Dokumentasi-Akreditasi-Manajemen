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

    public function dekan()
    {
        return view('dashboard/taskforce/dekan/index');
    }

    public function kajur()
    {
        return view('dashboard/taskforce/kajur/index');
    }

    public function getDataTableDekan()
    {
        return view('dashboard/taskforce/dekan/dekan_list');
    }

    public function getDataTableKajur()
    {
        return view('dashboard/taskforce/kajur/kajur_list');
    }

    // Dekan Feature
    public function getDataTableFiturDekan($page){
        $req = $this->request;
        $tmp = [
            'uid' => $req->getVar("id")
        ];
        return view('dashboard/taskforce/dekan/'.$page.'_list', $tmp);
    }

    // Kajur Feature
    public function getDataTableFiturKajur($page){
        $req = $this->request;
        $tmp = [
            'uid' => $req->getVar("id")
        ];
        return view('dashboard/taskforce/kajur/'.$page.'_list', $tmp);
    }
    
    public function dekanList(){
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

    public function kajurList(){
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
}
