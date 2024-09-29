<?php

// use CodeIgniter\Router\RouteCollection;

$routes->get('/', 'Home::index');

$routes->group('apppanel', ['namespace' => 'App\Controllers\Back'], static function ($routes) {

    $routes->get('logout', 'Auth::logout');
    $routes->get('login', 'Auth::login');
    $routes->post('login-do', 'Auth::doLogin');

    $routes->group('/', ['filter' => ['isLoggedIn'], 'namespace'=> 'App\Controllers\Back'], static function ($routes){
        $routes->get('/','Dashboard::index');
    });
});
