<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
// $routes->get('/coba', 'Home::coba');
// $routes->get('/coba', 'Coba::index');
// // $routes->get('/coba', function(){
//     // echo 'hello world';
// // });
// $routes->get('/coba/about', 'Coba::about');
// $routes->get('/coba/(:any)/(:num)', 'Coba::about/$1/$2');

// $routes->get('/users', 'Admin\Users::index');

$routes->get('/coba', 'Coba::index');
$routes->get('/coba/about', 'Coba::about');
$routes->get('/users', 'Admin\Users::index');
$routes->get('/users', 'Admin\Users::index');

$routes->get('/pages', 'Pages::index');
$routes->get('/pages/about', 'Pages::about');
$routes->get('/pages/contact', 'Pages::contact');
$routes->get('/komik', 'Komik::index');
$routes->get('/komik/create', 'Komik::create');
$routes->post('/komik/save', 'Komik::save');
$routes->get('/komik/edit/(:segment)', 'Komik::edit/$1');
$routes->post('/komik/update/(:num)', 'Komik::update/$1');
// $routes->get('/komik/delete/(:num)', 'Komik::delete/$1');
$routes->delete('/komik/(:num)', 'Komik::delete/$1');
// $routes->get('/komik/(:segment)', 'Komik::detail/$1');
$routes->get('/komik/(:any)', 'Komik::detail/$1');
