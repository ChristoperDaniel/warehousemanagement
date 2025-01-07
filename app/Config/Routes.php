<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/product', 'ProductController::index');
$routes->get('/product/getDataProductOnly', 'ProductController::getDataProductOnly');
$routes->post('/product/addProduct', 'ProductController::addProduct');
$routes->post('/product/updateQuantityProduct/(:num)', 'productController::updateQuantityProduct/$1');
$routes->post('/product/updateRestockStatus/(:num)', 'productController::updateRestockStatus/$1');
$routes->get('/product/deleteProduct/(:num)', 'productController::deleteProduct/$1');

$routes->get('/employee', 'EmployeeController::index');
$routes->get('/employee/getDataEmployeeOnly', 'EmployeeController::getDataEmployeeOnly');
$routes->post('/employee/inputDataEmployee', 'EmployeeController::inputDataEmployee');
$routes->post('/employee/updateEmployee', 'EmployeeController::updateEmployee');
$routes->post('/employee/deleteEmployee', 'EmployeeController::deleteEmployee');

$routes->get('/login', 'LoginController::index');
$routes->get('/logout', 'LoginController::logout');
$routes->post('/login_action', 'LoginController::login_action');