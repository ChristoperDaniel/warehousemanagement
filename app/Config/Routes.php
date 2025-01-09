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

$routes->get('/filter/productemployee', 'ProductEmployeeFilterController::filterByCategory');
$routes->get('/product-employee-filter', 'ProductEmployeeFilterController::index');

$routes->get('/loginUserProduct', 'LoginProductController::index');
$routes->get('/logoutUserProduct', 'LoginProductController::logout');
$routes->post('/login_action_user', 'LoginProductController::login_action_user');

$routes->get('/productFeature', 'ProductFeatureController::index');

$routes->get('/dashboard', 'Dashboard::index');
$routes->get('/staff', 'Staff::index');

$routes->get('/job', 'JobController::index');
$routes->get('/job/getJobOnly', 'JobController::getJobOnly');
$routes->post('/job/inputJob', 'JobController::inputJob');
$routes->post('/job/updateJob', 'JobController::updateJob');
$routes->post('/job/deleteJob', 'JobController::deleteJob');

$routes->get('/attendance', 'AttendanceController::index');
$routes->post('/attendance/inputAttendance', 'AttendanceController::inputAttendance');
$routes->get('/job_assign', 'JobAssignController::index');
$routes->post('/job_assign/updateJobAssign', 'JobAssignController::updateJobAssign');