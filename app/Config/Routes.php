<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::index');
$routes->get('/dashboard', 'Main::dashboard');
$routes->get('/manage_student_records', 'Main::manage_student_records');
$routes->get('/student_profile', 'Main::student_profile');
$routes->get('/course_management', 'Main::course_management');
$routes->get('/subject_management', 'Main::subject_management');
$routes->get('/grade_management', 'Main::grade_management');
$routes->get('/student_achievements', 'Main::student_achievements');

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
$routes->post('/get_subjects', 'Main::get_subjects');
$routes->post('/add_grade', 'Main::add_grade');
$routes->post('/delete_grade', 'Main::delete_grade');
$routes->post('/get_grade_data', 'Main::get_grade_data');
$routes->post('/update_grade', 'Main::update_grade');
$routes->post('/get_subject_data_by_course', 'Main::get_subject_data_by_course');
$routes->post('/new_achievement', 'Main::new_achievement');
$routes->post('/get_achievement_data', 'Main::get_achievement_data');
$routes->post('/update_achievement', 'Main::update_achievement');
$routes->post('/delete_achievement', 'Main::delete_achievement');
$routes->post('/new_admin', 'Auth::new_admin');
$routes->post('/check_admin', 'Auth::check_admin');
$routes->post('/check_username', 'Auth::check_username');
