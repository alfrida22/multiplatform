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
    
});