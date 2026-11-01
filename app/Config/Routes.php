<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

// ==========================================
// PUBLIC & GUEST ROUTES
// ==========================================
$routes->get('/', 'Home::index');
$routes->get('/login', 'AuthController::login');
$routes->post('/login/process', 'AuthController::processLogin');
$routes->post('/register/process', 'AuthController::processRegister');
$routes->get('/logout', 'AuthController::logout');

// ==========================================
// EMPLOYEE & COMMON AUTHENTICATED ROUTES
// ==========================================
$routes->group('', ['filter' => 'auth'], static function ($routes) {
    // Employee Portal
    $routes->get('/employee/dashboard', 'EmployeeController::dashboard');
    $routes->get('/employee/profile', 'EmployeeController::profile');
    $routes->post('/employee/profile/update', 'EmployeeController::updateProfile');
    $routes->get('/employee/leaves', 'EmployeeController::leaves');
    $routes->post('/employee/leaves/submit', 'EmployeeController::submitLeave');
    $routes->get('/employee/face-enrollment', 'AttendanceController::faceEnrollment');

    // Attendance
    $routes->get('/attendance/scan', 'AttendanceController::scan');
    $routes->get('/attendance/history', 'AttendanceController::history');

    // API Endpoints for Attendance & Biometrics
    $routes->post('/api/attendance/submit', 'AttendanceController::apiSubmitAttendance');
    $routes->post('/api/attendance/enroll-face', 'AttendanceController::apiEnrollFace');
});

// ==========================================
// ADMIN & HR MANAGEMENT ROUTES
// ==========================================
$routes->group('admin', ['filter' => 'role:admin'], static function ($routes) {
    // Executive Dashboard & Live Monitor
    $routes->get('dashboard', 'AdminController::dashboard');
    $routes->get('attendance/live', 'AdminController::liveFeed');
    $routes->get('reports', 'AdminController::reports');

    // Employee Master Management
    $routes->get('employees', 'AdminEmployeeController::index');
    $routes->post('employees/store', 'AdminEmployeeController::store');
    $routes->post('employees/update/(:num)', 'AdminEmployeeController::update/$1');
    $routes->post('employees/reset-face/(:num)', 'AdminEmployeeController::resetBiometrics/$1');
    $routes->post('employees/delete/(:num)', 'AdminEmployeeController::delete/$1');

    // Leave & Permit Approval Hub
    $routes->get('leaves', 'AdminLeaveController::index');
    $routes->post('leaves/action/(:num)', 'AdminLeaveController::action/$1');

    // Work Shifts & Policy Management
    $routes->get('shifts', 'AdminShiftController::index');
    $routes->post('shifts/save', 'AdminShiftController::save');
    $routes->post('shifts/delete/(:num)', 'AdminShiftController::delete/$1');

    // Geofencing & Office Location Settings
    $routes->get('settings/geofence', 'AdminGeofenceController::index');
    $routes->post('settings/geofence/update', 'AdminGeofenceController::update');
});
