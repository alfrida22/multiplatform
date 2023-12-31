<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//  $routes->get('getUsers', 'Daftar::index');
// $routes->match(['post', 'options'], 'api/daftar', 'Daftar::create');
$routes->group('daftar', function (RouteCollection $routes){
    $routes->get('getUsers', 'Daftar::index');
    $routes->post('tambah', 'Daftar::create');
    $routes->put('update/(:num)', 'Daftar::update/$1');
    $routes->delete('delete/(:num)', 'Daftar::delete/$1');
    $routes->post('masuk', 'Daftar::login');
});

// app/Config/Routes.php
$routes->group('article', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('index', 'ArticleController::index');
    $routes->get('(:num)', 'ArticleController::show/$1');
    $routes->post('store', 'ArticleController::store');
    $routes->put('update/(:num)', 'ArticleController::update/$1');
    $routes->delete('delete/(:num)', 'ArticleController::delete/$1');
});

$routes->group('latihan', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('index', 'LatihanController::index');
    $routes->post('create', 'LatihanController::create');
    $routes->get('show/(:num)', 'LatihanController::show/$1');
    $routes->put('update/(:num)', 'LatihanController::update/$1');
    $routes->delete('delete/(:num)', 'LatihanController::delete/$1');
});