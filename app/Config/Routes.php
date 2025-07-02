<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Rute Otentikasi
$routes->post('register', 'Auth::register');
$routes->post('login', 'Auth::login');
$routes->get('logout', 'Auth::logout');

// Rute Guest (Akses via PIN)
$routes->post('guest/access', 'Guest::access');
$routes->get('guest/view/(:num)', 'Guest::view/$1');

// Grup Rute yang memerlukan login (dilindungi filter 'auth')
$routes->group('', ['filter' => 'auth'], function ($routes) {
    $routes->get('dashboard', 'Dashboard::index');

    $routes->get('tugas/tambah', 'TugasController::new');
    $routes->post('tugas/create', 'TugasController::create');
    $routes->get('tugas/daftar', 'TugasController::listUnfinished');
    $routes->get('tugas/selesai', 'TugasController::listFinished');
    $routes->get('tugas/edit/(:num)', 'TugasController::edit/$1');
    $routes->post('tugas/update/(:num)', 'TugasController::update/$1');
    $routes->get('tugas/delete/(:num)', 'TugasController::delete/$1');

    $routes->get('tugas/file/(:segment)', 'TugasController::serveFile/$1');
});