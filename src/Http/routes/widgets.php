<?php
/**
 * Widgets routes registration.
 *
 * @var \Illuminate\Routing\Router $router
 */

use Yajra\CMS\Http\Controllers\WidgetsController;

// Widgets Routes
$router->post('widgets/{widget}/publish', WidgetsController::class . '@publish')->name('administrator.widgets.publish');
$router->get('widgets/{extension}/templates', WidgetsController::class . '@templates');
$router->get('widgets/{extension}/parameters/{widget?}', WidgetsController::class . '@parameters');
$router->resource('widgets', WidgetsController::class);

