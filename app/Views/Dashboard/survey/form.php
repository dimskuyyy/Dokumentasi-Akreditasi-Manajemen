<?= $this->extend('dashboard/layout/back_main') ?>
<?= $this->section('title') ?>
Survey <?= AuthUser()->type_nama ?>
<?= $this->endsection() ?>

<?= $this->section('css') ?>
<style>
    .option-check label {
        color: #636363;
    }

    .option-check label:first-child {
        color: black;
    }

    input[type="radio"] {
        -ms-transform: scale(1.2);
        /* IE 9 */
        -webkit-transform: scale(1.2);
        /* Chrome, Safari, Opera */
        transform: scale(1.2);
    }

    .labeling-radio,
    .kuisioner-quest {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        padding: 10px;
    }

    .kuisioner-quest {
        background-color: #F8F9FA;
        border-radius: 4px;
        margin-bottom: 16px;
    }

    .labeling-radio p {
        display: inline-block;
        width: 16%;
        text-align: center;
    }

    .kuisioner-quest label {
        width: 20%;
        display: inline-block;
        text-align: left;
    }

    .kuisioner-quest input {
        width: 16%;
    }
</style>
<?= $this->endsection() ?>

<?= $this->section('header') ?>
<section class="content-header">
    <h1>
        Survey <?= AuthUser()->type_nama ?>
    </h1>
</section>
<?= $this->endsection() ?>

<?= $this->section('content') ?>
<?php
helper(['form']);
?>
<?php echo form_open('#', ['class' => 'survey-form']); ?>
<?php
if (isset($data)) {
    echo form_hidden('id', $data['survey_id']);
    echo form_hidden('kuis_id', $data['kuisioner_id']);
}
?>
<div class="box box-info">
    <div class="box-body">
        <div class="tab-content" style="margin-top: 2rem;">
            <div role="tabpanel" class="tab-pane active" id="judul">
                <div class="row">
                    <div class="col-md-6" style="padding-right: 2rem; padding-left: 2rem;">
                        <h4 style="font-weight: bold;margin-bottom:2rem">KUISIONER "TRACER STUDY" PROGRAM STUDI ILMU EKONOMI UNIVERSITAS RIAU</h4>
                        <div class="form-group" style="margin-bottom: 2rem;">
                            <label for='nama_lengkap'>Nama Lengkap <span style="color:red">*</span></label><br>
                            <input type="text" name="nama_lengkap" class="form-control" value="<?= isset($data) ? $data['nama_lengkap'] : '' ?>" required placeholder="Your Answer">
                        </div>
                        <div class="form-group option-check">
                            <label>Tahun Masuk Kuliah <span style="color:red">*</span></label><br>
                            <label>
                                <input type="radio" name="tahun_masuk" class="flat-red" value="2017" <?= isset($data) ? ($data['tahun_masuk'] == "2017" ? 'checked' : '') : '' ?> required>
                                2017
                            </label><br>
                            <label>
                                <input type="radio" name="tahun_masuk" class="flat-red" value="2018" <?= isset($data) ? ($data['tahun_masuk'] == "2018" ? 'checked' : '') : '' ?> required>
                                2018
                            </label><br>
                            <label>
                                <input type="radio" name="tahun_masuk" class="flat-red" value="2019" <?= isset($data) ? ($data['tahun_masuk'] == "2019" ? 'checked' : '') : '' ?> required>
                                2019
                            </label>
                        </div>
                        <div class="form-group" style="margin-bottom: 2rem;">
                            <label for='nim'>NIM (Jika tidak ingat ketikkan " - ") <span style="color:red">*</span></label><br>
                            <input type="text" name="nim" class="form-control" value="<?= isset($data) ? $data['nim'] : '' ?>" required placeholder="Your Answer">
                        </div>
                        <div class="form-group" style="margin-bottom: 2rem;">
                            <label for='nomor_hp'>No. HP/WA yang bisa dihubungi <span style="color:red">*</span></label><br>
                            <input type="text" name="nomor_hp" class="form-control" value="<?= isset($data) ? $data['nomor_hp'] : '' ?>" required placeholder="Your Answer">
                        </div>
                        <div class="form-group" style="margin-bottom: 2rem;">
                            <label for='alamat'>Alamat Sekarang <span style="color:red">*</span></label><br>
                            <input type="text" name="alamat" class="form-control" value="<?= isset($data) ? $data['alamat'] : '' ?>" required placeholder="Your Answer">
                        </div>
                        <div class="form-group" style="margin-bottom: 2rem;">
                            <label for='alamat_sosmed'> Alamat E-mail/IG/FB/Twitter <span style="color:red">*</span></label><br>
                            <input type="text" name="alamat_sosmed" class="form-control" value="<?= isset($data) ? $data['alamat_sosmed'] : '' ?>" required placeholder="Your Answer">
                        </div>
                        <div class="form-group option-check" style="margin-bottom: 2rem;">
                            <label>Konsentrasi pada saat perkuliahan? <span style="color:red">*</span></label><br>
                            <label>
                                <input type="radio" name="konsentrasi" class="flat-red" value="Ekonomi Sumber Daya Manusia" <?= isset($data) ? ($data['konsentrasi'] == "Ekonomi Sumber Daya Manusia" ? 'checked' : '') : '' ?> required>
                                Ekonomi Sumber Daya Manusia
                            </label><br>
                            <label>
                                <input type="radio" name="konsentrasi" class="flat-red" value="Ekonomi Keuangan Daerah" <?= isset($data) ? ($data['konsentrasi'] == "Ekonomi Keuangan Daerah" ? 'checked' : '') : '' ?> required>
                                Ekonomi Keuangan Daerah
                            </label><br>
                            <label>
                                <input type="radio" name="konsentrasi" class="flat-red" value="Ekonomi Pedesaan" <?= isset($data) ? ($data['konsentrasi'] == "Ekonomi Pedesaan" ? 'checked' : '') : '' ?> required>
                                Ekonomi Pedesaan
                            </label><br>
                        </div>
                        <div class="form-group" style="margin-bottom: 2rem;">
                            <label for='ipk'>IPK <span style="color:red">*</span></label><br>
                            <input type="text" name="ipk" class="form-control" value="<?= isset($data) ? $data['ipk'] : '' ?>" required placeholder="Your Answer">
                        </div>
                        <div class="form-group" style="margin-bottom: 2rem;">
                            <label for='lama_studi'>Lama menyelesaikan Studi S1 (dalam bulan) <i>Contoh: 49 Bulan</i> <span style="color:red">*</span></label><br>
                            <input type="text" name="lama_studi" class="form-control" value="<?= isset($data) ? $data['lama_studi'] : '' ?>" required placeholder="Your Answer">
                        </div>
                        <div class="form-group" style="margin-bottom: 2rem;">
                            <label for='selesai_skripsi'>Masa Penyelesaian Skripsi (dalam bulan) <i>Contoh: 6 Bulan</i> <span style="color:red">*</span></label><br>
                            <input type="text" name="selesai_skripsi" class="form-control" value="<?= isset($data) ? $data['selesai_skripsi'] : '' ?>" required placeholder="Your Answer">
                        </div>
                        <div class="form-group" style="margin-bottom: 2rem;">
                            <label for='nilai_toefl'>Nilai TOEFL selama kuliah <span style="color:red">*</span></label><br>
                            <input type="text" name="nilai_toefl" class="form-control" value="<?= isset($data) ? $data['nilai_toefl'] : '' ?>" required placeholder="Your Answer">
                        </div>
                        <div class="form-group" style="margin-bottom: 2rem;">
                            <label for='nilai_toefl_kerja'>Nilai TOEFL setelah bekerja (Ketik - jika tidak ada) <span style="color:red">*</span></label><br>
                            <input type="text" name="nilai_toefl_kerja" class="form-control" value="<?= isset($data) ? $data['nilai_toefl_kerja'] : '' ?>" required placeholder="Your Answer">
                        </div>
                        <div class="form-group option-check">
                            <label>Kapan anda menyelesaikan studi S1 di Prodi Ilmu Ekonomi? (Tahun) <span style="color:red">*</span></label><br>
                            <label>
                                <input type="radio" name="tahun_selesai" class="flat-red" value="2020" <?= isset($data) ? ($data['tahun_selesai'] == "2020" ? 'checked' : '') : '' ?> required>
                                2020
                            </label><br>
                            <label>
                                <input type="radio" name="tahun_selesai" class="flat-red" value="2021" <?= isset($data) ? ($data['tahun_selesai'] == "2021" ? 'checked' : '') : '' ?> required>
                                2021
                            </label><br>
                            <label>
                                <input type="radio" name="tahun_selesai" class="flat-red" value="2022" <?= isset($data) ? ($data['tahun_selesai'] == "2022" ? 'checked' : '') : '' ?> required>
                                2022
                            </label><br>
                            <label>
                                <input type="radio" name="tahun_selesai" class="flat-red" value="2023" <?= isset($data) ? ($data['tahun_selesai'] == "2023" ? 'checked' : '') : '' ?> required>
                                2023
                            </label>
                        </div>
                        <div class="form-group option-check">
                            <label>Kapan anda menyelesaikan studi S1 di Prodi Ilmu Ekonomi? (Bulan) <span style="color:red">*</span></label><br>
                            <label>
                                <input type="radio" name="bulan_selesai" class="flat-red" value="Januari" <?= isset($data) && $data['bulan_selesai'] == "Januari" ? 'checked' : '' ?>>
                                Januari
                            </label><br>
                            <label>
                                <input type="radio" name="bulan_selesai" class="flat-red" value="Februari" <?= isset($data) && $data['bulan_selesai'] == "Februari" ? 'checked' : '' ?>>
                                Februari
                            </label><br>
                            <label>
                                <input type="radio" name="bulan_selesai" class="flat-red" value="Maret" <?= isset($data) && $data['bulan_selesai'] == "Maret" ? 'checked' : '' ?>>
                                Maret
                            </label><br>
                            <label>
                                <input type="radio" name="bulan_selesai" class="flat-red" value="April" <?= isset($data) && $data['bulan_selesai'] == "April" ? 'checked' : '' ?>>
                                April
                            </label><br>
                            <label>
                                <input type="radio" name="bulan_selesai" class="flat-red" value="Mei" <?= isset($data) && $data['bulan_selesai'] == "Mei" ? 'checked' : '' ?>>
                                Mei
                            </label><br>
                            <label>
                                <input type="radio" name="bulan_selesai" class="flat-red" value="Juni" <?= isset($data) && $data['bulan_selesai'] == "Juni" ? 'checked' : '' ?>>
                                Juni
                            </label><br>
                            <label>
                                <input type="radio" name="bulan_selesai" class="flat-red" value="Juli" <?= isset($data) && $data['bulan_selesai'] == "Juli" ? 'checked' : '' ?>>
                                Juli
                            </label><br>
                            <label>
                                <input type="radio" name="bulan_selesai" class="flat-red" value="Agustus" <?= isset($data) && $data['bulan_selesai'] == "Agustus" ? 'checked' : '' ?>>
                                Agustus
                            </label><br>
                            <label>
                                <input type="radio" name="bulan_selesai" class="flat-red" value="September" <?= isset($data) && $data['bulan_selesai'] == "September" ? 'checked' : '' ?>>
                                September
                            </label><br>
                            <label>
                                <input type="radio" name="bulan_selesai" class="flat-red" value="Oktober" <?= isset($data) && $data['bulan_selesai'] == "Oktober" ? 'checked' : '' ?>>
                                Oktober
                            </label><br>
                            <label>
                                <input type="radio" name="bulan_selesai" class="flat-red" value="November" <?= isset($data) && $data['bulan_selesai'] == "November" ? 'checked' : '' ?>>
                                November
                            </label><br>
                            <label>
                                <input type="radio" name="bulan_selesai" class="flat-red" value="Desember" <?= isset($data) && $data['bulan_selesai'] == "Desember" ? 'checked' : '' ?>>
                                Desember
                            </label><br>
                        </div>
                        <div class="form-group" style="margin-bottom: 2rem;">
                            <label for='mulai_cari_kerja'>Setelah tamat, kapan anda mulai mencari pekerjaan? (bulan dan tahun) <i>Contoh: Februari, 2023</i> <span style="color:red">*</span></label><br>
                            <input type="text" name="mulai_cari_kerja" class="form-control" value="<?= isset($data) ? $data['mulai_cari_kerja'] : '' ?>" required placeholder="Your Answer">
                        </div>
                        <div class="form-group option-check">
                            <label>Lama mendapatkan pekerjaan setelah lulus? (dalam bulan) <span style="color:red">*</span></label><br>
                            <label>
                                <input type="radio" name="lama_dapat_kerja" class="flat-red" value="<3 Bulan" <?= isset($data) && $data['lama_dapat_kerja'] == "<3 Bulan" ? 'checked' : '' ?> required>
                                Kurang dari 3 bulan
                            </label><br>

                            <label>
                                <input type="radio" name="lama_dapat_kerja" class="flat-red" value="<6 Bulan" <?= isset($data) && $data['lama_dapat_kerja'] == "<6 Bulan" ? 'checked' : '' ?>>
                                Kurang dari 6 bulan
                            </label><br>

                            <label>
                                <input type="radio" name="lama_dapat_kerja" class="flat-red" value="6-12 Bulan" <?= isset($data) && $data['lama_dapat_kerja'] == "6-12 Bulan" ? 'checked' : '' ?>>
                                6 - 12 bulan
                            </label><br>

                            <label>
                                <input type="radio" name="lama_dapat_kerja" class="flat-red" value="13-19 Bulan" <?= isset($data) && $data['lama_dapat_kerja'] == "13-19 Bulan" ? 'checked' : '' ?>>
                                13 - 19 bulan
                            </label><br>

                            <label>
                                <input type="radio" name="lama_dapat_kerja" class="flat-red" value="19-24 Bulan" <?= isset($data) && $data['lama_dapat_kerja'] == "19-24 Bulan" ? 'checked' : '' ?>>
                                19 - 24 bulan
                            </label><br>

                            <label>
                                <input type="radio" name="lama_dapat_kerja" class="flat-red" value="25-30 Bulan" <?= isset($data) && $data['lama_dapat_kerja'] == "25-30 Bulan" ? 'checked' : '' ?>>
                                25 - 30 bulan
                            </label><br>

                            <label>
                                <input type="radio" name="lama_dapat_kerja" class="flat-red" value="31-36 Bulan" <?= isset($data) && $data['lama_dapat_kerja'] == "31-36 Bulan" ? 'checked' : '' ?>>
                                31 - 36 bulan
                            </label><br>

                            <label>
                                <input type="radio" name="lama_dapat_kerja" class="flat-red" value=">3 Tahun" <?= isset($data) && $data['lama_dapat_kerja'] == ">3 Tahun" ? 'checked' : '' ?>>
                                Lebih dari 3 tahun
                            </label><br>
                        </div>
                        <div class="form-group" style="margin-bottom: 2rem;">
                            <label for='tempat_kerja_pertama'>Nama perusahaan tempat anda bekerja pertama kali setelah lulus (Jika berwirausaha, sebutkan nama usaha) <span style="color:red">*</span></label><br>
                            <input type="text" name="tempat_kerja_pertama" class="form-control" value="<?= isset($data) ? $data['tempat_kerja_pertama'] : '' ?>" required placeholder="Your Answer">
                        </div>
                        <div class="form-group" style="margin-bottom: 2rem;">
                            <label for='posisi_kerja_pertama'>Apa posisi/ jabatan tempat anda bekerja pertama kali setelah lulus ? (Jika berwirausaha, sebutkan nama usaha dan jabatan) <span style="color:red">*</span></label><br>
                            <input type="text" name="posisi_kerja_pertama" class="form-control" value="<?= isset($data) ? $data['posisi_kerja_pertama'] : '' ?>" required placeholder="Your Answer">
                        </div>
                        <div class="form-group option-check" style="margin-bottom: 2rem;">
                            <label for='tempat_kerja_sekarang'>Nama perusahaan tempat anda bekerja saat ini. (Jika berwirausaha, sebutkan nama usaha) <span style="color:red">*</span></label><br>
                            <input type="text" name="tempat_kerja_sekarang" class="form-control" value="<?= isset($data) ? $data['tempat_kerja_sekarang'] : '' ?>" required placeholder="Your Answer">
                        </div>
                        <div class="form-group " style="margin-bottom: 2rem;">
                            <label for='posisi_kerja_sekarang'>Apa posisi/ jabatan tempat anda bekerja sekarang? (Jika berwirausaha, sebutkan nama usaha dan jabatan) <span style="color:red">*</span></label><br>
                            <input type="text" name="posisi_kerja_sekarang" class="form-control" value="<?= isset($data) ? $data['posisi_kerja_sekarang'] : '' ?>" required placeholder="Your Answer">
                        </div>
                        <div class="form-group option-check">
                            <label>Jenis perusahaan tempat anda bekerja saat ini? <span style="color:red">*</span></label><br>
                            <label>
                                <input type="radio" name="jenis_perusahaan_sekarang" class="flat-red" value="Perusahaan Swasta" <?= isset($data) && $data['jenis_perusahaan_sekarang'] == "Perusahaan Swasta" ? 'checked' : '' ?> required onclick="toggleOtherInput(this, 'jenis')">
                                Perusahaan Swasta
                            </label><br>
                            <label>
                                <input type="radio" name="jenis_perusahaan_sekarang" class="flat-red" value="BUMN" <?= isset($data) && $data['jenis_perusahaan_sekarang'] == "BUMN" ? 'checked' : '' ?> onclick="toggleOtherInput(this, 'jenis')">
                                BUMN
                            </label><br>
                            <label>
                                <input type="radio" name="jenis_perusahaan_sekarang" class="flat-red" value="Bank Swasta" <?= isset($data) && $data['jenis_perusahaan_sekarang'] == "Bank Swasta" ? 'checked' : '' ?> onclick="toggleOtherInput(this, 'jenis')">
                                Bank Swasta
                            </label><br>
                            <label>
                                <input type="radio" name="jenis_perusahaan_sekarang" class="flat-red" value="Instansi Pemerintah" <?= isset($data) && $data['jenis_perusahaan_sekarang'] == "Instansi Pemerintah" ? 'checked' : '' ?> onclick="toggleOtherInput(this, 'jenis')">
                                Instansi Pemerintah
                            </label><br>
                            <label>
                                <input type="radio" name="jenis_perusahaan_sekarang" class="flat-red" value="Wiraswasta" <?= isset($data) && $data['jenis_perusahaan_sekarang'] == "Wiraswasta" ? 'checked' : '' ?> onclick="toggleOtherInput(this, 'jenis')">
                                Wiraswasta
                            </label><br>
                            <label>
                                <input type="radio" name="jenis_perusahaan_sekarang" class="flat-red" value="Perusahaan Asing" <?= isset($data) && $data['jenis_perusahaan_sekarang'] == "Perusahaan Asing" ? 'checked' : '' ?> onclick="toggleOtherInput(this, 'jenis')">
                                Perusahaan Asing
                            </label><br>
                            <label>
                                <input type="radio" name="jenis_perusahaan_sekarang" class="flat-red" value="Berwirausaha/Menjalankan Usaha" <?= isset($data) && $data['jenis_perusahaan_sekarang'] == "Berwirausaha/ Menjalankan Usaha" ? 'checked' : '' ?> onclick="toggleOtherInput(this, 'jenis')">
                                Berwirausaha/ Menjalankan Usaha
                            </label><br>
                            <label>
                                <input type="radio" name="jenis_perusahaan_sekarang" class="flat-red" value="Other" <?= isset($data) && $data['jenis_perusahaan_sekarang'] == "Other" ? 'checked' : '' ?> onclick="toggleOtherInput(this, 'jenis')">
                                Other:

                            </label>
                            <input type="text" name="jenis_perusahaan_other" class="form-control" id="other-input-jenis" value="<?= isset($data['jenis_perusahaan_other']) ? $data['jenis_perusahaan_other'] : '' ?>" style="width:80%;display:inline-block" <?= isset($data) && $data['jenis_perusahaan_sekarang'] == 'Other' ? '' : 'disabled' ?>>
                        </div>
                        <div class="form-group option-check">
                            <label>Bidang usaha tempat anda bekerja saat ini? (Jika berwirausaha, sebutkan bidang usaha) <span style="color:red">*</span></label><br>
                            <label>
                                <input type="radio" name="bidang_usaha_sekarang" class="flat-red" value="Perbankan" <?= isset($data) && $data['bidang_usaha_sekarang'] == "Perbankan" ? 'checked' : '' ?> required onclick="toggleOtherInput(this, 'bidang')">
                                Perbankan
                            </label><br>
                            <label>
                                <input type="radio" name="bidang_usaha_sekarang" class="flat-red" value="Asuransi" <?= isset($data) && $data['bidang_usaha_sekarang'] == "Asuransi" ? 'checked' : '' ?> onclick="toggleOtherInput(this, 'bidang')">
                                Asuransi
                            </label><br>
                            <label>
                                <input type="radio" name="bidang_usaha_sekarang" class="flat-red" value="Lembaga Keuangan/Pembiayaan lainnya" <?= isset($data) && $data['bidang_usaha_sekarang'] == "Lembaga Keuangan/Pembiayaan lainnya" ? 'checked' : '' ?> onclick="toggleOtherInput(this, 'bidang')">
                                Lembaga Keuangan/Pembiayaan lainnya
                            </label><br>
                            <label>
                                <input type="radio" name="bidang_usaha_sekarang" class="flat-red" value="Pemerintahan" <?= isset($data) && $data['bidang_usaha_sekarang'] == "Pemerintahan" ? 'checked' : '' ?> onclick="toggleOtherInput(this, 'bidang')">
                                Pemerintahan
                            </label><br>
                            <label>
                                <input type="radio" name="bidang_usaha_sekarang" class="flat-red" value="Manufaktur" <?= isset($data) && $data['bidang_usaha_sekarang'] == "Manufaktur" ? 'checked' : '' ?> onclick="toggleOtherInput(this, 'bidang')">
                                Manufaktur
                            </label><br>
                            <label>
                                <input type="radio" name="bidang_usaha_sekarang" class="flat-red" value="Transportasi" <?= isset($data) && $data['bidang_usaha_sekarang'] == "Transportasi" ? 'checked' : '' ?> onclick="toggleOtherInput(this, 'bidang')">
                                Transportasi
                            </label><br>
                            <label>
                                <input type="radio" name="bidang_usaha_sekarang" class="flat-red" value="Telekomunikasi" <?= isset($data) && $data['bidang_usaha_sekarang'] == "Telekomunikasi" ? 'checked' : '' ?> onclick="toggleOtherInput(this, 'bidang')">
                                Telekomunikasi
                            </label><br>
                            <label>
                                <input type="radio" name="bidang_usaha_sekarang" class="flat-red" value="Pendidikan" <?= isset($data) && $data['bidang_usaha_sekarang'] == "Pendidikan" ? 'checked' : '' ?> onclick="toggleOtherInput(this, 'bidang')">
                                Pendidikan
                            </label><br>
                            <label>
                                <input type="radio" name="bidang_usaha_sekarang" class="flat-red" value="Pertambangan" <?= isset($data) && $data['bidang_usaha_sekarang'] == "Pertambangan" ? 'checked' : '' ?> onclick="toggleOtherInput(this, 'bidang')">
                                Pertambangan
                            </label><br>
                            <label>
                                <input type="radio" name="bidang_usaha_sekarang" class="flat-red" value="Other" <?= isset($data) && $data['bidang_usaha_sekarang'] == "Other" ? 'checked' : '' ?> onclick="toggleOtherInput(this, 'bidang')">
                                Other:

                            </label>
                            <input type="text" name="bidang_usaha_other" class="form-control" id="other-input-bidang" value="<?= isset($data['bidang_usaha_other']) ? $data['bidang_usaha_other'] : '' ?>" style="width:80%;display:inline-block" <?= isset($data) && $data['bidang_usaha_sekarang'] == 'Other' ? '' : 'disabled' ?>>
                        </div>
                        <div class="form-group " style="margin-bottom: 2rem;">
                            <label for='perusahaan_ke_berapa'>Perusahaan tempat anda bekerja saat ini merupakan perusahaan ke berapa semenjak anda mulai bekerja setelah lulus S-1 ? (Jika berwirausaha, sebutkan usaha ke berapa) <i>(contoh: Pertama)</i> <span style="color:red">*</span></label><br>
                            <input type="text" name="perusahaan_ke_berapa" class="form-control" value="<?= isset($data) ? $data['perusahaan_ke_berapa'] : '' ?>" required placeholder="Your Answer">
                        </div>
                        <div class="form-group option-check">
                            <label>Skala Tempat Bekerja "Lokal/Nasional/Internasional (Jika berwirausaha, pilih berizin/ tidak berizin) <span style="color:red">*</span></label><br>
                            <label>
                                <input type="radio" name="skala_kerja" class="flat-red" value="Lokal" <?= isset($data) ? ($data['skala_kerja'] == "Lokal" ? 'checked' : '') : '' ?> required>
                                Lokal
                            </label><br>
                            <label>
                                <input type="radio" name="skala_kerja" class="flat-red" value="Nasional" <?= isset($data) ? ($data['skala_kerja'] == "Nasional" ? 'checked' : '') : '' ?> required>
                                Nasional
                            </label><br>
                            <label>
                                <input type="radio" name="skala_kerja" class="flat-red" value="Internasional" <?= isset($data) ? ($data['skala_kerja'] == "Internasional" ? 'checked' : '') : '' ?> required>
                                Internasional
                            </label><br>
                            <label>
                                <input type="radio" name="skala_kerja" class="flat-red" value="Berizin" <?= isset($data) ? ($data['skala_kerja'] == "Berizin" ? 'checked' : '') : '' ?> required>
                                Berizin
                            </label><br>
                            <label>
                                <input type="radio" name="skala_kerja" class="flat-red" value="Tidak Berizin" <?= isset($data) ? ($data['skala_kerja'] == "Tidak Berizin" ? 'checked' : '') : '' ?> required>
                                Tidak Berizin
                            </label>
                        </div>
                        <div class="form-group " style="margin-bottom: 2rem;">
                            <label for='nomor_pimpinan'>No. Hp Pimpinan (Boleh Pimpinan Tertinggi, Menengah, atau Supervisor) (Jika berwirausaha, sebutkan No. Hp penanggung jawab) <span style="color:red">*</span></label><br>
                            <input type="text" name="nomor_pimpinan" class="form-control" value="<?= isset($data) ? $data['nomor_pimpinan'] : '' ?>" required placeholder="Your Answer">
                        </div>
                        <div class="form-group option-check">
                            <label>Tempat Anda Bekerja saat ini sesuai dengan bidang keahlian? (Jika berwirausaha, apakah sesuai dengan bidang keahlian) <span style="color:red">*</span></label><br>
                            <label>
                                <input type="radio" name="kerja_sesuai_keahlian" class="flat-red" value="Sesuai" <?= isset($data) ? ($data['kerja_sesuai_keahlian'] == "Sesuai" ? 'checked' : '') : '' ?> required>
                                Sesuai
                            </label><br>
                            <label>
                                <input type="radio" name="kerja_sesuai_keahlian" class="flat-red" value="Tidak Sesuai" <?= isset($data) ? ($data['kerja_sesuai_keahlian'] == "Tidak Sesuai" ? 'checked' : '') : '' ?> required>
                                Tidak Sesuai
                            </label><br>
                        </div>
                        <div class="form-group option-check">
                            <label>Bagaimana caranya anda mendapatkan pekerjaan saat ini ? (Jika berwirausaha, pilih berwirausaha) <span style="color:red">*</span></label><br>
                            <label>
                                <input type="radio" name="cara_dapat_kerja" class="flat-red" value="Iklan" <?= isset($data) && $data['cara_dapat_kerja'] == "Iklan" ? 'checked' : '' ?> required onclick="toggleOtherInput(this, 'cara')">
                                Melalui iklan (majalah/ koran/ televisi/ media sosial/ dll)
                            </label><br>
                            <label>
                                <input type="radio" name="cara_dapat_kerja" class="flat-red" value="Melamar Langsung" <?= isset($data) && $data['cara_dapat_kerja'] == "Melamar Langsung" ? 'checked' : '' ?> onclick="toggleOtherInput(this, 'cara')">
                                Melamar Langsung
                            </label><br>
                            <label>
                                <input type="radio" name="cara_dapat_kerja" class="flat-red" value="Internet/Email" <?= isset($data) && $data['cara_dapat_kerja'] == "Internet/Email" ? 'checked' : '' ?> onclick="toggleOtherInput(this, 'cara')">
                                Melaui internet/ e-mail
                            </label><br>
                            <label>
                                <input type="radio" name="cara_dapat_kerja" class="flat-red" value="Job Fair" <?= isset($data) && $data['cara_dapat_kerja'] == "Job Fair" ? 'checked' : '' ?> onclick="toggleOtherInput(this, 'cara')">
                                Job Fair/ Bursa pencari kerja
                            </label><br>
                            <label>
                                <input type="radio" name="cara_dapat_kerja" class="flat-red" value="Orang Tua" <?= isset($data) && $data['cara_dapat_kerja'] == "Orang Tua" ? 'checked' : '' ?> onclick="toggleOtherInput(this, 'cara')">
                                Orang tua/ Kerabat/ Saudara
                            </label><br>
                            <label>
                                <input type="radio" name="cara_dapat_kerja" class="flat-red" value="Wirausaha" <?= isset($data) && $data['cara_dapat_kerja'] == "Wirausaha" ? 'checked' : '' ?> onclick="toggleOtherInput(this, 'cara')">
                                Wirausaha
                            </label><br>
                            <label>
                                <input type="radio" name="cara_dapat_kerja" class="flat-red" value="Other" <?= isset($data) && $data['cara_dapat_kerja'] == "Other" ? 'checked' : '' ?> onclick="toggleOtherInput(this, 'cara')">
                                Other:

                            </label>
                            <input type="text" name="other_dapat_kerja" class="form-control" id="other-input-cara" value="<?= isset($data['other_dapat_kerja']) ? $data['other_dapat_kerja'] : '' ?>" style="width:80%;display:inline-block" <?= isset($data) && $data['cara_dapat_kerja'] == 'Other' ? '' : 'disabled' ?>>
                        </div>
                        <div class="form-group option-check">
                            <label>Berapa kisaran penghasilan anda di tempat anda bekerja saat ini ? (Jika berwirausaha, sebutkan) <span style="color:red">*</span></label><br>
                            <label>
                                <input type="radio" name="kisaran_penghasilan" class="flat-red" value="<2500000" <?= isset($data) ? ($data['kisaran_penghasilan'] == "<2500000" ? 'checked' : '') : '' ?> required>
                                Kurang dari Rp. 2.500.000
                            </label><br>
                            <label>
                                <input type="radio" name="kisaran_penghasilan" class="flat-red" value="2500000-5000000" <?= isset($data) ? ($data['kisaran_penghasilan'] == "2500000-5000000" ? 'checked' : '') : '' ?> required>
                                Rp. 2.500.000 - Rp. 5.000.000
                            </label><br>
                            <label>
                                <input type="radio" name="kisaran_penghasilan" class="flat-red" value="5000000-7500000" <?= isset($data) ? ($data['kisaran_penghasilan'] == "5000000-7500000" ? 'checked' : '') : '' ?> required>
                                Rp. 5.000.000 - Rp. 7.500.000
                            </label><br>
                            <label>
                                <input type="radio" name="kisaran_penghasilan" class="flat-red" value="7500000-10000000" <?= isset($data) ? ($data['kisaran_penghasilan'] == "7500000-10000000" ? 'checked' : '') : '' ?> required>
                                Rp. 7.500.000 - Rp. 10.000.000
                            </label><br>
                            <label>
                                <input type="radio" name="kisaran_penghasilan" class="flat-red" value=">10000000" <?= isset($data) ? ($data['kisaran_penghasilan'] == ">10000000" ? 'checked' : '') : '' ?> required>
                                Lebih dari Rp. 10.000.000
                            </label>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="box box-info" style="margin-top: 2rem;">
    <div class="box-body">
        <div class="tab-content">
            <div class="row">
                <div class="col-md-6" style="padding-right: 2rem; padding-left: 2rem;">
                    <div style="width: 100%;">
                        <h4 style="font-weight: bold;margin-bottom:2rem">KUISIONER "TRACER STUDY" ALUMNI PRODI ILMU EKONOMI UNIVERSITAS RIAU</h4>
                        <div class="labeling-radio">
                            <p>Sangat Tidak Penting</p>
                            <p>Tidak Penting</p>
                            <p>Cukup</p>
                            <p>Penting</p>
                            <p>Sangat Penting</p>
                        </div>
                        <div class="kuisioner-quest">
                            <label>Seberapa penting spesialisasi/ konsentrasi S1 mendukung anda memperoleh pekerjaan?</label>
                            <input type="radio" name="college_sarjana" class="flat-red" value="1" <?= isset($data) ? ($data['college_sarjana'] == "1" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="college_sarjana" class="flat-red" value="2" <?= isset($data) ? ($data['college_sarjana'] == "2" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="college_sarjana" class="flat-red" value="3" <?= isset($data) ? ($data['college_sarjana'] == "3" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="college_sarjana" class="flat-red" value="4" <?= isset($data) ? ($data['college_sarjana'] == "4" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="college_sarjana" class="flat-red" value="5" <?= isset($data) ? ($data['college_sarjana'] == "5" ? 'checked' : '') : '' ?> required>
                        </div>
                        <div class="kuisioner-quest">
                            <label>Seberapa penting peringkat Universitas mendukung anda memperoleh pekerjaan?</label>
                            <input type="radio" name="college_peringkat" class="flat-red" value="1" <?= isset($data) ? ($data['college_peringkat'] == "1" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="college_peringkat" class="flat-red" value="2" <?= isset($data) ? ($data['college_peringkat'] == "2" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="college_peringkat" class="flat-red" value="3" <?= isset($data) ? ($data['college_peringkat'] == "3" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="college_peringkat" class="flat-red" value="4" <?= isset($data) ? ($data['college_peringkat'] == "4" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="college_peringkat" class="flat-red" value="5" <?= isset($data) ? ($data['college_peringkat'] == "5" ? 'checked' : '') : '' ?> required>
                        </div>
                        <div class="kuisioner-quest">
                            <label>Seberapa penting peringkat Program Studi/ Akreditasi mendukung anda memperoleh pekerjaan?</label>
                            <input type="radio" name="college_akreditasi_prodi" class="flat-red" value="1" <?= isset($data) ? ($data['college_akreditasi_prodi'] == "1" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="college_akreditasi_prodi" class="flat-red" value="2" <?= isset($data) ? ($data['college_akreditasi_prodi'] == "2" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="college_akreditasi_prodi" class="flat-red" value="3" <?= isset($data) ? ($data['college_akreditasi_prodi'] == "3" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="college_akreditasi_prodi" class="flat-red" value="4" <?= isset($data) ? ($data['college_akreditasi_prodi'] == "4" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="college_akreditasi_prodi" class="flat-red" value="5" <?= isset($data) ? ($data['college_akreditasi_prodi'] == "5" ? 'checked' : '') : '' ?> required>
                        </div>
                        <div class="kuisioner-quest">
                            <label>Seberapa penting pengalaman bekerja sebelumnya mendukung anda memperoleh pekerjaan?</label>
                            <input type="radio" name="college_pengalaman_kerja" class="flat-red" value="1" <?= isset($data) ? ($data['college_pengalaman_kerja'] == "1" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="college_pengalaman_kerja" class="flat-red" value="2" <?= isset($data) ? ($data['college_pengalaman_kerja'] == "2" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="college_pengalaman_kerja" class="flat-red" value="3" <?= isset($data) ? ($data['college_pengalaman_kerja'] == "3" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="college_pengalaman_kerja" class="flat-red" value="4" <?= isset($data) ? ($data['college_pengalaman_kerja'] == "4" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="college_pengalaman_kerja" class="flat-red" value="5" <?= isset($data) ? ($data['college_pengalaman_kerja'] == "5" ? 'checked' : '') : '' ?> required>
                        </div>
                        <div class="kuisioner-quest">
                            <label>Seberapa penting kepribadian/ personality mendukung anda memperoleh pekerjaan?</label>
                            <input type="radio" name="college_personality" class="flat-red" value="1" <?= isset($data) ? ($data['college_personality'] == "1" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="college_personality" class="flat-red" value="2" <?= isset($data) ? ($data['college_personality'] == "2" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="college_personality" class="flat-red" value="3" <?= isset($data) ? ($data['college_personality'] == "3" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="college_personality" class="flat-red" value="4" <?= isset($data) ? ($data['college_personality'] == "4" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="college_personality" class="flat-red" value="5" <?= isset($data) ? ($data['college_personality'] == "5" ? 'checked' : '') : '' ?> required>
                        </div>
                        <div class="kuisioner-quest">
                            <label>Seberapa penting manfaat pembelajaran di S1 untuk menemukan pekerjaan yang sesuai dengan harapan setelah tamat?</label>
                            <input type="radio" name="college_manfaat" class="flat-red" value="1" <?= isset($data) ? ($data['college_manfaat'] == "1" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="college_manfaat" class="flat-red" value="2" <?= isset($data) ? ($data['college_manfaat'] == "2" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="college_manfaat" class="flat-red" value="3" <?= isset($data) ? ($data['college_manfaat'] == "3" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="college_manfaat" class="flat-red" value="4" <?= isset($data) ? ($data['college_manfaat'] == "4" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="college_manfaat" class="flat-red" value="5" <?= isset($data) ? ($data['college_manfaat'] == "5" ? 'checked' : '') : '' ?> required>
                        </div>
                        <div class="kuisioner-quest">
                            <label>Seberapa penting manfaat pembelajaran di S1 untuk mendukung profesionalisme tugas dipekerjaan anda saat ini?</label>
                            <input type="radio" name="college_manfaat_kerja" class="flat-red" value="1" <?= isset($data) ? ($data['college_manfaat_kerja'] == "1" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="college_manfaat_kerja" class="flat-red" value="2" <?= isset($data) ? ($data['college_manfaat_kerja'] == "2" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="college_manfaat_kerja" class="flat-red" value="3" <?= isset($data) ? ($data['college_manfaat_kerja'] == "3" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="college_manfaat_kerja" class="flat-red" value="4" <?= isset($data) ? ($data['college_manfaat_kerja'] == "4" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="college_manfaat_kerja" class="flat-red" value="5" <?= isset($data) ? ($data['college_manfaat_kerja'] == "5" ? 'checked' : '') : '' ?> required>
                        </div>
                        <div class="kuisioner-quest">
                            <label>Seberapa penting manfaat pembelajaran di S1 untuk mendukung pengembangan karir anda ke depan? </label>
                            <input type="radio" name="college_manfaat_karir" class="flat-red" value="1" <?= isset($data) ? ($data['college_manfaat_karir'] == "1" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="college_manfaat_karir" class="flat-red" value="2" <?= isset($data) ? ($data['college_manfaat_karir'] == "2" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="college_manfaat_karir" class="flat-red" value="3" <?= isset($data) ? ($data['college_manfaat_karir'] == "3" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="college_manfaat_karir" class="flat-red" value="4" <?= isset($data) ? ($data['college_manfaat_karir'] == "4" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="college_manfaat_karir" class="flat-red" value="5" <?= isset($data) ? ($data['college_manfaat_karir'] == "5" ? 'checked' : '') : '' ?> required>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="box box-info" style="margin-top: 2rem;">
    <div class="box-body">
        <div class="tab-content">
            <div class="row">
                <div class="col-md-6" style="padding-right: 2rem; padding-left: 2rem;">
                    <div style="width: 100%;">
                        <h4 style="font-weight: bold;margin-bottom:2rem">Jawablah pertanyaan berikut sesuai persepsi anda selama pernah kuliah di Prodi Ilmu Ekonomi FEB UNRI</h4>
                        <div class="labeling-radio">
                            <p>Sangat Kurang</p>
                            <p>Kurang</p>
                            <p>Cukup</p>
                            <p>Baik</p>
                            <p>Sangat Baik</p>
                        </div>
                        <div class="kuisioner-quest">
                            <label>Bagaimana penilaian anda tentang Bimbingan PA di Program Studi Ilmu Ekonomi pada saat anda kuliah?</label>
                            <input type="radio" name="penilaian_bimbingan_pa" class="flat-red" value="1" <?= isset($data) ? ($data['penilaian_bimbingan_pa'] == "1" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="penilaian_bimbingan_pa" class="flat-red" value="2" <?= isset($data) ? ($data['penilaian_bimbingan_pa'] == "2" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="penilaian_bimbingan_pa" class="flat-red" value="3" <?= isset($data) ? ($data['penilaian_bimbingan_pa'] == "3" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="penilaian_bimbingan_pa" class="flat-red" value="4" <?= isset($data) ? ($data['penilaian_bimbingan_pa'] == "4" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="penilaian_bimbingan_pa" class="flat-red" value="5" <?= isset($data) ? ($data['penilaian_bimbingan_pa'] == "5" ? 'checked' : '') : '' ?> required>
                        </div>
                        <div class="kuisioner-quest">
                            <label>Bagaimana penilaian anda tentang konten mata kuliah di Program Studi Ilmu Ekonomi pada saat anda kuliah?</label>
                            <input type="radio" name="penilaian_konten_matkul" class="flat-red" value="1" <?= isset($data) ? ($data['penilaian_konten_matkul'] == "1" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="penilaian_konten_matkul" class="flat-red" value="2" <?= isset($data) ? ($data['penilaian_konten_matkul'] == "2" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="penilaian_konten_matkul" class="flat-red" value="3" <?= isset($data) ? ($data['penilaian_konten_matkul'] == "3" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="penilaian_konten_matkul" class="flat-red" value="4" <?= isset($data) ? ($data['penilaian_konten_matkul'] == "4" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="penilaian_konten_matkul" class="flat-red" value="5" <?= isset($data) ? ($data['penilaian_konten_matkul'] == "5" ? 'checked' : '') : '' ?> required>
                        </div>
                        <div class="kuisioner-quest">
                            <label>Bagaimana penilaian anda tentang variasi mata kuliah yang ditawarkan pada Program Studi Ilmu Ekonomi pada saat anda kuliah?</label>
                            <input type="radio" name="penilaian_variasi_matkul" class="flat-red" value="1" <?= isset($data) ? ($data['penilaian_variasi_matkul'] == "1" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="penilaian_variasi_matkul" class="flat-red" value="2" <?= isset($data) ? ($data['penilaian_variasi_matkul'] == "2" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="penilaian_variasi_matkul" class="flat-red" value="3" <?= isset($data) ? ($data['penilaian_variasi_matkul'] == "3" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="penilaian_variasi_matkul" class="flat-red" value="4" <?= isset($data) ? ($data['penilaian_variasi_matkul'] == "4" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="penilaian_variasi_matkul" class="flat-red" value="5" <?= isset($data) ? ($data['penilaian_variasi_matkul'] == "5" ? 'checked' : '') : '' ?> required>
                        </div>
                        <div class="kuisioner-quest">
                            <label>Bagaimana penilaian anda tentang sistem penilaian dosen pada Program Studi Ilmu Ekonomi pada saat anda kuliah?</label>
                            <input type="radio" name="penilaian_dari_dosen" class="flat-red" value="1" <?= isset($data) ? ($data['penilaian_dari_dosen'] == "1" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="penilaian_dari_dosen" class="flat-red" value="2" <?= isset($data) ? ($data['penilaian_dari_dosen'] == "2" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="penilaian_dari_dosen" class="flat-red" value="3" <?= isset($data) ? ($data['penilaian_dari_dosen'] == "3" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="penilaian_dari_dosen" class="flat-red" value="4" <?= isset($data) ? ($data['penilaian_dari_dosen'] == "4" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="penilaian_dari_dosen" class="flat-red" value="5" <?= isset($data) ? ($data['penilaian_dari_dosen'] == "5" ? 'checked' : '') : '' ?> required>
                        </div>
                        <div class="kuisioner-quest">
                            <label>Bagaimana penilaian anda tentang rancangan kurikulum di Program Studi Ilmu Ekonomi pada saat anda kuliah?</label>
                            <input type="radio" name="penilaian_rancangan_kurikulum" class="flat-red" value="1" <?= isset($data) ? ($data['penilaian_rancangan_kurikulum'] == "1" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="penilaian_rancangan_kurikulum" class="flat-red" value="2" <?= isset($data) ? ($data['penilaian_rancangan_kurikulum'] == "2" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="penilaian_rancangan_kurikulum" class="flat-red" value="3" <?= isset($data) ? ($data['penilaian_rancangan_kurikulum'] == "3" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="penilaian_rancangan_kurikulum" class="flat-red" value="4" <?= isset($data) ? ($data['penilaian_rancangan_kurikulum'] == "4" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="penilaian_rancangan_kurikulum" class="flat-red" value="5" <?= isset($data) ? ($data['penilaian_rancangan_kurikulum'] == "5" ? 'checked' : '') : '' ?> required>
                        </div>
                        <div class="kuisioner-quest">
                            <label>Bagaimana penilaian anda tentang kesempatan memilih mata kuliah/konsentrasi di Program Studi Ilmu Ekonomi pada saat anda kuliah?</label>
                            <input type="radio" name="penilaian_milih_matkul" class="flat-red" value="1" <?= isset($data) ? ($data['penilaian_milih_matkul'] == "1" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="penilaian_milih_matkul" class="flat-red" value="2" <?= isset($data) ? ($data['penilaian_milih_matkul'] == "2" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="penilaian_milih_matkul" class="flat-red" value="3" <?= isset($data) ? ($data['penilaian_milih_matkul'] == "3" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="penilaian_milih_matkul" class="flat-red" value="4" <?= isset($data) ? ($data['penilaian_milih_matkul'] == "4" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="penilaian_milih_matkul" class="flat-red" value="5" <?= isset($data) ? ($data['penilaian_milih_matkul'] == "5" ? 'checked' : '') : '' ?> required>
                        </div>
                        <div class="kuisioner-quest">
                            <label>Bagaimana penilaian anda tentang kualitas dosen kualitas dosen di Program Studi Ilmu Ekonomi pada saat anda kuliah?</label>
                            <input type="radio" name="penilaian_kualitas_dosen" class="flat-red" value="1" <?= isset($data) ? ($data['penilaian_kualitas_dosen'] == "1" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="penilaian_kualitas_dosen" class="flat-red" value="2" <?= isset($data) ? ($data['penilaian_kualitas_dosen'] == "2" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="penilaian_kualitas_dosen" class="flat-red" value="3" <?= isset($data) ? ($data['penilaian_kualitas_dosen'] == "3" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="penilaian_kualitas_dosen" class="flat-red" value="4" <?= isset($data) ? ($data['penilaian_kualitas_dosen'] == "4" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="penilaian_kualitas_dosen" class="flat-red" value="5" <?= isset($data) ? ($data['penilaian_kualitas_dosen'] == "5" ? 'checked' : '') : '' ?> required>
                        </div>
                        <div class="kuisioner-quest">
                            <label>Bagaimana penilaian tentang metode pengajaran di Program Studi Ilmu Ekonomi pada saat anda kuliah? </label>
                            <input type="radio" name="penilaian_metode_ajar" class="flat-red" value="1" <?= isset($data) ? ($data['penilaian_metode_ajar'] == "1" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="penilaian_metode_ajar" class="flat-red" value="2" <?= isset($data) ? ($data['penilaian_metode_ajar'] == "2" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="penilaian_metode_ajar" class="flat-red" value="3" <?= isset($data) ? ($data['penilaian_metode_ajar'] == "3" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="penilaian_metode_ajar" class="flat-red" value="4" <?= isset($data) ? ($data['penilaian_metode_ajar'] == "4" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="penilaian_metode_ajar" class="flat-red" value="5" <?= isset($data) ? ($data['penilaian_metode_ajar'] == "5" ? 'checked' : '') : '' ?> required>
                        </div>
                        <div class="kuisioner-quest">
                            <label>Bagaimana penilaian anda tentang kesempatan berpartisipasi pada penelitian di Program Studi Ilmu Ekonomi pada saat anda kuliah? </label>
                            <input type="radio" name="penilaian_ikut_penelitian" class="flat-red" value="1" <?= isset($data) ? ($data['penilaian_ikut_penelitian'] == "1" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="penilaian_ikut_penelitian" class="flat-red" value="2" <?= isset($data) ? ($data['penilaian_ikut_penelitian'] == "2" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="penilaian_ikut_penelitian" class="flat-red" value="3" <?= isset($data) ? ($data['penilaian_ikut_penelitian'] == "3" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="penilaian_ikut_penelitian" class="flat-red" value="4" <?= isset($data) ? ($data['penilaian_ikut_penelitian'] == "4" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="penilaian_ikut_penelitian" class="flat-red" value="5" <?= isset($data) ? ($data['penilaian_ikut_penelitian'] == "5" ? 'checked' : '') : '' ?> required>
                        </div>
                        <div class="kuisioner-quest">
                            <label>Bagaimana penilaian anda tentang kesempatan berkomunikasi dengan dosen diluar kelas di Program Studi Ilmu Ekonomi pada Saat anda kuliah? </label>
                            <input type="radio" name="penilaian_komunikasi_dosen" class="flat-red" value="1" <?= isset($data) ? ($data['penilaian_komunikasi_dosen'] == "1" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="penilaian_komunikasi_dosen" class="flat-red" value="2" <?= isset($data) ? ($data['penilaian_komunikasi_dosen'] == "2" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="penilaian_komunikasi_dosen" class="flat-red" value="3" <?= isset($data) ? ($data['penilaian_komunikasi_dosen'] == "3" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="penilaian_komunikasi_dosen" class="flat-red" value="4" <?= isset($data) ? ($data['penilaian_komunikasi_dosen'] == "4" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="penilaian_komunikasi_dosen" class="flat-red" value="5" <?= isset($data) ? ($data['penilaian_komunikasi_dosen'] == "5" ? 'checked' : '') : '' ?> required>
                        </div>
                        <div class="kuisioner-quest">
                            <label>Bagaimana penilaian anda tentang kuliah praktek lapangan/pengajar praktisi Program Studi Ilmu Ekonomi pada saat anda kuliah? </label>
                            <input type="radio" name="penilaian_kerja_praktik" class="flat-red" value="1" <?= isset($data) ? ($data['penilaian_kerja_praktik'] == "1" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="penilaian_kerja_praktik" class="flat-red" value="2" <?= isset($data) ? ($data['penilaian_kerja_praktik'] == "2" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="penilaian_kerja_praktik" class="flat-red" value="3" <?= isset($data) ? ($data['penilaian_kerja_praktik'] == "3" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="penilaian_kerja_praktik" class="flat-red" value="4" <?= isset($data) ? ($data['penilaian_kerja_praktik'] == "4" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="penilaian_kerja_praktik" class="flat-red" value="5" <?= isset($data) ? ($data['penilaian_kerja_praktik'] == "5" ? 'checked' : '') : '' ?> required>
                        </div>
                        <div class="kuisioner-quest">
                            <label>Bagaimana penilaian anda tentang studi banding Program Studi Ilmu Ekonomi pada saat anda kuliah? </label>
                            <input type="radio" name="penilaian_studi_banding" class="flat-red" value="1" <?= isset($data) ? ($data['penilaian_studi_banding'] == "1" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="penilaian_studi_banding" class="flat-red" value="2" <?= isset($data) ? ($data['penilaian_studi_banding'] == "2" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="penilaian_studi_banding" class="flat-red" value="3" <?= isset($data) ? ($data['penilaian_studi_banding'] == "3" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="penilaian_studi_banding" class="flat-red" value="4" <?= isset($data) ? ($data['penilaian_studi_banding'] == "4" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="penilaian_studi_banding" class="flat-red" value="5" <?= isset($data) ? ($data['penilaian_studi_banding'] == "5" ? 'checked' : '') : '' ?> required>
                        </div>
                        <div class="kuisioner-quest">
                            <label>Bagaimana penilaian anda tentang labor komputer pada Program Studi Ilmu Ekonomi pada saat anda kuliah? </label>
                            <input type="radio" name="penilaian_lab_komputer" class="flat-red" value="1" <?= isset($data) ? ($data['penilaian_lab_komputer'] == "1" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="penilaian_lab_komputer" class="flat-red" value="2" <?= isset($data) ? ($data['penilaian_lab_komputer'] == "2" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="penilaian_lab_komputer" class="flat-red" value="3" <?= isset($data) ? ($data['penilaian_lab_komputer'] == "3" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="penilaian_lab_komputer" class="flat-red" value="4" <?= isset($data) ? ($data['penilaian_lab_komputer'] == "4" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="penilaian_lab_komputer" class="flat-red" value="5" <?= isset($data) ? ($data['penilaian_lab_komputer'] == "5" ? 'checked' : '') : '' ?> required>
                        </div>
                        <div class="kuisioner-quest">
                            <label>Bagaimana penilaian anda tentang fasilitas/internet pada Program Studi Ilmu Ekonomi pada saat anda kuliah? </label>
                            <input type="radio" name="penilaian_internet" class="flat-red" value="1" <?= isset($data) ? ($data['penilaian_internet'] == "1" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="penilaian_internet" class="flat-red" value="2" <?= isset($data) ? ($data['penilaian_internet'] == "2" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="penilaian_internet" class="flat-red" value="3" <?= isset($data) ? ($data['penilaian_internet'] == "3" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="penilaian_internet" class="flat-red" value="4" <?= isset($data) ? ($data['penilaian_internet'] == "4" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="penilaian_internet" class="flat-red" value="5" <?= isset($data) ? ($data['penilaian_internet'] == "5" ? 'checked' : '') : '' ?> required>
                        </div>
                        <div class="kuisioner-quest">
                            <label>Bagaimana penilaian anda tentang ruang baca dan pustaka pada Program Studi Ilmu Ekonomi pada saat anda kuliah? </label>
                            <input type="radio" name="penilaian_pustaka" class="flat-red" value="1" <?= isset($data) ? ($data['penilaian_pustaka'] == "1" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="penilaian_pustaka" class="flat-red" value="2" <?= isset($data) ? ($data['penilaian_pustaka'] == "2" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="penilaian_pustaka" class="flat-red" value="3" <?= isset($data) ? ($data['penilaian_pustaka'] == "3" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="penilaian_pustaka" class="flat-red" value="4" <?= isset($data) ? ($data['penilaian_pustaka'] == "4" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="penilaian_pustaka" class="flat-red" value="5" <?= isset($data) ? ($data['penilaian_pustaka'] == "5" ? 'checked' : '') : '' ?> required>
                        </div>
                        <div class="kuisioner-quest">
                            <label>Bagaimana penilaian anda tentang layanan petugas administrasi akademik Program Studi Ilmu Ekonomi pada saat anda kuliah? </label>
                            <input type="radio" name="penilaian_administrasi" class="flat-red" value="1" <?= isset($data) ? ($data['penilaian_administrasi'] == "1" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="penilaian_administrasi" class="flat-red" value="2" <?= isset($data) ? ($data['penilaian_administrasi'] == "2" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="penilaian_administrasi" class="flat-red" value="3" <?= isset($data) ? ($data['penilaian_administrasi'] == "3" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="penilaian_administrasi" class="flat-red" value="4" <?= isset($data) ? ($data['penilaian_administrasi'] == "4" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="penilaian_administrasi" class="flat-red" value="5" <?= isset($data) ? ($data['penilaian_administrasi'] == "5" ? 'checked' : '') : '' ?> required>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="box box-info" style="margin-top: 2rem;">
    <div class="box-body">
        <div class="tab-content">
            <div class="row">
                <div class="col-md-6" style="padding-right: 2rem; padding-left: 2rem;">
                    <div style="width: 100%;">
                        <h4 style="font-weight: bold;margin-bottom:2rem">Jawablah pertanyaan berikut sesuai dengan persepsi anda mengenai keahlian dan keterampilan yang anda peroleh selama kuliah di Prodi Ilmu Ekonomi FEB UNRI</h4>
                        <div class="labeling-radio">
                            <p>Sangat Kurang</p>
                            <p>Kurang/p>
                            <p>Cukup</p>
                            <p>Baik</p>
                            <p>Sangat Baik</p>
                        </div>
                        <div class="kuisioner-quest">
                            <label>Keahlian mengidentifikasi, merumuskan dan memecahkan masalah di tempat kerja berhubungan dengan pekerjaan anda</label>
                            <input type="radio" name="keahlian_identifikasi" class="flat-red" value="1" <?= isset($data) ? ($data['keahlian_identifikasi'] == "1" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="keahlian_identifikasi" class="flat-red" value="2" <?= isset($data) ? ($data['keahlian_identifikasi'] == "2" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="keahlian_identifikasi" class="flat-red" value="3" <?= isset($data) ? ($data['keahlian_identifikasi'] == "3" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="keahlian_identifikasi" class="flat-red" value="4" <?= isset($data) ? ($data['keahlian_identifikasi'] == "4" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="keahlian_identifikasi" class="flat-red" value="5" <?= isset($data) ? ($data['keahlian_identifikasi'] == "5" ? 'checked' : '') : '' ?> required>
                        </div>
                        <div class="kuisioner-quest">
                            <label>Keahlian menggunakan aplikasi manajerial berhubungan dengan pekerjaan anda</label>
                            <input type="radio" name="keahlian_aplikasi_manajerial" class="flat-red" value="1" <?= isset($data) ? ($data['keahlian_aplikasi_manajerial'] == "1" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="keahlian_aplikasi_manajerial" class="flat-red" value="2" <?= isset($data) ? ($data['keahlian_aplikasi_manajerial'] == "2" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="keahlian_aplikasi_manajerial" class="flat-red" value="3" <?= isset($data) ? ($data['keahlian_aplikasi_manajerial'] == "3" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="keahlian_aplikasi_manajerial" class="flat-red" value="4" <?= isset($data) ? ($data['keahlian_aplikasi_manajerial'] == "4" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="keahlian_aplikasi_manajerial" class="flat-red" value="5" <?= isset($data) ? ($data['keahlian_aplikasi_manajerial'] == "5" ? 'checked' : '') : '' ?> required>
                        </div>
                        <div class="kuisioner-quest">
                            <label>Keahlian menggunakan Leadership skill berhubungan dengan pekerjaan anda</label>
                            <input type="radio" name="keahlian_leadership" class="flat-red" value="1" <?= isset($data) ? ($data['keahlian_leadership'] == "1" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="keahlian_leadership" class="flat-red" value="2" <?= isset($data) ? ($data['keahlian_leadership'] == "2" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="keahlian_leadership" class="flat-red" value="3" <?= isset($data) ? ($data['keahlian_leadership'] == "3" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="keahlian_leadership" class="flat-red" value="4" <?= isset($data) ? ($data['keahlian_leadership'] == "4" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="keahlian_leadership" class="flat-red" value="5" <?= isset($data) ? ($data['keahlian_leadership'] == "5" ? 'checked' : '') : '' ?> required>
                        </div>
                        <div class="kuisioner-quest">
                            <label>Keahlian mengkomunikasikan pendapat lisan maupun tertulis berhubungan dengan pekerjaan anda</label>
                            <input type="radio" name="keahlian_berpendapat" class="flat-red" value="1" <?= isset($data) ? ($data['keahlian_berpendapat'] == "1" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="keahlian_berpendapat" class="flat-red" value="2" <?= isset($data) ? ($data['keahlian_berpendapat'] == "2" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="keahlian_berpendapat" class="flat-red" value="3" <?= isset($data) ? ($data['keahlian_berpendapat'] == "3" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="keahlian_berpendapat" class="flat-red" value="4" <?= isset($data) ? ($data['keahlian_berpendapat'] == "4" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="keahlian_berpendapat" class="flat-red" value="5" <?= isset($data) ? ($data['keahlian_berpendapat'] == "5" ? 'checked' : '') : '' ?> required>
                        </div>
                        <div class="kuisioner-quest">
                            <label>Keahlian menggunakan bahasa inggris secara fasih berhubungan dengan pekerjaan anda</label>
                            <input type="radio" name="keahlian_inggris" class="flat-red" value="1" <?= isset($data) ? ($data['keahlian_inggris'] == "1" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="keahlian_inggris" class="flat-red" value="2" <?= isset($data) ? ($data['keahlian_inggris'] == "2" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="keahlian_inggris" class="flat-red" value="3" <?= isset($data) ? ($data['keahlian_inggris'] == "3" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="keahlian_inggris" class="flat-red" value="4" <?= isset($data) ? ($data['keahlian_inggris'] == "4" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="keahlian_inggris" class="flat-red" value="5" <?= isset($data) ? ($data['keahlian_inggris'] == "5" ? 'checked' : '') : '' ?> required>
                        </div>
                        <div class="kuisioner-quest">
                            <label>Keahlian memimpin kelompok kerja berhubungan dengan pekerjaan anda</label>
                            <input type="radio" name="keahlian_memimpin" class="flat-red" value="1" <?= isset($data) ? ($data['keahlian_memimpin'] == "1" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="keahlian_memimpin" class="flat-red" value="2" <?= isset($data) ? ($data['keahlian_memimpin'] == "2" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="keahlian_memimpin" class="flat-red" value="3" <?= isset($data) ? ($data['keahlian_memimpin'] == "3" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="keahlian_memimpin" class="flat-red" value="4" <?= isset($data) ? ($data['keahlian_memimpin'] == "4" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="keahlian_memimpin" class="flat-red" value="5" <?= isset($data) ? ($data['keahlian_memimpin'] == "5" ? 'checked' : '') : '' ?> required>
                        </div>
                        <div class="kuisioner-quest">
                            <label>Keahlian menerapkan kaidah etika profesi dan komitmen kerja berhubungan dengan pekerjaan anda</label>
                            <input type="radio" name="keahlian_etika_profesi" class="flat-red" value="1" <?= isset($data) ? ($data['keahlian_etika_profesi'] == "1" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="keahlian_etika_profesi" class="flat-red" value="2" <?= isset($data) ? ($data['keahlian_etika_profesi'] == "2" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="keahlian_etika_profesi" class="flat-red" value="3" <?= isset($data) ? ($data['keahlian_etika_profesi'] == "3" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="keahlian_etika_profesi" class="flat-red" value="4" <?= isset($data) ? ($data['keahlian_etika_profesi'] == "4" ? 'checked' : '') : '' ?> required>
                            <input type="radio" name="keahlian_etika_profesi" class="flat-red" value="5" <?= isset($data) ? ($data['keahlian_etika_profesi'] == "5" ? 'checked' : '') : '' ?> required>
                        </div>
                    </div>
                    <div class="form-group" style="margin-bottom: 2rem;">
                        <label for='kritik_saran'>Kritik dan Saran yang Membangun untuk Kemajuan Program Studi <span style="color:red">*</span></label><br>
                        <input type="text" name="kritik_saran" class="form-control" value="<?= isset($data) ? $data['kritik_saran'] : '' ?>" required placeholder="Your Answer">
                    </div>
                </div>

            </div>
            <div class="modal-footer set-submit">
                <button type="submit" class="btn btn-primary btn-submit"><i class="fa fa-save"></i> Simpan</button>
            </div>
        </div>
    </div>
</div>
<?php echo form_close(); ?>
<?= $this->endsection() ?>

<?= $this->section('js') ?>
<script>
    function toggleOtherInput(radio, jenis) {
        var otherInput = document.getElementById("other-input-" + jenis);
        if (radio.value === "Other") {
            otherInput.required = true;
            otherInput.disabled = false;
        } else {
            otherInput.required = false;
            otherInput.disabled = true;
        }
    }

    $('.survey-form').submit(function(e) {
        e.preventDefault();
        var form = $(this);
        var btn = form.find('.btn-submit');
        var htm = btn.html();
        setLoadingBtn(btn);
        var formData = new FormData(form[0]);
        $.ajax({
            url: base_url + '/survey/save',
            type: 'post',
            dataType: 'json',
            data: formData,
            contentType: false,
            processData: false,
            success: function(res) {
                if (res.status) {
                    successMsg(res.msg);
                } else {
                    errorMsg(res.msg);
                }
                resetLoadingBtn(btn, htm);
            },
            error: function(xhr, status, error) {
                resetLoadingBtn(btn, htm);
                errorMsg(error);
            }
        })
    })
</script>
<?= $this->endsection() ?>