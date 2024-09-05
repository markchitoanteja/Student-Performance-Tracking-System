<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::index');
$routes->get('/dashboard', 'Main::index');
$routes->get('/manage_students', 'Main::manage_students');
$routes->get('/student_profile', 'Main::student_profile');

$routes->post('/get_user_details', 'Auth::get_user_details');
$routes->post('/change_mode', 'Main::change_mode');
$routes->post('/logout', 'Auth::logout');
$routes->post('/get_admin_data', 'Auth::get_admin_data');
$routes->post('/update_admin', 'Auth::update_admin');
$routes->post('/save_student', 'Main::save_student');
$routes->post('/delete_student', 'Main::delete_student');
$routes->post('/get_student_data', 'Main::get_student_data');
$routes->post('/update_student', 'Main::update_student');
