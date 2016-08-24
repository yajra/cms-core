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
$router->post('users/{id}/restore', UsersController::class . '@restore')
        ->name('administrator.users.restore');
$router->get('users', UsersController::class . '@index')->name('administrator.users.index');
$router->get('users/create', UsersController::class . '@create')->name('administrator.users.create');
$router->post('users', UsersController::class . '@store')->name('administrator.users.store');
$router->get('users/{user}', UsersController::class . '@edit')->name('administrator.users.edit');
$router->put('users/{user}', UsersController::class . '@update')->name('administrator.users.update');
$router->delete('users/{user}', UsersController::class . '@destroy')->name('administrator.users.destroy');


// Roles Routes
$router->get('roles', RolesController::class . '@index')->name('administrator.roles.index');
$router->get('roles/create', RolesController::class . '@create')->name('administrator.roles.create');
$router->post('roles', RolesController::class . '@store')->name('administrator.roles.store');
$router->get('roles/{role}', RolesController::class . '@edit')->name('administrator.roles.edit');
$router->put('roles/{role}', RolesController::class . '@update')->name('administrator.roles.update');
$router->delete('roles/{role}', RolesController::class . '@destroy')->name('administrator.roles.destroy');


// Permissions Routes
$router->get('permissions/create-resource', PermissionsController::class . '@createResource')
       ->name('administrator.permissions.create-resource');
$router->post('permissions/create-resource', PermissionsController::class . '@storeResource')
       ->name('administrator.permissions.store-resource');
$router->get('permissions', PermissionsController::class . '@index')->name('administrator.permissions.index');
$router->get('permissions/create', PermissionsController::class . '@create')->name('administrator.permissions.create');
$router->post('permissions', PermissionsController::class . '@store')->name('administrator.permissions.store');
$router->get('permissions/{permission}', PermissionsController::class . '@edit')->name('administrator.permissions.edit');
$router->put('permissions/{permission}', PermissionsController::class . '@update')->name('administrator.permissions.update');
$router->delete('permissions/{permission}', PermissionsController::class . '@destroy')->name('administrator.permissions.destroy');


