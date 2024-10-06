<?php

// use CodeIgniter\Router\RouteCollection;

$routes->get('/', 'Home::index');

$routes->get('media/(:segment)', '\App\Controllers\Back\MediaAccess::viewMedia/$1', ['filter' => ['isLoggedIn']]);
$routes->group('wbpanel', ['namespace' => 'App\Controllers\Back'], static function ($routes) {

    $routes->get('logout', 'Auth::logout');
    $routes->get('login', 'Auth::login');
    $routes->post('login-do', 'Auth::doLogin');

    $routes->group('/', ['filter' => ['isLoggedIn'], 'namespace'=> 'App\Controllers\Back'], static function ($routes){
        $routes->get('/','Dashboard::index');

        $routes->group('media', static function ($routes) {
            $routes->get('/', 'Media::index');
            $routes->post('list', 'Media::list');
            $routes->post('form', 'Media::form');
            $routes->post('save', 'Media::save');
            $routes->post('delete', 'Media::delete');
        });
        
        $routes->group('kerjasama', ['filter'=> ['featKerjasama'], 'namespace'=> 'App\Controllers\Back'], static function($routes){
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

        $routes->group('kegiatan', ['filter'=> ['featKegiatan'], 'namespace'=> 'App\Controllers\Back'], static function($routes){
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

        $routes->group('kepanitiaan', ['filter'=> ['featKepanitiaan'], 'namespace'=> 'App\Controllers\Back'], static function($routes){
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

        $routes->group('pengajaran-dosen', ['filter'=> ['featPengajaran'], 'namespace'=> 'App\Controllers\Back'], static function($routes){
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

        $routes->group('penelitian', ['filter'=> ['featPenelitian'], 'namespace'=> 'App\Controllers\Back'], static function($routes){
            $routes->get('/', 'Penelitian::index');
            $routes->post('datatable', 'Penelitian::getDatatable');
            $routes->post('list', 'Penelitian::list');
            $routes->post('info', 'Penelitian::detail');
            $routes->post('form', 'Penelitian::form');
            $routes->post('save', 'Penelitian::save');
            $routes->post('delete', 'Penelitian::delete');
        });

        $routes->group('pengabdian', ['filter'=> ['featPengabdian'], 'namespace'=> 'App\Controllers\Back'], static function($routes){
            $routes->get('/', 'Pengabdian::index');
            $routes->post('datatable', 'Pengabdian::getDatatable');
            $routes->post('list', 'Pengabdian::list');
            $routes->post('info', 'Pengabdian::detail');
            $routes->post('form', 'Pengabdian::form');
            $routes->post('save', 'Pengabdian::save');
            $routes->post('delete', 'Pengabdian::delete');
        });
    });
});
