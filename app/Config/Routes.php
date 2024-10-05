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
    });
});
