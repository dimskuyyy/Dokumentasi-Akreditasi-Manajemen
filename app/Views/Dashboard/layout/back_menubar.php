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
            $permmedia = [1, 2, 3, 5, 6];
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
            $permkerjasama = [1, 2, 3];
            if (in_array(AuthUser()->type, $permkerjasama)) {
            ?>
                <li class="<?= $request->uri->getSegment(2) === "kerjasama" ? 'active' : ''; ?>">
                    <a href="<?php echo base_url('wbpanel/kerjasama'); ?>">
                        <i class="fa fa-handshake-o"></i> <span>Kerjasama</span>
                    </a>
                </li>
            <?php } ?>
            <?php
            $permkegiatan = [1, 2, 3, 5];
            if (in_array(AuthUser()->type, $permkegiatan)) {
            ?>
                <li class="<?= $request->uri->getSegment(2) === "kegiatan" ? 'active' : ''; ?>">
                    <a href="<?php echo base_url('wbpanel/kegiatan'); ?>">
                        <i class="fa fa-calendar-o"></i> <span>Kegiatan</span>
                    </a>
                </li>
            <?php } ?>
            <?php
            $perkepanitiaan = [1, 2, 3, 5, 6];
            if (in_array(AuthUser()->type, $perkepanitiaan)) {
            ?>
                <li class="<?= $request->uri->getSegment(2) === "kepanitiaan" ? 'active' : ''; ?>">
                    <a href="<?php echo base_url('wbpanel/kepanitiaan'); ?>">
                        <i class="fa fa-flag-o"></i> <span>Kepanitiaan</span>
                    </a>
                </li>
            <?php } ?>
            <?php
            if (AuthUser()->level == 1) {
            ?>
                <br>
                <li class="header">Daftar User</li>
            <?php } ?>


        </ul>
    </section>
</aside>