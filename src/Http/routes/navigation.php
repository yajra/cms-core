<?php
/**
 * Navigation & Menu routes registration.
 *
 * @var \Illuminate\Routing\Router $router
 */

use Yajra\CMS\Http\Controllers\MenuItemsController;
use Yajra\CMS\Http\Controllers\NavigationController;

// Navigation Menu Routes
$router->get('navigation/menu/types', MenuItemsController::class . '@types');
$router->get('navigation/menu/types/{menu}', MenuItemsController::class . '@types');
$router->post('navigation/{navigation}/menu/{menu}/publish', MenuItemsController::class . '@publish')
       ->name('administrator.navigation.menu.publish');
$router->get('navigation/menu/articles', MenuItemsController::class . '@articles');
$router->resource('navigation.menu', MenuItemsController::class);

// Navigation Routes
$router->post('navigation/{navigation}/publish', NavigationController::class . '@publish')
       ->name('administrator.navigation.publish');
$router->resource('navigation', NavigationController::class);
