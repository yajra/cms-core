<?php
/**
 * Widgets routes registration.
 *
 * @var \Illuminate\Routing\Router $router
 */

use Yajra\CMS\Http\Controllers\WidgetsController;

// Widgets Routes
$router->post('widgets/{widget}/publish', WidgetsController::class . '@publish')->name('administrator.widgets.publish');
$router->get('widgets/{type}/templates', WidgetsController::class . '@templates');
$router->resource('widgets', WidgetsController::class);

