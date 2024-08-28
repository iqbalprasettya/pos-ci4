<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/login', 'Auth::index');
$routes->post('/login', 'Auth::login');
$routes->get('/logout', 'Auth::logout');

// Produk
$routes->get('/product', 'Product::index');
$routes->post('/product/addCategory', 'Product::addCategory');
$routes->post('/product/updateCategory/(:num)', 'Product::updateCategory/$1');
$routes->get('/product/deleteCategory/(:num)', 'Product::deleteCategory/$1');
$routes->post('/product/addProduct', 'Product::addProduct');
$routes->post('/product/updateProduct/(:num)', 'Product::updateProduct/$1');
$routes->get('/product/deleteProduct/(:num)', 'Product::deleteProduct/$1');

// Transaksi
$routes->get('/transaction', 'Transaction::index');

// Route untuk produk ke keranjang
$routes->post('add-to-cart', 'Home::addToCart');
$routes->post('update-cart-quantity', 'Home::updateCartQuantity');
$routes->post('remove-from-cart', 'Home::removeFromCart');

// Route untuk checkout
$routes->post('checkout', 'Home::checkout');

// Route untuk detail transaksi
$routes->get('transaction-details/(:num)', 'Home::getTransactionDetails/$1');

// profile
$routes->get('/profile', 'User::index');
$routes->post('/profile/update', 'User::update');
$routes->get('/profile/delete-avatar', 'User::deleteAvatar');

// settings
$routes->get('settings', 'Settings::index');
$routes->post('settings/update', 'Settings::update');

// report
$routes->get('report', 'Report::index');
$routes->get('report/exportExcel', 'Report::exportExcel');
$routes->get('report/getFilteredData', 'Report::getFilteredData');

// Branch
$routes->get('/branch', 'Branch::index');
$routes->post('/branch/add', 'Branch::add');
$routes->get('/branch/delete/(:num)', 'Branch::delete/$1');
$routes->post('/branch/edit/(:num)', 'Branch::edit/$1');

// Karyawan
$routes->post('/branch/addEmployee', 'Branch::addEmployee');
$routes->post('/branch/editEmployee/(:num)', 'Branch::editEmployee/$1');
$routes->get('/branch/deleteEmployee/(:num)', 'Branch::deleteEmployee/$1');