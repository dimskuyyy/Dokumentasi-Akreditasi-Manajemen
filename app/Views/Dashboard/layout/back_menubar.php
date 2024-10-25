<?php $request = service('request'); ?>
<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo base_url() ?>/img/avatar.png" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?= AuthUser()->nama; ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <ul class="sidebar-menu tree" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li class="<?= $request->uri->getSegment(2) === "" ? 'active' : ''; ?>">
                <a href="<?php echo base_url('wbpanel'); ?>">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            <?php
            $permmedia = [1, 2, 3, 5, 6, 8];
            if (in_array(AuthUser()->type, $permmedia)) { ?>
                <li class="<?= $request->uri->getSegment(2) === "media" ? 'active' : ''; ?>">
                    <a href="<?php echo base_url('wbpanel/media'); ?>">
                        <i class="fa fa-folder-open"></i> <span>Media</span>
                    </a>
                </li>
            <?php } ?>
            <?php
            $permpengajaran = [5];
            if (in_array(AuthUser()->type, $permpengajaran)) {
            ?>
                <li class="<?= $request->uri->getSegment(2) === "pengajaran-dosen" ? 'active' : ''; ?>">
                    <a href="<?php echo base_url('wbpanel/pengajaran-dosen'); ?>">
                        <i class="fa fa-book"></i> <span>SK Pengajaran</span>
                    </a>
                </li>
            <?php } ?>
            <?php
            $permaktivitas = [6];
            if (in_array(AuthUser()->type, $permaktivitas)) {
            ?>
                <li class="<?= $request->uri->getSegment(2) === "aktivitas" ? 'active' : ''; ?>">
                    <a href="<?php echo base_url('wbpanel/aktivitas'); ?>">
                        <i class="fa fa-hand-rock-o"></i> <span>Aktivitas Mahasiswa</span>
                    </a>
                </li>
            <?php } ?>
            <?php
            $permpenelitian = [5, 6];
            if (in_array(AuthUser()->type, $permpenelitian)) {
            ?>
                <li class="<?= $request->uri->getSegment(2) === "penelitian" ? 'active' : ''; ?>">
                    <a href="<?php echo base_url('wbpanel/penelitian'); ?>">
                        <i class="fa fa-file-text-o"></i> <span>Penelitian</span>
                    </a>
                </li>
            <?php } ?>
            <?php
            $permpengabdian = [5, 6];
            if (in_array(AuthUser()->type, $permpengabdian)) {
            ?>
                <li class="<?= $request->uri->getSegment(2) === "pengabdian" ? 'active' : ''; ?>">
                    <a href="<?php echo base_url('wbpanel/pengabdian'); ?>">
                        <i class="fa fa-briefcase"></i> <span>Pengabdian</span>
                    </a>
                </li>
            <?php } ?>
            <?php
            $permprestasi = [6];
            if (in_array(AuthUser()->type, $permprestasi)) {
            ?>
                <li class="<?= $request->uri->getSegment(2) === "prestasi" ? 'active' : ''; ?>">
                    <a href="<?php echo base_url('wbpanel/prestasi'); ?>">
                        <i class="fa fa-trophy"></i> <span>Prestasi</span>
                    </a>
                </li>
            <?php } ?>
            <?php
            $permkerjasama = [1, 3];
            if (in_array(AuthUser()->type, $permkerjasama)) {
            ?>
                <li class="<?= $request->uri->getSegment(2) === "kerjasama" ? 'active' : ''; ?>">
                    <a href="<?php echo base_url('wbpanel/kerjasama'); ?>">
                        <i class="fa fa-handshake-o"></i> <span>Kerjasama</span>
                    </a>
                </li>
            <?php } ?>
            <?php
            $permsop = [1];
            if (in_array(AuthUser()->type, $permsop)) {
            ?>
                <li class="<?= $request->uri->getSegment(2) === "sop" ? 'active' : ''; ?>">
                    <a href="<?php echo base_url('wbpanel/sop'); ?>">
                        <i class="fa fa-gavel"></i> <span>SOP</span>
                    </a>
                </li>
            <?php } ?>
            <?php
            $permrenstra = [1];
            if (in_array(AuthUser()->type, $permrenstra)) {
            ?>
                <li class="<?= $request->uri->getSegment(2) === "renstra" ? 'active' : ''; ?>">
                    <a href="<?php echo base_url('wbpanel/renstra'); ?>">
                        <i class="fa fa-podcast"></i> <span>Renstra</span>
                    </a>
                </li>
            <?php } ?>
            <?php
            $permanggaran = [1];
            if (in_array(AuthUser()->type, $permanggaran)) {
            ?>
                <li class="<?= $request->uri->getSegment(2) === "anggaran" ? 'active' : ''; ?>">
                    <a href="<?php echo base_url('wbpanel/anggaran'); ?>">
                        <i class="fa fa-money"></i> <span>Anggaran</span>
                    </a>
                </li>
            <?php } ?>
            <?php
            $permsk = [1];
            if (in_array(AuthUser()->type, $permsk)) {
            ?>
                <li class="<?= $request->uri->getSegment(2) === "surat-keputusan" ? 'active' : ''; ?>">
                    <a href="<?php echo base_url('wbpanel/surat-keputusan'); ?>">
                        <i class="fa fa-envelope-o"></i> <span>Surat Keputusan</span>
                    </a>
                </li>
            <?php } ?>
            <?php
            $permsurattugas = [1, 2];
            if (in_array(AuthUser()->type, $permsurattugas)) {
            ?>
                <li class="<?= $request->uri->getSegment(2) === "surat-tugas" ? 'active' : ''; ?>">
                    <a href="<?php echo base_url('wbpanel/surat-tugas'); ?>">
                        <i class="fa fa-file-text-o"></i> <span>Surat Tugas</span>
                    </a>
                </li>
            <?php } ?>
            <?php
            $permsertifikat = [5, 8];
            if (in_array(AuthUser()->type, $permsertifikat)) {
            ?>
                <li class="<?= $request->uri->getSegment(2) === "sertifikat" ? 'active' : ''; ?>">
                    <a href="<?php echo base_url('wbpanel/sertifikat'); ?>">
                        <i class="fa fa-id-card-o"></i> <span>Sertifikat Kompetensi/Profesi</span>
                    </a>
                </li>
            <?php } ?>
            <?php
            $permstudi = [8];
            if (in_array(AuthUser()->type, $permstudi)) {
            ?>
                <li class="<?= $request->uri->getSegment(2) === "lama-studi" ? 'active' : ''; ?>">
                    <a href="<?php echo base_url('wbpanel/lama-studi'); ?>">
                        <i class="fa fa-history"></i> <span>Lama Studi Mahasiswa</span>
                    </a>
                </li>
            <?php } ?>
            <?php
            $permipk = [8];
            if (in_array(AuthUser()->type, $permipk)) {
            ?>
                <li class="<?= $request->uri->getSegment(2) === "ipk-mahasiswa" ? 'active' : ''; ?>">
                    <a href="<?php echo base_url('wbpanel/ipk-mahasiswa'); ?>">
                        <i class="fa fa-signal"></i> <span>IPK Mahasiswa</span>
                    </a>
                </li>
            <?php } ?>
            <?php
            $permhaki = [5];
            if (in_array(AuthUser()->type, $permhaki)) {
            ?>
                <li class="<?= $request->uri->getSegment(2) === "haki" ? 'active' : ''; ?>">
                    <a href="<?php echo base_url('wbpanel/haki'); ?>">
                        <i class="fa fa-certificate"></i> <span>HaKi</span>
                    </a>
                </li>
            <?php } ?>
            <?php
            $permpanduan = [1];
            if (in_array(AuthUser()->type, $permpanduan)) {
            ?>
                <li class="<?= $request->uri->getSegment(2) === "panduan-akademik" ? 'active' : ''; ?>">
                    <a href="<?php echo base_url('wbpanel/panduan-akademik'); ?>">
                        <i class="fa fa-pencil-square"></i> <span>Panduan Akademik</span>
                    </a>
                </li>
            <?php } ?>
            <?php
            $permkegiatan = [1, 2, 3];
            if (in_array(AuthUser()->type, $permkegiatan)) {
            ?>
                <li class="<?= $request->uri->getSegment(2) === "kegiatan" ? 'active' : ''; ?>">
                    <a href="<?php echo base_url('wbpanel/kegiatan'); ?>">
                        <?php if (AuthUser()->type == 1) { ?>
                            <i class="fa fa-calendar-o"></i> <span>Kegiatan Fakultas</span>
                        <?php } else if (AuthUser()->type == 2) { ?>
                            <i class="fa fa-calendar-o"></i> <span>Kegiatan Di Jurusan</span>
                        <?php } else if (AuthUser()->type == 3) { ?>
                            <i class="fa fa-calendar-o"></i> <span>Kegiatan Prodi</span>
                        <?php } else { ?>
                            <i class="fa fa-calendar-o"></i> <span>Kegiatan <?= AuthUser()->type_nama ?></span>
                        <?php } ?>
                    </a>
                </li>
            <?php } ?>
            <?php
            $permkegiatanluar = [5];
            if (in_array(AuthUser()->type, $permkegiatanluar)) {
            ?>
                <li class="<?= $request->uri->getSegment(2) === "kegiatan-dosen" ? ($request->uri->getSegment(3) === "luar-kampus" ? 'active' : '') : ''; ?>">
                    <a href="<?php echo base_url('wbpanel/kegiatan-dosen/luar-kampus'); ?>">
                        <i class="fa fa-building-o"></i> <span>Kegiatan Luar Kampus</span>
                    </a>
                </li>
            <?php } ?>
            <?php
            $permkegiatandalam = [5];
            if (in_array(AuthUser()->type, $permkegiatandalam)) {
            ?>
                <li class="<?= $request->uri->getSegment(2) === "kegiatan-dosen" ? ($request->uri->getSegment(3) === "dalam-kampus" ? 'active' : '') : ''; ?>">
                    <a href="<?php echo base_url('wbpanel/kegiatan-dosen/dalam-kampus'); ?>">
                        <i class="fa fa-calendar-o"></i> <span>Kegiatan Dalam Kampus</span>
                    </a>
                </li>
            <?php } ?>
            <?php
            $perkepanitiaan = [5, 6];
            if (in_array(AuthUser()->type, $perkepanitiaan)) {
            ?>
                <li class="<?= $request->uri->getSegment(2) === "kepanitiaan" ? 'active' : ''; ?>">
                    <a href="<?php echo base_url('wbpanel/kepanitiaan'); ?>">
                        <i class="fa fa-flag-o"></i> <span>Kepanitiaan</span>
                    </a>
                </li>
            <?php } ?>
            <?php
            $perSurvey = [7];
            if (in_array(AuthUser()->type, $perSurvey)) {
            ?>
                <li class="<?= $request->uri->getSegment(2) === "survey" ? 'active' : ''; ?>">
                    <a href="<?php echo base_url('wbpanel/survey'); ?>">
                        <i class="fa fa-address-book-o"></i> <span>Survey</span>
                    </a>
                </li>
            <?php } ?>
            <?php
            $permTaskforceOnly = [4];
            if (in_array(AuthUser()->type, $permTaskforceOnly)) {
            ?>
                <li class="<?= $request->uri->getSegment(2) === "check-dekan" ? 'active' : ''; ?>">
                    <a href="<?php echo base_url('wbpanel/check-dekan'); ?>">
                        <i class="fa fa-university"></i> <span>Dekan</span>
                    </a>
                </li>
                <li class="<?= $request->uri->getSegment(2) === "check-kajur" ? 'active' : ''; ?>">
                    <a href="<?php echo base_url('wbpanel/check-kajur'); ?>">
                        <i class="fa fa-university"></i> <span>Ketua Jurusan</span>
                    </a>
                </li>
                <li class="<?= $request->uri->getSegment(2) === "check-koor" ? 'active' : ''; ?>">
                    <a href="<?php echo base_url('wbpanel/check-koor'); ?>">
                        <i class="fa fa-university"></i> <span>Koordinator Program Studi</span>
                    </a>
                </li>
                <li class="<?= $request->uri->getSegment(2) === "check-dosen" ? 'active' : ''; ?>">
                    <a href="<?php echo base_url('wbpanel/check-dosen'); ?>">
                        <i class="fa fa-university"></i> <span>Dosen</span>
                    </a>
                </li>
                <li class="<?= $request->uri->getSegment(2) === "check-mahasiswa" ? 'active' : ''; ?>">
                    <a href="<?php echo base_url('wbpanel/check-mahasiswa'); ?>">
                        <i class="fa fa-graduation-cap"></i> <span>Mahasiswa</span>
                    </a>
                </li>
                <li class="<?= $request->uri->getSegment(2) === "check-alumni" ? 'active' : ''; ?>">
                    <a href="<?php echo base_url('wbpanel/check-alumni'); ?>">
                        <i class="fa fa-graduation-cap"></i> <span>Alumni</span>
                    </a>
                </li>
            <?php } ?>

            <?php
            $perUserControl = [1, 2, 3, 4];
            if (in_array(AuthUser()->type, $perUserControl)) {
            ?>
                <li class="<?= $request->uri->getSegment(2) === "user" ? 'active' : ''; ?>">
                    <a href="<?php echo base_url('wbpanel/user'); ?>">
                        <i class="fa fa-user"></i> <span>User</span>
                    </a>
                </li>
            <?php } ?>
            <?php
            $perProfile = [1, 2, 3, 4, 5, 6, 7];
            if (in_array(AuthUser()->type, $perProfile)) {
            ?>
                <li class="<?= $request->uri->getSegment(2) === "profile" ? 'active' : ''; ?>">
                    <a href="<?php echo base_url('wbpanel/profile'); ?>">
                        <i class="fa fa-male"></i> <span>Profile</span>
                    </a>
                </li>
            <?php } ?>


        </ul>
    </section>
</aside>