<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/a', 'Home::index');
$routes->get('/comments/', 'CommentsController::comments');
$routes->get('/comments/show/(:num)', 'CommentsController::show/$1');
$routes->post('/comments/new', 'CommentsController::new');
$routes->get('/comments/edit/(:num)', 'CommentsController::edit/$1');
$routes->post('/comments/update/(:num)', 'CommentsController::update/$1');
$routes->get('/comments/delete/(:num)', 'CommentsController::delete/$1');
