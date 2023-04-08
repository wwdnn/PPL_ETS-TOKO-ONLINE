<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'c_Autentikasi::index');
$routes->post('/', 'c_Autentikasi::login');
$routes->get('/logout', 'c_Autentikasi::logout');

$routes->get('/home', 'c_Pegawai::index', ['filter' => 'auth']);
$routes->get('/tambah-barang', 'c_Pegawai::createBarang', ['filter' => 'auth']);

$routes->post('/tambah-barang', 'c_Barang::store', ['filter' => 'auth']);

// $routes->post('/add', 'c_Admin::add');

$routes->get('/dashboard', 'c_Barang::index');
$routes->get('/cart', 'c_Cart::index');
$routes->post('/cart', 'c_Cart::addToCart');

$routes->get('/checkout', 'c_Checkout::index');
$routes->post('/checkout', 'c_Checkout::process');
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
