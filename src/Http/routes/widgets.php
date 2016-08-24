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
$router->get('widgets', WidgetsController::class . '@index')->name('administrator.widgets.index');
$router->get('widgets/create', WidgetsController::class . '@create')->name('administrator.widgets.create');
$router->post('widgets', WidgetsController::class . '@store')->name('administrator.widgets.store');
$router->get('widgets/{widget}', WidgetsController::class . '@edit')->name('administrator.widgets.edit');
$router->put('widgets/{widget}', WidgetsController::class . '@update')->name('administrator.widgets.update');
$router->delete('widgets/{widget}', WidgetsController::class . '@destroy')->name('administrator.widgets.destroy');
