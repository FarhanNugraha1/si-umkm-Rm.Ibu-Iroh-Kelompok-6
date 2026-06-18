<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Frontend katalog
$routes->get('/', 'Home::index');
$routes->get('profil', 'Home::profile');
$routes->get('tentang-kami', 'Home::profile');
$routes->get('menu', 'Home::menu');
$routes->get('kontak', 'Home::contact');

// Auth admin
$routes->get('login', 'Auth::login', ['filter' => 'guest']);
$routes->post('auth/login_process', 'Auth::login_process', ['filter' => 'guest']);
$routes->get('logout', 'Auth::logout', ['filter' => 'auth']);

// Dashboard admin
$routes->group('dashboard', ['filter' => 'admin'], static function ($routes) {
    $routes->get('/', 'Dashboard::index');

    $routes->get('menus', 'Dashboard::menus');
    $routes->get('menus/create', 'Dashboard::createMenu');
    $routes->post('menus/store', 'Dashboard::storeMenu');
    $routes->get('menus/edit/(:num)', 'Dashboard::editMenu/$1');
    $routes->post('menus/update/(:num)', 'Dashboard::updateMenu/$1');
    $routes->post('menus/delete/(:num)', 'Dashboard::deleteMenu/$1');

    $routes->get('profile', 'Dashboard::adminProfile');
    $routes->post('profile/update', 'Dashboard::updateAdminProfile');

    $routes->get('company-profile', 'Dashboard::companyProfile');
    $routes->post('company-profile/update', 'Dashboard::updateCompanyProfile');

    $routes->get('contact-settings', 'Dashboard::contactSettings');
    $routes->post('contact-settings/update', 'Dashboard::updateContactSettings');

    // Compatibility route lama CRUD menu
    $routes->post('store', 'Dashboard::storeMenu');
    $routes->post('update/(:num)', 'Dashboard::updateMenu/$1');
    $routes->get('delete/(:num)', 'Dashboard::deleteMenu/$1');
});

// Alias admin lama/yang lebih jelas
$routes->group('admin', ['filter' => 'admin'], static function ($routes) {
    $routes->get('/', 'Dashboard::index');
    $routes->get('dashboard', 'Dashboard::index');

    $routes->get('menu', 'Dashboard::menus');
    $routes->get('menu/tambah', 'Dashboard::createMenu');
    $routes->post('menu/simpan', 'Dashboard::storeMenu');
    $routes->get('menu/edit/(:num)', 'Dashboard::editMenu/$1');
    $routes->post('menu/update/(:num)', 'Dashboard::updateMenu/$1');
    $routes->post('menu/delete/(:num)', 'Dashboard::deleteMenu/$1');

    $routes->get('profil', 'Dashboard::adminProfile');
    $routes->post('profil/update', 'Dashboard::updateAdminProfile');
    $routes->get('profil-perusahaan', 'Dashboard::companyProfile');
    $routes->post('profil-perusahaan/update', 'Dashboard::updateCompanyProfile');
    $routes->get('kontak', 'Dashboard::contactSettings');
    $routes->post('kontak/update', 'Dashboard::updateContactSettings');
});
