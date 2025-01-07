<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/product', 'ProductController::index');
$routes->post('/product/addProduct', 'ProductController::addProduct');
$routes->post('/product/updateQuantityProduct/(:num)', 'productController::updateQuantityProduct/$1');
$routes->post('/product/updateRestockStatus/(:num)', 'productController::updateRestockStatus/$1');
$routes->get('/product/deleteProduct/(:num)', 'productController::deleteProduct/$1');
