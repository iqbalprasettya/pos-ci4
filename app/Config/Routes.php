<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/login', 'Auth::index');
$routes->post('/login', 'Auth::login');
$routes->get('/logout', 'Auth::logout');

// Barang
$routes->get('/product', 'Product::index');
$routes->post('/product/addCategory', 'Product::addCategory');
$routes->post('/product/updateCategory/(:num)', 'Product::updateCategory/$1');
$routes->get('/product/deleteCategory/(:num)', 'Product::deleteCategory/$1');
$routes->post('/product/addProduct', 'Product::addProduct');
$routes->post('/product/updateProduct/(:num)', 'Product::updateProduct/$1');
$routes->get('/product/deleteProduct/(:num)', 'Product::deleteProduct/$1');

// Route untuk produk ke keranjang
$routes->post('add-to-cart', 'Home::addToCart');
$routes->post('update-cart-quantity', 'Home::updateCartQuantity');
$routes->post('remove-from-cart', 'Home::removeFromCart');

// Route untuk checkout
$routes->post('checkout', 'Home::checkout');

// Route untuk detail transaksi
$routes->get('transaction-details/(:num)', 'Home::getTransactionDetails/$1');