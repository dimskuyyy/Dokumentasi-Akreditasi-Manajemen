<?php

namespace App\Controllers\Back;

use App\Controllers\BaseController;
use App\Libraries\Datatable;
use App\Models\MKegiatan;
use App\Models\MMedia;

class Kegiatan extends BaseController
{
    protected $kegiatanModel;
    protected $mediaModel;

    public function __construct()
    {
        $this->kegiatanModel = new MKegiatan();
        $this->mediaModel = new MMedia();
    }

    public function index($page = null)
    {
        if ($page != null || AuthUser()->type == 5) {
            if ($page == "luar-kampus" || $page == "dalam-kampus") {
                $tmp = [
                    'page'  => $page
                ];
            } else {
                return redirect()->to('/wbpanel');
                // $tmp = [];
            }
        } else {
            $tmp = [];
        }
        return view('dashboard/kegiatan/index', $tmp);
    }

    public function getDatatable($page = null)
    {
        if ($page != null || AuthUser()->type == 5) {
            if ($page == "luar-kampus" || $page == "dalam-kampus") {
                $tmp = [
                    'page'  => $page
                ];
            } else {
                // var_dump($page);die;
                $result = jsonFormat(false, 'Kegiatan Dosen Harus Spesifik');
                return $this->response->setJSON($result);
                // $tmp = [];
            }
        } else {
            $tmp = [];
        }
        return view('dashboard/kegiatan/data_list', $tmp);
    }

    public function list($page = null)
    {

        $req = $this->request;
        if ($req->isAJAX()) {
            $columns = [
                ['dt' => 'id', 'cond' => 'kegiatan_id', 'select' => 'kegiatan_id'],
                ['dt' => 'slug', 'cond' => 'media_slug', 'select' => 'media_slug'],
                ['dt' => 'oleh', 'cond' => 'user_nama', 'select' => 'user_nama'],
                ['dt' => 'nama', 'cond' => 'kegiatan_nama', 'select' => 'kegiatan_nama'],
                ['dt' => 'sebagai', 'cond' => 'kegiatan_sebagai', 'select' => 'kegiatan_sebagai'],
                ['dt' => 'tahun', 'cond' => 'kegiatan_tahun', 'select' => 'kegiatan_tahun'],
                ['dt' => 'penulis', 'cond' => 'kegiatan_user_id', 'select' => 'kegiatan_user_id'],
                [
                    'dt' => 'tgl_simpan',
                    'cond' => 'kegiatan_created_at',
                    'select' => 'kegiatan_created_at',
                    'formatter' => function ($d) {
                        return $d != null ? date('d-m-Y H:i', strtotime($d)) : '';
                    }
                ],
                [
                    'dt' => 'tgl_update',
                    'cond' => 'kegiatan_updated_at',
                    'select' => 'kegiatan_updated_at',
                    'formatter' => function ($d) {
                        return $d != null ? date('d-m-Y H:i', strtotime($d)) : '';
                    }
                ],
            ];

            $model1 = $this->kegiatanModel;
            $model2 = new MKegiatan();

            if ($page != null || AuthUser()->type == 5) {
                if ($page == "luar-kampus" || $page == "dalam-kampus") {
                    if ($page == "luar-kampus") {
                        if ($req->getVar("id") == null) {
                            $model1 = $model1->multiDataKegiatanDosen(1)->where('kegiatan_user_id', AuthUser()->id);
                            $model2 = $model2->multiDataKegiatanDosen(1)->where('kegiatan_user_id', AuthUser()->id);
                        } else {
                            $model1 = $model1->multiDataKegiatanDosen(1)->where('kegiatan_user_id', $req->getVar("id"));
                            $model2 = $model2->multiDataKegiatanDosen(1)->where('kegiatan_user_id', $req->getVar("id"));
                        }
                    } else if ($page == "dalam-kampus") {
                        if ($req->getVar("id") == null) {
                            $model1 = $model1->multiDataKegiatanDosen(2)->where('kegiatan_user_id', AuthUser()->id);
                            $model2 = $model2->multiDataKegiatanDosen(2)->where('kegiatan_user_id', AuthUser()->id);
                        } else {
                            $model1 = $model1->multiDataKegiatanDosen(2)->where('kegiatan_user_id', $req->getVar("id"));
                            $model2 = $model2->multiDataKegiatanDosen(2)->where('kegiatan_user_id', $req->getVar("id"));
                        }
                    }
                } else {
                    $result = jsonFormat(false, 'Kegiatan Dosen Harus Spesifik');
                    return $this->response->setJSON($result);
                }
            } else {
                if ($req->getVar("id") == null) {
                    $model1 = $model1->multiDataKegiatan()->where('kegiatan_user_id', AuthUser()->id);
                    $model2 = $model2->multiDataKegiatan()->where('kegiatan_user_id', AuthUser()->id);
                } else {
                    $model1 = $model1->multiDataKegiatan()->where('kegiatan_user_id', $req->getVar("id"));
                    $model2 = $model2->multiDataKegiatan()->where('kegiatan_user_id', $req->getVar("id"));
                }
            }
            $result = (new Datatable())->run($model1, $model2, $req->getVar('datatables'), $columns);
            return $this->response->setJSON($result);
        }
    }

    public function form($page = null)
    {
        if ($page != null || AuthUser()->type == 5) {
            if ($page == "luar-kampus" || $page == "dalam-kampus") {
                $tmp = [
                    'page'  => $page
                ];
            } else {
                $result = jsonFormat(false, 'Kegiatan Dosen Harus Spesifik');
                return $this->response->setJSON($result);
                // $tmp = [];
            }
        } else {
            $tmp = [];
        }

        $req = $this->request;
        if ($req->isAJAX()) {
            $id = $req->getVar('id') ?? null;
            if ($id != null) {
                $data = $this->kegiatanModel->find($id);
                if (empty($data['kegiatan_id'])) {
                    $result = jsonFormat(false, 'Kegiatan tidak ditemukan');
                    return $this->response->setJSON($result);
                } else if ($data['kegiatan_user_id'] != AuthUser()->id) {
                    $result = jsonFormat(false, 'Kegiatan tidak ditemukan');
                    return $this->response->setJSON($result);
                }
            }

            if ($id != null) {
                $tmp['data'] = $data;
                $tmp['media'] = $this->mediaModel->where('media_id', $data['kegiatan_media_id'])->findAll();
            }

            return view('dashboard/kegiatan/form', $tmp);
        }
    }

    public function detail($page = null)
    {
        if ($page != null || AuthUser()->type == 5) {
            if ($page == "luar-kampus" || $page == "dalam-kampus") {
                $tmp = [
                    'page'  => $page
                ];
            } else {
                $result = jsonFormat(false, 'Kegiatan Dosen Harus Spesifik');
                return $this->response->setJSON($result);
                // $tmp = [];
            }
        } else {
            $tmp = [];
        }
        $req = $this->request;
        if ($req->isAJAX()) {
            $id = $req->getVar('id') ?? null;
            if ($id != null) {
                $data = $this->kegiatanModel->lookDetailKegiatan($id);
                if (!empty($data['kegiatan_id'])) {
                    if ($data['kegiatan_user_id'] != AuthUser()->id && AuthUser()->type != 4) {
                        $result = jsonFormat(false, 'Kegiatan tidak ditemukan');
                        return $this->response->setJSON($result);
                    }
                } else {
                    $result = jsonFormat(false, 'Kegiatan tidak ditemukan');
                    return $this->response->setJSON($result);
                }
            } else {
                $result = jsonFormat(false, 'Kegiatan tidak ditemukan');
                return $this->response->setJSON($result);
            }

            if ($id != null) {
                $tmp['data'] = $data;
            }
            return view('dashboard/kegiatan/info', $tmp);
        }
    }

    public function save($page = null)
    {
        if ($page != null || AuthUser()->type == 5) {
            if (!($page == "luar-kampus" || $page == "dalam-kampus")) {
                $result = jsonFormat(false, 'Kegiatan Dosen Harus Spesifik');
                return $this->response->setJSON($result);
            }
        }
        $req = $this->request;
        if ($req->isAJAX()) {
            $id = $req->getVar('id') ?? null;
            if ($id != null) {
                $find = $this->kegiatanModel->find($id);
                if (empty($find['kegiatan_id'])) {
                    // Data tidak ditemukan, kirim respons error
                    $result = jsonFormat(false, 'Kegiatan tidak ditemukan');
                    return $this->response->setJSON($result);
                } else if ($find['kegiatan_user_id'] != AuthUser()->id) {
                    $result = jsonFormat(false, 'Kegiatan tidak ditemukan');
                    return $this->response->setJSON($result);
                }
            }
            $data = [
                'kegiatan_nama' => $req->getVar('nama'),
                'kegiatan_media_id' => $req->getVar('media'),
            ];
            // var_dump($data);die;
            $adminKegiatan = [1,2,3];
            if ($page != null || AuthUser()->type == 5) {
                if ($page == "luar-kampus") {
                    $data['kegiatan_dosen'] = 1;
                } else if ($page == "dalam-kampus") {
                    $data['kegiatan_dosen'] = 2;
                }
                $data['kegiatan_sebagai'] = $req->getVar('sebagai');
            }else if ($page == null && in_array(AuthUser()->type, $adminKegiatan)){
                $data['kegiatan_tahun'] = $req->getVar('tahun');
            }

            if ($req->getVar('media') === '') {
                $result = jsonFormat(false, 'Silahkan masukkan media');
                return $this->response->setJSON($result);
            }

            if ($id != null ? $this->kegiatanModel->update($id, $data) : $this->kegiatanModel->insert($data)) {
                $result = jsonFormat(true, 'Kegiatan berhasil disimpan');
            } else {
                $result = jsonFormat(false, $this->kegiatanModel->errors());
            }
            return $this->response->setJSON($result);
        }
    }

    public function delete($page = null)
    {
        if ($page != null || AuthUser()->type == 5) {
            if (!($page == "luar-kampus" || $page == "dalam-kampus")) {
                $result = jsonFormat(false, 'Kegiatan Dosen Harus Spesifik');
                return $this->response->setJSON($result);
            }
        }
        $req = $this->request;
        if ($req->isAJAX()) {
            $id = $req->getVar('id');

            if (empty($id)) {
                // ID kosong, kirim respons error
                $result = jsonFormat(false, 'Kegiatan tidak ditemukan');
                return $this->response->setJSON($result);
            }

            $find = $this->kegiatanModel->find($id);
            if (empty($find['kegiatan_id'])) {
                // Data tidak ditemukan, kirim respons error
                $result = jsonFormat(false, 'Kegiatan tidak ditemukan');
                return $this->response->setJSON($result);
            } else if ($find['kegiatan_user_id'] != AuthUser()->id) {
                $result = jsonFormat(false, 'Kegiatan tidak ditemukan');
                return $this->response->setJSON($result);
            }

            // menghapus media
            if (($find['kegiatan_user_id'] == AuthUser()->id)) {
                if ($this->kegiatanModel->delete($id)) {
                    $result = jsonFormat(true, 'Kegiatan berhasil dihapus');
                } else {
                    $result = jsonFormat(false, 'Kegiatan gagal dihapus');
                }
            } else {
                $result = jsonFormat(false, 'Anda tidak memiliki izin untuk menghapus data ini');
            }
            return $this->response->setJSON($result);
        }
    }
}
