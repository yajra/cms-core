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
$router->get('users/{users}/password', UsersController::class . '@password')
       ->name('administrator.users.password');
$router->post('users/{users}/password', UsersController::class . '@updatePassword')
       ->name('administrator.users.password.update');
$router->post('users/{users}/activate', UsersController::class . '@activate')
       ->name('administrator.users.activate');
$router->post('users/{users}/block', UsersController::class . '@ban')
       ->name('administrator.users.block');
$router->delete('users/{id}/force', UsersController::class . '@forceDelete')
       ->name('administrator.users.destroy.force');
$router->post('users/{id}/restore', UsersController::class . '@restore')->name('administrator.users.restore');
$router->resource('users', UsersController::class);

// Roles Routes
$router->resource('roles', RolesController::class);
$router->get('permissions/create-resource', PermissionsController::class . '@createResource')
       ->name('administrator.permissions.create-resource');

// Permissions Routes
$router->post('permissions/create-resource', PermissionsController::class . '@storeResource')
       ->name('administrator.permissions.store-resource');
$router->resource('permissions', PermissionsController::class);
