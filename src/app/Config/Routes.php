<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/a', 'Home::index');
$routes->get('/comments', 'Home::comments');
