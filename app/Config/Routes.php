<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index'); // Home Page 
$routes->get('/login', 'Login::index'); // Login and Register Page