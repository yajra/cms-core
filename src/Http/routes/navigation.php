<?php
/**
 * Navigation & Menu routes registration.
 *
 * @var \Illuminate\Routing\Router $router
 */

use Yajra\CMS\Http\Controllers\MenuItemsController;
use Yajra\CMS\Http\Controllers\NavigationController;

// Navigation Menu Routes
$router->get('navigation/menu/extensions', MenuItemsController::class . '@extensions');
$router->get('navigation/menu/extensions/{menu}', MenuItemsController::class . '@extensions');
$router->post('navigation/{navigation}/menu/{menu}/publish', MenuItemsController::class . '@publish')
       ->name('administrator.navigation.menu.publish');
$router->get('navigation/menu/articles', MenuItemsController::class . '@articles');
$router->get('navigation/{navigation}/menu', MenuItemsController::class . '@index')->name('administrator.navigation.menu.index');
$router->get('navigation/{navigation}/menu/create', MenuItemsController::class . '@create')->name('administrator.navigation.menu.create');
$router->post('navigation/{navigation}/menu', MenuItemsController::class . '@store')->name('administrator.navigation.menu.store');
$router->get('navigation/{navigation}/menu/{menu}/edit', MenuItemsController::class . '@edit')->name('administrator.navigation.menu.edit');
$router->put('navigation/{navigation}/menu/{menu}', MenuItemsController::class . '@update')->name('administrator.navigation.menu.update');
$router->delete('navigation/{navigation}/menu/{menu}', MenuItemsController::class . '@destroy')->name('administrator.navigation.menu.destroy');

// Navigation Routes
$router->post('navigation/{navigation}/publish', NavigationController::class . '@publish')
       ->name('administrator.navigation.publish');
$router->get('navigation', NavigationController::class . '@index')->name('administrator.navigation.index');
$router->get('navigation/create', NavigationController::class . '@create')->name('administrator.navigation.create');
$router->post('navigation', NavigationController::class . '@store')->name('administrator.navigation.store');
$router->get('navigation/{navigation}/edit', NavigationController::class . '@edit')->name('administrator.navigation.edit');
$router->put('navigation/{navigation}', NavigationController::class . '@update')->name('administrator.navigation.update');
$router->delete('navigation/{navigation}', NavigationController::class . '@destroy')->name('administrator.navigation.destroy');
