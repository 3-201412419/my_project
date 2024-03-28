<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/homepage', 'HomePage::index');
$routes->get('/allmember', 'AllMember::index');
$routes->get('/memberdetail', 'MemberDetail::index');
$routes->get('/memberdetail/(:segment)', 'MemberDetail::index/$1');
$routes->get('/home', 'Home::index');
$routes->get('/login', 'Login::index');
$routes->post('/logout', 'Logout::index');
$routes->post('/login/authenticate', 'Login::authenticate');
$routes->get('/signup', 'SignUp::index');
$routes->get('/mypage', 'MyPage::index');
$routes->get('/mypage/edit', 'MyPage::edit');
$routes->post('/mypage/updatememberinfo', 'MyPage::updateMemberInfo');
$routes->get('/user', 'UserController::index');
$routes->get('/postdetail/(:num)', 'PostDetail::index/$1');
$routes->get('/posts', 'Posts::index');
$routes->get('/posts/create', 'Posts::create');
$routes->post('/posts/comment', 'Posts::comment');
$routes->post('/posts/store', 'Posts::store');
$routes->post('/posts/upload_image', 'Posts::upload_image');
$routes->post('/MemberDetail/saveMemo', 'MemberDetail::saveMemo');
$routes->post('/signup/register', 'SignUp::register');
