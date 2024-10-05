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
            $permkegiatan = [1,2,3,5]?>
            <?php if (AuthUser()->level == 1) : ?>
                <li class="<?= $request->uri->getSegment(2) === "kategori" ? 'active' : ''; ?>">
                    <a href="<?php echo base_url('wbpanel/kategori'); ?>">
                        <i class="fa fa-tags"></i> <span>Kategori</span>
                    </a>
                </li>
                <li class="treeview <?= $request->uri->getSegment(2) === "menu" ? 'active' : ''; ?>">
                    <a href="#">
                        <i class="fa fa-th-list"></i>
                        <span>Menu</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="<?= ($request->uri->getTotalSegments() >= 3 && $request->uri->getSegment(3) === "menu_utama") ? 'active' : ''; ?>"><a href="<?php echo base_url('wbpanel/menu/menu_utama'); ?>"><i class="fa fa-th-large"></i> Menu Utama</a></li>

                        <li class="<?= ($request->uri->getTotalSegments() >= 3 && $request->uri->getSegment(3) === "side_menu") ? 'active' : ''; ?>"><a href="<?php echo base_url('wbpanel/menu/side_menu'); ?>"><i class="fa fa-tasks"></i> Side Menu</a></li>

                        <li class="<?= ($request->uri->getTotalSegments() >= 3 && $request->uri->getSegment(3) === "menu_navigasi") ? 'active' : ''; ?>"><a href="<?php echo base_url('wbpanel/menu/menu_navigasi'); ?>"><i class="fa fa-ellipsis-h"></i> Menu Navigasi</a></li>

                    </ul>
                </li>
                <li class="<?= $request->uri->getSegment(2) === "komentar" ? 'active' : ''; ?>">
                    <a href="<?php echo base_url('wbpanel/komentar'); ?>">
                        <i class="fa fa-comments"></i> <span>Komentar</span>
                    </a>
                </li>
                <li class="<?= $request->uri->getSegment(2) === "running-text" ? 'active' : ''; ?>">
                    <a href="<?php echo base_url('wbpanel/running-text'); ?>">
                        <i class="fa fa-bullhorn"></i> <span>Running Text</span>
                    </a>
                </li>
                <li class="<?= $request->uri->getSegment(2) === "user" ? 'active' : ''; ?>">
                    <a href="<?php echo base_url('wbpanel/user'); ?>">
                        <i class="fa fa-user"></i> <span>User</span>
                    </a>
                </li>
                <li class="treeview <?= $request->uri->getSegment(2) === "setting" ? 'active' : ''; ?>">
                    <a href="#">
                        <i class="fa fa-gear"></i>
                        <span>Setting</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="<?= ($request->uri->getTotalSegments() >= 3 && $request->uri->getSegment(3) === "sosial_media") ? 'active' : ''; ?>"><a href="<?php echo base_url('wbpanel/setting/sosial_media'); ?>"><i class="fa fa-globe"></i> Sosial Media</a></li>

                        <li class="<?= ($request->uri->getTotalSegments() >= 3 && $request->uri->getSegment(3) === "judul") ? 'active' : ''; ?>"><a href="<?php echo base_url('wbpanel/setting/judul'); ?>"><i class="fa fa-text-height"></i> Judul Website</a></li>

                        <li class="<?= ($request->uri->getTotalSegments() >= 3 && $request->uri->getSegment(3) === "banner") ? 'active' : ''; ?>"><a href="<?php echo base_url('wbpanel/setting/banner'); ?>"><i class="fa fa-picture-o"></i> Banner</a></li>

                        <li class="<?= ($request->uri->getTotalSegments() >= 3 && $request->uri->getSegment(3) === "logo") ? 'active' : ''; ?>"><a href="<?php echo base_url('wbpanel/setting/logo'); ?>"><i class="fa fa-circle-o"></i> Logo</a></li>

                        <li class="<?= ($request->uri->getTotalSegments() >= 3 && $request->uri->getSegment(3) === "status_mahasiswa") ? 'active' : ''; ?>"><a href="<?php echo base_url('wbpanel/setting/status_mahasiswa'); ?>"><i class="fa fa-users"></i> Status Mahasiswa</a></li>

                        <li class="<?= ($request->uri->getTotalSegments() >= 3 && $request->uri->getSegment(3) === "kalender_akademik") ? 'active' : ''; ?>"><a href="<?php echo base_url('wbpanel/setting/kalender_akademik'); ?>"><i class="fa fa-calendar"></i> Kalender Akademik</a></li>

                        <li class="<?= ($request->uri->getTotalSegments() >= 3 && $request->uri->getSegment(3) === "embedded_youtube") ? 'active' : ''; ?>"><a href="<?php echo base_url('wbpanel/setting/embedded_youtube'); ?>"><i class="fa fa-youtube-play"></i> Embedded Youtube</a></li>

                        <li class="<?= ($request->uri->getTotalSegments() >= 3 && $request->uri->getSegment(3) === "footer_kontak") ? 'active' : ''; ?>"><a href="<?php echo base_url('wbpanel/setting/footer_kontak'); ?>"><i class="fa fa-address-book-o"></i> Footer Kontak</a></li>

                        <li class="<?= ($request->uri->getTotalSegments() >= 3 && $request->uri->getSegment(3) === "footer_link") ? 'active' : ''; ?>"><a href="<?php echo base_url('wbpanel/setting/footer_link'); ?>"><i class="fa fa-link"></i> Footer Link</a></li>

                        <li class="<?= ($request->uri->getTotalSegments() >= 3 && $request->uri->getSegment(3) === "footer_image") ? 'active' : ''; ?>"><a href="<?php echo base_url('wbpanel/setting/footer_image'); ?>"><i class="fa fa-file-image-o"></i> Footer Image</a></li>

                        <li class="<?= ($request->uri->getTotalSegments() >= 3 && $request->uri->getSegment(3) === "footer_alamat") ? 'active' : ''; ?>"><a href="<?php echo base_url('wbpanel/setting/footer_alamat'); ?>"><i class="fa fa-map-marker"></i> Footer Alamat</a></li>

                        <li class="<?= ($request->uri->getTotalSegments() >= 3 && $request->uri->getSegment(3) === "tabel") ? 'active' : ''; ?>"><a href="<?php echo base_url('wbpanel/setting/tabel'); ?>"><i class="fa fa-table"></i> Tabel</a></li>

                        <li class="<?= ($request->uri->getTotalSegments() >= 3 && $request->uri->getSegment(3) === "card") ? 'active' : ''; ?>"><a href="<?php echo base_url('wbpanel/setting/card'); ?>"><i class="fa fa-flag-o"></i> Card</a></li>

                        <li class="<?= ($request->uri->getTotalSegments() >= 3 && $request->uri->getSegment(3) === "card_link") ? 'active' : ''; ?>"><a href="<?php echo base_url('wbpanel/setting/card_link'); ?>"><i class="fa fa-pencil-square-o"></i> Card Link</a></li>

                        <li class="<?= ($request->uri->getTotalSegments() >= 3 && $request->uri->getSegment(3) === "seo") ? 'active' : ''; ?>"><a href="<?php echo base_url('wbpanel/setting/seo'); ?>"><i class="fa fa-search"></i> Seo</a></li>

                        <li class="<?= ($request->uri->getTotalSegments() >= 3 && $request->uri->getSegment(3) === "access_token") ? 'active' : ''; ?>"><a href="<?php echo base_url('wbpanel/setting/access_token'); ?>"><i class="fa fa-shield"></i> Access Token</a></li>
                    </ul>
                </li>
            <?php endif; ?>

        </ul>
    </section>
</aside>