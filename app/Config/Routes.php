<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');

// Auth routes
$routes->get('login', 'Auth::login', ['filter' => 'guest']);
$routes->post('auth/login_process', 'Auth::login_process', ['filter' => 'guest']);
$routes->get('register', 'Auth::register', ['filter' => 'guest']);
$routes->post('auth/register_process', 'Auth::register_process', ['filter' => 'guest']);
$routes->get('logout', 'Auth::logout', ['filter' => 'auth']);

// Customer routes
$routes->get('order', 'Home::order', ['filter' => 'customer']);
$routes->post('order/store', 'Home::saveOrder', ['filter' => 'customer']);
$routes->get('my-orders', 'Home::myOrders', ['filter' => 'customer']);

// Admin dashboard routes
$routes->group('dashboard', ['filter' => 'admin'], static function ($routes) {
    $routes->get('/', 'Dashboard::index');
    $routes->get('menus', 'Dashboard::menus');
    $routes->get('menus/create', 'Dashboard::createMenu');
    $routes->post('menus/store', 'Dashboard::storeMenu');
    $routes->get('menus/edit/(:num)', 'Dashboard::editMenu/$1');
    $routes->post('menus/update/(:num)', 'Dashboard::updateMenu/$1');
    $routes->post('menus/delete/(:num)', 'Dashboard::deleteMenu/$1');
    $routes->get('orders', 'Dashboard::orders');
    $routes->post('orders/update-status/(:num)', 'Dashboard::updateOrderStatus/$1');
    $routes->get('customers', 'Dashboard::customers');

    // Compatibility dengan route lama lu
    $routes->post('store', 'Dashboard::storeMenu');
    $routes->post('update/(:num)', 'Dashboard::updateMenu/$1');
    $routes->get('delete/(:num)', 'Dashboard::deleteMenu/$1');
});

// Alias admin route lama/yang lebih jelas
$routes->group('admin', ['filter' => 'admin'], static function ($routes) {
    $routes->get('/', 'Dashboard::index');
    $routes->get('dashboard', 'Dashboard::index');
    $routes->get('menu', 'Dashboard::menus');
    $routes->get('menu/tambah', 'Dashboard::createMenu');
    $routes->post('menu/simpan', 'Dashboard::storeMenu');
    $routes->get('menu/edit/(:num)', 'Dashboard::editMenu/$1');
    $routes->post('menu/update/(:num)', 'Dashboard::updateMenu/$1');
    $routes->post('menu/delete/(:num)', 'Dashboard::deleteMenu/$1');
    $routes->get('pesanan', 'Dashboard::orders');
    $routes->get('pengguna', 'Dashboard::customers');
});
