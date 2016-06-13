<?php
/**
 * Navigation & Menu routes registration.
 *
 * @var \Illuminate\Routing\Router $router
 */

use Yajra\CMS\Http\Controllers\MenuItemsController;
use Yajra\CMS\Http\Controllers\NavigationController;

// Navigation Menu Routes
$router->get('navigation/menu/types', MenuItemsController::class . '@getTypesByKey')
       ->middleware('can:navigation.lists');
$router->get('navigation/menu/types/{menu}', MenuItemsController::class . '@getTypesByKey')
       ->middleware('can:navigation.lists');
$router->post('navigation/{navigation}/menu/{menu}/publish', MenuItemsController::class . '@publish')
       ->name('administrator.navigation.menu.publish')
       ->middleware('can:menu.update');

$router->get('navigation/menu/articles', MenuItemsController::class . '@getArticles')
       ->middleware('can:menu.lists');
$router->resource('navigation.menu', MenuItemsController::class);

// Navigation Routes
$router->post('navigation/{navigation}/publish', NavigationController::class . '@publish')
       ->name('administrator.navigation.publish')
       ->middleware('can:navigation.update');
$router->resource('navigation', NavigationController::class);