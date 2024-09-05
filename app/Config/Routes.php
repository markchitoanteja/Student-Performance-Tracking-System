<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::index');
$routes->get('/dashboard', 'Main::index');

$routes->post('/get_user_details', 'Auth::get_user_details');
$routes->post('/change_mode', 'Main::change_mode');
$routes->post('/logout', 'Auth::logout');
$routes->post('/get_admin_data', 'Auth::get_admin_data');
$routes->post('/update_admin', 'Auth::update_admin');
