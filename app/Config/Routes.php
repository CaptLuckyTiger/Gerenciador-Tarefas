<?php

use App\Controllers\TaskController;
use App\Controllers\Api\TaskApiController;


/** @var \CodeIgniter\Router\RouteCollection $routes */

$routes->get('/', [TaskController::class, 'index']);
$routes->get('tasks', [TaskController::class, 'index']);
$routes->get('tasks/create', [TaskController::class, 'create']);
$routes->post('tasks/store', [TaskController::class, 'store']);
$routes->get('tasks/edit/(:num)', [TaskController::class, 'edit/$1']);
$routes->post('tasks/update/(:num)', [TaskController::class, 'update/$1']);
$routes->get('tasks/delete/(:num)', [TaskController::class, 'delete/$1']);
$routes->group('api', function($routes) {
    $routes->resource('tasks', ['controller' => '\\' . TaskApiController::class]);
});