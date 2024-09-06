<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::index');
$routes->get('/dashboard', 'Main::index');
$routes->get('/manage_students', 'Main::manage_students');
$routes->get('/student_profile', 'Main::student_profile');
$routes->get('/manage_courses', 'Main::manage_courses');
$routes->get('/manage_subjects', 'Main::manage_subjects');

$routes->post('/get_user_details', 'Auth::get_user_details');
$routes->post('/change_mode', 'Main::change_mode');
$routes->post('/logout', 'Auth::logout');
$routes->post('/get_admin_data', 'Auth::get_admin_data');
$routes->post('/update_admin', 'Auth::update_admin');
$routes->post('/save_student', 'Main::save_student');
$routes->post('/delete_student', 'Main::delete_student');
$routes->post('/get_student_data', 'Main::get_student_data');
$routes->post('/update_student', 'Main::update_student');
$routes->post('/add_course', 'Main::add_course');
$routes->post('/delete_course', 'Main::delete_course');
$routes->post('/get_course_data', 'Main::get_course_data');
$routes->post('/update_course', 'Main::update_course');
$routes->post('/get_course_data_by_code', 'Main::get_course_data_by_code');
$routes->post('/add_subject', 'Main::add_subject');
$routes->post('/delete_subject', 'Main::delete_subject');
$routes->post('/get_subject_data', 'Main::get_subject_data');
$routes->post('/update_subject', 'Main::update_subject');
