<?php

namespace App\Controllers\Back;

use App\Controllers\BaseController;
use App\Libraries\Datatable;
use App\Models\User;
use App\Models\MSurvey;

class Taskforce extends BaseController
{
    protected $userModel;
    protected $surveyModel;

    public function __construct()
    {
        $this->userModel = new User();
        $this->surveyModel = new MSurvey();
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

    public function mahasiswa()
    {
        return view('dashboard/taskforce/mahasiswa/index');
    }

    public function alumni()
    {
        return view('dashboard/taskforce/alumni/index');
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

    public function getDataTableMahasiswa()
    {
        return view('dashboard/taskforce/mahasiswa/mahasiswa_list');
    }

    public function getDataTableAlumni()
    {
        return view('dashboard/taskforce/alumni/alumni_list');
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

    // Mahasiswa Feature
    public function getDataTableFiturMahasiswa($page)
    {
        $req = $this->request;
        $tmp = [
            'uid' => $req->getVar("id")
        ];
        return view('dashboard/taskforce/mahasiswa/' . $page . '_list', $tmp);
    }

    public function dekanList()
    {
        $req = $this->request;
        if ($req->isAJAX()) {
            $columns = [
                ['dt' => 'id', 'cond' => 'user_id', 'select' => 'user_id'],
                ['dt' => 'nama', 'cond' => 'user_nama', 'select' => 'user_nama'],
                ['dt' => 'kerjasama', 'cond' => 'jumlah_kerjasama', 'select' => 'jumlah_kerjasama'],
                ['dt' => 'sop', 'cond' => 'jumlah_sop', 'select' => 'jumlah_sop'],
                ['dt' => 'renstra', 'cond' => 'jumlah_renstra', 'select' => 'jumlah_renstra'],
                ['dt' => 'anggaran', 'cond' => 'jumlah_anggaran', 'select' => 'jumlah_anggaran'],
                ['dt' => 'surat_keputusan', 'cond' => 'jumlah_sk', 'select' => 'jumlah_sk'],
                ['dt' => 'surat_tugas', 'cond' => 'jumlah_surat_tugas', 'select' => 'jumlah_surat_tugas'],
                ['dt' => 'panduan', 'cond' => 'jumlah_panduan', 'select' => 'jumlah_panduan'],
                ['dt' => 'etika', 'cond' => 'jumlah_etika', 'select' => 'jumlah_etika'],
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

    public function mahasiswaList()
    {
        $req = $this->request;
        if ($req->isAJAX()) {
            $columns = [
                ['dt' => 'id', 'cond' => 'user_id', 'select' => 'user_id'],
                ['dt' => 'nama', 'cond' => 'user_nama', 'select' => 'user_nama'],
                ['dt' => 'aktivitas', 'cond' => 'jumlah_aktivitas', 'select' => 'jumlah_aktivitas'],
                ['dt' => 'penelitian', 'cond' => 'jumlah_penelitian', 'select' => 'jumlah_penelitian'],
                ['dt' => 'pengabdian', 'cond' => 'jumlah_pengabdian', 'select' => 'jumlah_pengabdian'],
                ['dt' => 'prestasi', 'cond' => 'jumlah_prestasi', 'select' => 'jumlah_prestasi'],
                ['dt' => 'kepanitiaan', 'cond' => 'jumlah_kepanitiaan', 'select' => 'jumlah_kepanitiaan'],
            ];

            $model1 = $this->userModel;
            $model2 = new User();
            $model1 = $model1->checkMahasiswa();
            $model2 = $model2->checkMahasiswa();
            $result = (new Datatable())->run($model1, $model2, $req->getVar('datatables'), $columns);
            return $this->response->setJSON($result);
        }
    }

    public function alumniList()
    {
        $req = $this->request;
        if ($req->isAJAX()) {
            $columns = [
                ['dt' => 'id', 'cond' => 'user_id', 'select' => 'user_id'],
                ['dt' => 'nama', 'cond' => 'user_nama', 'select' => 'user_nama'],
                ['dt' => 'survey', 'cond' => 'filled_survey', 'select' => 'filled_survey'],
                ['dt' => 'kuisioner', 'cond' => 'filled_kuisioner', 'select' => 'filled_kuisioner'],
            ];

            $model1 = $this->userModel;
            $model2 = new User();
            $model1 = $model1->checkAlumni();
            $model2 = $model2->checkAlumni();
            $result = (new Datatable())->run($model1, $model2, $req->getVar('datatables'), $columns);
            return $this->response->setJSON($result);
        }
    }

    public function surveyFormAlumni()
    {
        $req = $this->request;
        if ($req->isAJAX()) {
            $find = $this->surveyModel->getData($req->getVar("id"));
            $tmp = [
                'data'  => $find ? $find : null
            ];
            return view('dashboard/taskforce/alumni/form', $tmp);
        }
    }
}
