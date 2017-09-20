<?php
/**
 * Widgets routes registration.
 *
 * @var \Illuminate\Routing\Router $router
 */

use Yajra\CMS\Http\Controllers\WidgetsController;

// Widgets Routes
$router->post('widgets/{widget}/publish', WidgetsController::class . '@publish')->name('widgets.publish');
$router->get('widgets/{extension}/templates', WidgetsController::class . '@templates')->name('widgets.extension');
$router->get('widgets/{extension}/parameters/{id?}', WidgetsController::class . '@parameters')->name('widgets.extension.parameters');
$router->resource('widgets', WidgetsController::class)->except('show');
