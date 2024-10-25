<?php

// use CodeIgniter\Router\RouteCollection;

$routes->get('/', 'Home::index');

$routes->get('media/(:segment)', '\App\Controllers\Back\MediaAccess::viewMedia/$1', ['filter' => ['isLoggedIn']]);
$routes->group('wbpanel', ['namespace' => 'App\Controllers\Back'], static function ($routes) {

    $routes->get('logout', 'Auth::logout');
    $routes->get('login', 'Auth::login');
    $routes->post('login-do', 'Auth::doLogin');

    $routes->group('/', ['filter' => ['isLoggedIn'], 'namespace' => 'App\Controllers\Back'], static function ($routes) {
        $routes->get('/', 'Dashboard::index');

        $routes->group('media', ['filter' => ['featMedia'], 'namespace' => 'App\Controllers\Back'], static function ($routes) {
            $routes->get('/', 'Media::index');
            $routes->post('list', 'Media::list');
            $routes->post('form', 'Media::form');
            $routes->post('save', 'Media::save');
            $routes->post('delete', 'Media::delete');
        });

        $routes->group('kerjasama', ['filter' => ['featKerjasama'], 'namespace' => 'App\Controllers\Back'], static function ($routes) {
            $routes->get('/', 'Kerjasama::index');
            $routes->post('datatable', 'Kerjasama::getDatatable');
            $routes->post('list', 'Kerjasama::list');
            $routes->post('media', 'Media::getMedia');
            $routes->post('detail', 'Media::getDetailMedia');
            $routes->post('info', 'Kerjasama::detail');
            $routes->post('form', 'Kerjasama::form');
            $routes->post('save', 'Kerjasama::save');
            $routes->post('delete', 'Kerjasama::delete');
        });

        $routes->group('surat-keputusan', ['filter' => ['featSK'], 'namespace' => 'App\Controllers\Back'], static function ($routes) {
            $routes->get('/', 'SuratKeputusan::index');
            $routes->post('datatable', 'SuratKeputusan::getDatatable');
            $routes->post('list', 'SuratKeputusan::list');
            $routes->post('media', 'Media::getMedia');
            $routes->post('detail', 'Media::getDetailMedia');
            $routes->post('info', 'SuratKeputusan::detail');
            $routes->post('form', 'SuratKeputusan::form');
            $routes->post('save', 'SuratKeputusan::save');
            $routes->post('delete', 'SuratKeputusan::delete');
        });

        $routes->group('sop', ['filter' => ['featSOP'], 'namespace' => 'App\Controllers\Back'], static function ($routes) {
            $routes->get('/', 'SOP::index');
            $routes->post('datatable', 'SOP::getDatatable');
            $routes->post('list', 'SOP::list');
            $routes->post('media', 'Media::getMedia');
            $routes->post('detail', 'Media::getDetailMedia');
            $routes->post('info', 'SOP::detail');
            $routes->post('form', 'SOP::form');
            $routes->post('save', 'SOP::save');
            $routes->post('delete', 'SOP::delete');
        });

        $routes->group('renstra', ['filter' => ['featRenstra'], 'namespace' => 'App\Controllers\Back'], static function ($routes) {
            $routes->get('/', 'Renstra::index');
            $routes->post('datatable', 'Renstra::getDatatable');
            $routes->post('list', 'Renstra::list');
            $routes->post('media', 'Media::getMedia');
            $routes->post('detail', 'Media::getDetailMedia');
            $routes->post('info', 'Renstra::detail');
            $routes->post('form', 'Renstra::form');
            $routes->post('save', 'Renstra::save');
            $routes->post('delete', 'Renstra::delete');
        });

        $routes->group('anggaran', ['filter' => ['featAnggaran'], 'namespace' => 'App\Controllers\Back'], static function ($routes) {
            $routes->get('/', 'Anggaran::index');
            $routes->post('datatable', 'Anggaran::getDatatable');
            $routes->post('list', 'Anggaran::list');
            $routes->post('media', 'Media::getMedia');
            $routes->post('detail', 'Media::getDetailMedia');
            $routes->post('info', 'Anggaran::detail');
            $routes->post('form', 'Anggaran::form');
            $routes->post('save', 'Anggaran::save');
            $routes->post('delete', 'Anggaran::delete');
        });

        $routes->group('surat-tugas', ['filter' => ['featST'], 'namespace' => 'App\Controllers\Back'], static function ($routes) {
            $routes->get('/', 'SuratTugas::index');
            $routes->post('datatable', 'SuratTugas::getDatatable');
            $routes->post('list', 'SuratTugas::list');
            $routes->post('media', 'Media::getMedia');
            $routes->post('detail', 'Media::getDetailMedia');
            $routes->post('info', 'SuratTugas::detail');
            $routes->post('form', 'SuratTugas::form');
            $routes->post('save', 'SuratTugas::save');
            $routes->post('delete', 'SuratTugas::delete');
        });

        $routes->group('kegiatan', ['filter' => ['featKegiatan'], 'namespace' => 'App\Controllers\Back'], static function ($routes) {
            $routes->get('/', 'Kegiatan::index');
            $routes->post('datatable', 'Kegiatan::getDatatable');
            $routes->post('list', 'Kegiatan::list');
            $routes->post('media', 'Media::getMedia');
            $routes->post('detail', 'Media::getDetailMedia');
            $routes->post('info', 'Kegiatan::detail');
            $routes->post('form', 'Kegiatan::form');
            $routes->post('save', 'Kegiatan::save');
            $routes->post('delete', 'Kegiatan::delete');
        });

        $routes->group('kegiatan-dosen', ['filter' => ['featPengajaran'], 'namespace' => 'App\Controllers\Back'], static function ($routes) {
            $routes->get('(:segment)', 'Kegiatan::index/$1');
            $routes->post('datatable/(:segment)', 'Kegiatan::getDatatable/$1');
            $routes->post('list/(:segment)', 'Kegiatan::list/$1');
            $routes->post('media', 'Media::getMedia');
            $routes->post('detail', 'Media::getDetailMedia');
            $routes->post('info/(:segment)', 'Kegiatan::detail/$1');
            $routes->post('form/(:segment)', 'Kegiatan::form/$1');
            $routes->post('save/(:segment)', 'Kegiatan::save/$1');
            $routes->post('delete/(:segment)', 'Kegiatan::delete/$1');
        });

        $routes->group('kepanitiaan', ['filter' => ['featKepanitiaan'], 'namespace' => 'App\Controllers\Back'], static function ($routes) {
            $routes->get('/', 'Kepanitiaan::index');
            $routes->post('datatable', 'Kepanitiaan::getDatatable');
            $routes->post('list', 'Kepanitiaan::list');
            $routes->post('media', 'Media::getMedia');
            $routes->post('detail', 'Media::getDetailMedia');
            $routes->post('info', 'Kepanitiaan::detail');
            $routes->post('form', 'Kepanitiaan::form');
            $routes->post('save', 'Kepanitiaan::save');
            $routes->post('delete', 'Kepanitiaan::delete');
        });

        $routes->group('pengajaran-dosen', ['filter' => ['featPengajaran'], 'namespace' => 'App\Controllers\Back'], static function ($routes) {
            $routes->get('/', 'Pengajaran::index');
            $routes->post('datatable', 'Pengajaran::getDatatable');
            $routes->post('list', 'Pengajaran::list');
            $routes->post('media', 'Media::getMedia');
            $routes->post('detail', 'Media::getDetailMedia');
            $routes->post('info', 'Pengajaran::detail');
            $routes->post('form', 'Pengajaran::form');
            $routes->post('save', 'Pengajaran::save');
            $routes->post('delete', 'Pengajaran::delete');
        });

        $routes->group('sertifikat', ['filter' => ['featSertifikat'], 'namespace' => 'App\Controllers\Back'], static function ($routes) {
            $routes->get('/', 'Sertifikat::index');
            $routes->post('datatable', 'Sertifikat::getDatatable');
            $routes->post('list', 'Sertifikat::list');
            $routes->post('media', 'Media::getMedia');
            $routes->post('detail', 'Media::getDetailMedia');
            $routes->post('info', 'Sertifikat::detail');
            $routes->post('form', 'Sertifikat::form');
            $routes->post('save', 'Sertifikat::save');
            $routes->post('delete', 'Sertifikat::delete');
        });

        $routes->group('lama-studi', ['filter' => ['featLamaStudi'], 'namespace' => 'App\Controllers\Back'], static function ($routes) {
            $routes->get('/', 'LamaStudi::index');
            $routes->post('datatable', 'LamaStudi::getDatatable');
            $routes->post('list', 'LamaStudi::list');
            $routes->post('media', 'Media::getMedia');
            $routes->post('detail', 'Media::getDetailMedia');
            $routes->post('info', 'LamaStudi::detail');
            $routes->post('form', 'LamaStudi::form');
            $routes->post('save', 'LamaStudi::save');
            $routes->post('delete', 'LamaStudi::delete');
        });

        $routes->group('haki', ['filter' => ['featHaki'], 'namespace' => 'App\Controllers\Back'], static function ($routes) {
            $routes->get('/', 'Haki::index');
            $routes->post('datatable', 'Haki::getDatatable');
            $routes->post('list', 'Haki::list');
            $routes->post('media', 'Media::getMedia');
            $routes->post('detail', 'Media::getDetailMedia');
            $routes->post('info', 'Haki::detail');
            $routes->post('form', 'Haki::form');
            $routes->post('save', 'Haki::save');
            $routes->post('delete', 'Haki::delete');
        });

        $routes->group('aktivitas', ['filter' => ['featMahasiswa'], 'namespace' => 'App\Controllers\Back'], static function ($routes) {
            $routes->get('/', 'Aktivitas::index');
            $routes->post('datatable', 'Aktivitas::getDatatable');
            $routes->post('list', 'Aktivitas::list');
            $routes->post('media', 'Media::getMedia');
            $routes->post('detail', 'Media::getDetailMedia');
            $routes->post('info', 'Aktivitas::detail');
            $routes->post('form', 'Aktivitas::form');
            $routes->post('save', 'Aktivitas::save');
            $routes->post('delete', 'Aktivitas::delete');
        });

        $routes->group('prestasi', ['filter' => ['featMahasiswa'], 'namespace' => 'App\Controllers\Back'], static function ($routes) {
            $routes->get('/', 'Prestasi::index');
            $routes->post('datatable', 'Prestasi::getDatatable');
            $routes->post('list', 'Prestasi::list');
            $routes->post('media', 'Media::getMedia');
            $routes->post('detail', 'Media::getDetailMedia');
            $routes->post('info', 'Prestasi::detail');
            $routes->post('form', 'Prestasi::form');
            $routes->post('save', 'Prestasi::save');
            $routes->post('delete', 'Prestasi::delete');
        });

        $routes->group('penelitian', ['filter' => ['featPenelitian'], 'namespace' => 'App\Controllers\Back'], static function ($routes) {
            $routes->get('/', 'Penelitian::index');
            $routes->post('datatable', 'Penelitian::getDatatable');
            $routes->post('list', 'Penelitian::list');
            $routes->post('info', 'Penelitian::detail');
            $routes->post('form', 'Penelitian::form');
            $routes->post('save', 'Penelitian::save');
            $routes->post('delete', 'Penelitian::delete');
        });

        $routes->group('pengabdian', ['filter' => ['featPengabdian'], 'namespace' => 'App\Controllers\Back'], static function ($routes) {
            $routes->get('/', 'Pengabdian::index');
            $routes->post('datatable', 'Pengabdian::getDatatable');
            $routes->post('list', 'Pengabdian::list');
            $routes->post('info', 'Pengabdian::detail');
            $routes->post('form', 'Pengabdian::form');
            $routes->post('save', 'Pengabdian::save');
            $routes->post('delete', 'Pengabdian::delete');
        });

        $routes->group('check-dekan', ['filter' => ['taskforceOnly'], 'namespace' => 'App\Controllers\Back'], static function ($routes) {
            $routes->get('/', 'Taskforce::dekan');
            $routes->post('datatable', 'Taskforce::getDataTableDekan');
            $routes->post('dekan-list', 'Taskforce::dekanList');
            $routes->post('datatable/(:segment)', 'Taskforce::getDataTableFiturDekan/$1');
            $routes->post('kerjasama/list', 'Kerjasama::list');
            $routes->post('kerjasama/info', 'Kerjasama::detail');
            $routes->post('surat-keputusan/list', 'SuratKeputusan::list');
            $routes->post('surat-keputusan/info', 'SuratKeputusan::detail');
            $routes->post('surat-tugas/list', 'SuratTugas::list');
            $routes->post('surat-tugas/info', 'SuratTugas::detail');
            $routes->post('kegiatan/list', 'Kegiatan::list');
            $routes->post('kegiatan/info', 'Kegiatan::detail');
        });

        $routes->group('check-kajur', ['filter' => ['taskforceOnly'], 'namespace' => 'App\Controllers\Back'], static function ($routes) {
            $routes->get('/', 'Taskforce::kajur');
            $routes->post('datatable', 'Taskforce::getDataTableKajur');
            $routes->post('kajur-list', 'Taskforce::kajurList');
            $routes->post('datatable/(:segment)', 'Taskforce::getDataTableFiturKajur/$1');
            $routes->post('surat-tugas/list', 'SuratTugas::list');
            $routes->post('surat-tugas/info', 'SuratTugas::detail');
            $routes->post('kegiatan/list', 'Kegiatan::list');
            $routes->post('kegiatan/info', 'Kegiatan::detail');
        });

        $routes->group('check-koor', ['filter' => ['taskforceOnly'], 'namespace' => 'App\Controllers\Back'], static function ($routes) {
            $routes->get('/', 'Taskforce::koor');
            $routes->post('datatable', 'Taskforce::getDataTableKoor');
            $routes->post('koor-list', 'Taskforce::koorList');
            $routes->post('datatable/(:segment)', 'Taskforce::getDataTableFiturKoor/$1');
            $routes->post('kerjasama/list', 'Kerjasama::list');
            $routes->post('kerjasama/info', 'Kerjasama::detail');
            $routes->post('kegiatan/list', 'Kegiatan::list');
            $routes->post('kegiatan/info', 'Kegiatan::detail');
        });

        $routes->group('check-dosen', ['filter' => ['taskforceOnly'], 'namespace' => 'App\Controllers\Back'], static function ($routes) {
            $routes->get('/', 'Taskforce::dosen');
            $routes->post('datatable', 'Taskforce::getDataTableDosen');
            $routes->post('dosen-list', 'Taskforce::dosenList');
            $routes->post('datatable/(:segment)', 'Taskforce::getDataTableFiturDosen/$1');
            $routes->post('pengajaran-dosen/list', 'Pengajaran::list');
            $routes->post('pengajaran-dosen/info', 'Pengajaran::detail');
            $routes->post('penelitian/list', 'Penelitian::list');
            $routes->post('penelitian/info', 'Penelitian::detail');
            $routes->post('pengabdian/list', 'Pengabdian::list');
            $routes->post('pengabdian/info', 'Pengabdian::detail');
            $routes->post('sertifikat/list', 'Sertifikat::list');
            $routes->post('sertifikat/info', 'Sertifikat::detail');
            $routes->post('haki/list', 'Haki::list');
            $routes->post('haki/info', 'Haki::detail');
            $routes->post('kepanitiaan/list', 'Kepanitiaan::list');
            $routes->post('kepanitiaan/info', 'Kepanitiaan::detail');
            $routes->post('kegiatan/list/(:segment)', 'Kegiatan::list/$1');
            $routes->post('kegiatan/info/(:segment)', 'Kegiatan::detail/$1');
        });

        $routes->group('check-mahasiswa', ['filter' => ['taskforceOnly'], 'namespace' => 'App\Controllers\Back'], static function ($routes) {
            $routes->get('/', 'Taskforce::mahasiswa');
            $routes->post('datatable', 'Taskforce::getDataTableMahasiswa');
            $routes->post('mahasiswa-list', 'Taskforce::mahasiswaList');
            $routes->post('datatable/(:segment)', 'Taskforce::getDataTableFiturMahasiswa/$1');
            $routes->post('aktivitas/list', 'Aktivitas::list');
            $routes->post('aktivitas/info', 'Aktivitas::detail');
            $routes->post('penelitian/list', 'Penelitian::list');
            $routes->post('penelitian/info', 'Penelitian::detail');
            $routes->post('pengabdian/list', 'Pengabdian::list');
            $routes->post('pengabdian/info', 'Pengabdian::detail');
            $routes->post('prestasi/list', 'Prestasi::list');
            $routes->post('prestasi/info', 'Prestasi::detail');
            $routes->post('kepanitiaan/list', 'Kepanitiaan::list');
            $routes->post('kepanitiaan/info', 'Kepanitiaan::detail');
        });

        $routes->group('check-alumni', ['filter' => ['taskforceOnly'], 'namespace' => 'App\Controllers\Back'], static function ($routes) {
            $routes->get('/', 'Taskforce::alumni');
            $routes->post('datatable', 'Taskforce::getDataTableAlumni');
            $routes->post('alumni-list', 'Taskforce::alumniList');
            $routes->post('form', 'Taskforce::surveyFormAlumni');
        });

        $routes->group('survey', ['filter' => ['featSurvey'], 'namespace' => 'App\Controllers\Back'], static function ($routes) {
            $routes->get('/', 'Survey::index');
            $routes->post('save', 'Survey::save');
        });

        $routes->get('profile', 'UserController::profile');

        $routes->group('user', static function ($routes) {
            $routes->get('/', 'UserController::index', ['filter' => 'featUserControl']);
            $routes->post('list', 'UserController::list', ['filter' => 'featUserControl']);
            $routes->post('form', 'UserController::form', ['filter' => 'featUserControl']);
            $routes->post('save', 'UserController::save', ['filter' => 'featUserControl']);
            $routes->post('delete', 'UserController::delete', ['filter' => 'featUserControl']);
        });
    });
});
