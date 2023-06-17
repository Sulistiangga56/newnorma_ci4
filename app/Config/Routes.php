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
$routes->get('/', 'Home::index');
$routes->get('/panduan', 'Home::panduan');
$routes->get('/produk', 'Home::produk');
$routes->get('/about', 'About::index');
$routes->get('/detail/(:any)', 'Home::detail/$1');

$routes->get('/keranjang', 'Keranjang::index', ['filter' => 'customer']);
$routes->get('keranjang/(:any)', 'Keranjang::tambahproduk/$1', ['filter' => 'customer']);
$routes->post('/keranjang', 'Keranjang::tambahKeKeranjang', ['filter' => 'customer']);
$routes->delete('/keranjang/delete/(:any)', 'Keranjang::hapusKeranjang/$1', ['filter' => 'customer']);
$routes->post('/keranjang/(:any)/edit', 'Keranjang::edit/$1', ['filter' => 'customer']);

$routes->get('/checkout', 'Keranjang::checkout', ['filter' => 'customer']);
$routes->post('/checkout', 'Keranjang::doCheckout', ['filter' => 'customer']);

$routes->get('/register', 'Auth::register');
$routes->post('/register', 'Auth::doRegister');
$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::doLoginCustomer');
$routes->get('/logout', 'Auth::logout');

// create route group for admin
$routes->group('admin' , static function($routes){
    $routes->get('login', 'Admin::login');
    $routes->post('login', 'Admin::doLogin');
});

$routes->group('admin',['filter'=> 'admin'] , static function($routes){
    $routes->get('backup', 'Database::backup');

    $routes->get('logout', 'Admin::logout');
    $routes->get('', 'Admin::index');

    $routes->get('produksi', 'Produksi::index');
    $routes->get('produksi/(:any)/tolak', 'Produksi::tolak/$1');
    $routes->get('produksi/(:any)/terima', 'Produksi::terima/$1');
    $routes->get('produksi/(:any)', 'Produksi::detail/$1');

    $routes->get('produk', 'Produk::index');
    $routes->get('produk/tambah', 'Produk::tambah');
    $routes->post('produk/tambah', 'Produk::simpan');
    $routes->get('produk/(:any)/edit', 'Produk::edit/$1');
    $routes->post('produk/(:any)/edit', 'Produk::doEdit/$1');
    $routes->delete('produk/(:any)/delete', 'Produk::hapus/$1');

    $routes->get('customer', 'Customer::index');
    $routes->delete('customer/(:any)/delete', 'Customer::hapus/$1');
    
    $routes->get('kebutuhan/(:any)', 'Kebutuhan::index/$1');

    $routes->get('inventory', 'Inventory::index');
    $routes->get('inventory/tambah', 'Inventory::tambah');
    $routes->post('inventory/tambah', 'Inventory::simpan');
    $routes->get('inventory/(:any)/edit', 'Inventory::edit/$1');
    $routes->post('inventory/(:any)/edit', 'Inventory::update/$1');
    $routes->delete('inventory/(:any)/delete', 'Inventory::hapus/$1');

    // add nested route for laporan/penjualan, laporan/produksi, laporan/inventory
    $routes->group('laporan', static function($routes){
        $routes->get('penjualan', 'Laporan::penjualan');
        $routes->post('penjualan', 'Laporan::penjualan');
        $routes->post('penjualan/export', 'Laporan::exp_penjualan');

        $routes->get('omset', 'Laporan::omset');
        $routes->post('omset', 'Laporan::omset');
        $routes->post('omset/export', 'Laporan::exp_omset');

        $routes->get('pembatalan', 'Laporan::pembatalan');
        $routes->post('pembatalan', 'Laporan::pembatalan');
        $routes->post('pembatalan/export', 'Laporan::exp_pembatalan');

        $routes->get('profit', 'Laporan::profit');
        $routes->post('profit', 'Laporan::profit');
        $routes->post('profit/export', 'Laporan::exp_profit');

        $routes->get('produksi', 'Laporan::produksi');
        $routes->post('produksi', 'Laporan::produksi');
        $routes->post('produksi/export', 'Laporan::exp_produksi');

        $routes->get('inventory', 'Laporan::inventory');
        $routes->post('inventory', 'Laporan::inventory');
        $routes->post('inventory/export', 'Laporan::exp_inventory');
    });
});

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
