<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'MyPage::index');
$routes->get('/home', 'Home::index');
$routes->get('/user', 'UserController::index');