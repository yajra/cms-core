<?php
/**
 * ACL (User, Role, Permission) routes registration.
 *
 * @var \Illuminate\Routing\Router $router
 */

use Yajra\CMS\Http\Controllers\PermissionsController;
use Yajra\CMS\Http\Controllers\RolesController;
use Yajra\CMS\Http\Controllers\UsersController;

// Users Routes
$router->get('users/{user}/password', UsersController::class . '@password')
       ->name('users.password');
$router->post('users/{user}/password', UsersController::class . '@updatePassword')
       ->name('users.password.update');
$router->post('users/{user}/activate', UsersController::class . '@activate')
       ->name('users.activate');
$router->post('users/{user}/block', UsersController::class . '@ban')
       ->name('users.block');
$router->delete('users/{id}/force', UsersController::class . '@forceDelete')
       ->name('users.destroy.force');
$router->post('users/{id}/restore', UsersController::class . '@restore')
        ->name('users.restore');
$router->resource('users', UsersController::class);

// Roles Routes
$router->resource('roles', RolesController::class)->except('show');

// Permissions Routes
$router->get('permissions/create-resource', PermissionsController::class . '@createResource')
       ->name('permissions.create-resource');
$router->post('permissions/create-resource', PermissionsController::class . '@storeResource')
       ->name('permissions.store-resource');
$router->resource('permissions', PermissionsController::class)->except('show');


