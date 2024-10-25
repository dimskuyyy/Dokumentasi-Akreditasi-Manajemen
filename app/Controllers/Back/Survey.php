<?php

namespace App\Controllers\Back;

use App\Models\MSurvey;
use App\Models\MKuisioner;
use App\Libraries\Datatable;
use CodeIgniter\I18n\Time;

class Survey extends BaseController
{
    protected $surveyModel;
    protected $kuisionerModel;

    public function __construct()
    {
        $this->surveyModel = new MSurvey();
        $this->kuisionerModel = new MKuisioner();
    }

    public function index()
    {
        $find = $this->surveyModel->getData(AuthUser()->id);
        $tmp = [
            'data'  => $find ? $find : null
        ];
        return view('dashboard/survey/form', $tmp);
    }

    public function save()
    {
        $req = $this->request;
        if ($req->isAJAX()) {
            $id = $req->getVar('id') ?? null;
            $kuis_id = $req->getVar('kuis_id') ?? null;
            if ($id != null && $kuis_id != null) {
                $find = $this->surveyModel->find($id);
                $find_kuis = $this->kuisionerModel->find($kuis_id);
                if (empty($find['survey_id']) || empty($find_kuis['kuisioner_id'])) {
                    // Data tidak ditemukan, kirim respons error
                    $result = jsonFormat(false, 'Survey tidak ditemukan');
                    return $this->response->setJSON($result);
                } else if ($find['survey_user_id'] != AuthUser()->id) {
                    $result = jsonFormat(false, 'Survey tidak ditemukan');
                    return $this->response->setJSON($result);
                }
            }
            $data = [
                'nama_lengkap'              => $req->getVar('nama_lengkap'),
                'tahun_masuk'               => $req->getVar('tahun_masuk'),
                'nim'                       => $req->getVar('nim'),
                'nomor_hp'                  => $req->getVar('nomor_hp'),
                'alamat'                    => $req->getVar('alamat'),
                'alamat_sosmed'             => $req->getVar('alamat_sosmed'),
                'konsentrasi'               => $req->getVar('konsentrasi'),
                'ipk'                       => $req->getVar('ipk'),
                'lama_studi'                => $req->getVar('lama_studi'),
                'selesai_skripsi'           => $req->getVar('selesai_skripsi'),
                'nilai_toefl'               => $req->getVar('nilai_toefl'),
                'nilai_toefl_kerja'         => $req->getVar('nilai_toefl_kerja'),
                'tahun_selesai'             => $req->getVar('tahun_selesai'),
                'bulan_selesai'             => $req->getVar('bulan_selesai'),
                'mulai_cari_kerja'          => $req->getVar('mulai_cari_kerja'),
                'lama_dapat_kerja'          => $req->getVar('lama_dapat_kerja'),
                'tempat_kerja_pertama'      => $req->getVar('tempat_kerja_pertama'),
                'posisi_kerja_pertama'      => $req->getVar('posisi_kerja_pertama'),
                'tempat_kerja_sekarang'     => $req->getVar('tempat_kerja_sekarang'),
                'posisi_kerja_sekarang'     => $req->getVar('posisi_kerja_sekarang'),
                'jenis_perusahaan_sekarang' => $req->getVar('jenis_perusahaan_sekarang'),
                'bidang_usaha_sekarang'     => $req->getVar('bidang_usaha_sekarang'),
                'perusahaan_ke_berapa'      => $req->getVar('perusahaan_ke_berapa'),
                'skala_kerja'               => $req->getVar('skala_kerja'),
                'nomor_pimpinan'            => $req->getVar('nomor_pimpinan'),
                'kerja_sesuai_keahlian'     => $req->getVar('kerja_sesuai_keahlian'),
                'cara_dapat_kerja'          => $req->getVar('cara_dapat_kerja'),
                'kisaran_penghasilan'       => $req->getVar('kisaran_penghasilan'),
            ];

            $kuis = [
                'college_sarjana'                => $req->getVar('college_sarjana'),
                'college_peringkat'              => $req->getVar('college_peringkat'),
                'college_akreditasi_prodi'       => $req->getVar('college_akreditasi_prodi'),
                'college_pengalaman_kerja'       => $req->getVar('college_pengalaman_kerja'),
                'college_personality'            => $req->getVar('college_personality'),
                'college_manfaat'                => $req->getVar('college_manfaat'),
                'college_manfaat_kerja'          => $req->getVar('college_manfaat_kerja'),
                'college_manfaat_karir'          => $req->getVar('college_manfaat_karir'),
                'penilaian_bimbingan_pa'      => $req->getVar('penilaian_bimbingan_pa'),
                'penilaian_konten_matkul'     => $req->getVar('penilaian_konten_matkul'),
                'penilaian_variasi_matkul'    => $req->getVar('penilaian_variasi_matkul'),
                'penilaian_dari_dosen'        => $req->getVar('penilaian_dari_dosen'),
                'penilaian_rancangan_kurikulum'=> $req->getVar('penilaian_rancangan_kurikulum'),
                'penilaian_milih_matkul'      => $req->getVar('penilaian_milih_matkul'),
                'penilaian_kualitas_dosen'    => $req->getVar('penilaian_kualitas_dosen'),
                'penilaian_metode_ajar'       => $req->getVar('penilaian_metode_ajar'),
                'penilaian_ikut_penelitian'   => $req->getVar('penilaian_ikut_penelitian'),
                'penilaian_komunikasi_dosen'  => $req->getVar('penilaian_komunikasi_dosen'),
                'penilaian_kerja_praktik'     => $req->getVar('penilaian_kerja_praktik'),
                'penilaian_studi_banding'     => $req->getVar('penilaian_studi_banding'),
                'penilaian_lab_komputer'      => $req->getVar('penilaian_lab_komputer'),
                'penilaian_internet'          => $req->getVar('penilaian_internet'),
                'penilaian_pustaka'           => $req->getVar('penilaian_pustaka'),
                'penilaian_administrasi'      => $req->getVar('penilaian_administrasi'),
                'keahlian_identifikasi'       => $req->getVar('keahlian_identifikasi'),
                'keahlian_aplikasi_manajerial'=> $req->getVar('keahlian_aplikasi_manajerial'),
                'keahlian_leadership'         => $req->getVar('keahlian_leadership'),
                'keahlian_berpendapat'        => $req->getVar('keahlian_berpendapat'),
                'keahlian_inggris'            => $req->getVar('keahlian_inggris'),
                'keahlian_memimpin'           => $req->getVar('keahlian_memimpin'),
                'keahlian_etika_profesi'      => $req->getVar('keahlian_etika_profesi'),
                'kritik_saran'                => $req->getVar('kritik_saran')
            ]; 

            if($req->getVar('jenis_perusahaan_sekarang') == 'Other'){
                $jenisUsaha = $req->getVar('jenis_perusahaan_other');
                if(empty($jenisUsaha)){
                    $result = jsonFormat(false, 'Jenis Perusahaan "Other", harap memberi inputan');
                    return $this->response->setJSON($result);
                }else{
                    $data['jenis_perusahaan_other'] = $jenisUsaha;
                }
            }

            if($req->getVar('bidang_usaha_sekarang') == 'Other'){
                $bidangUsaha = $req->getVar('bidang_usaha_other');
                if(empty($bidangUsaha)){
                    $result = jsonFormat(false, 'Bidang Usaha "Other", harap memberi inputan');
                    return $this->response->setJSON($result);
                }else{
                    $data['bidang_usaha_other'] = $bidangUsaha;
                }
            }

            if($req->getVar('cara_dapat_kerja') == 'Other'){
                $dapatKerja = $req->getVar('other_dapat_kerja');
                if(empty($dapatKerja)){
                    $result = jsonFormat(false, 'Cara Mendapat Pekerjaan "Other", harap memberi inputan');
                    return $this->response->setJSON($result);
                }else{
                    $data['other_dapat_kerja'] = $dapatKerja;
                }
            }
            // var_dump($data);die;

            if ($id != null ? $this->surveyModel->update($id, $data) : $this->surveyModel->insert($data)) {
                if($kuis_id != null ? $this->kuisionerModel->update($kuis_id, $kuis) : $this->kuisionerModel->insert($kuis)){
                    $result = jsonFormat(true, 'Survey berhasil disimpan');
                }else{
                    $result = jsonFormat(false, $this->surveyModel->errors());
                }
            } else {
                $result = jsonFormat(false, $this->surveyModel->errors());
            }
            return $this->response->setJSON($result);
        }
    }
}
