<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/homepage', 'HomePage::index');
$routes->get('/allmember', 'AllMember::index');
$routes->get('/memberdetail', 'MemberDetail::index');
$routes->get('/home', 'Home::index');
$routes->get('/user', 'UserController::index');