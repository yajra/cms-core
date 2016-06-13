<?php
/**
 * Administrator utilities routes registration.
 *
 * @var \Illuminate\Routing\Router $router
 */

use Yajra\CMS\Http\Controllers\UtilitiesController;

$router->get('utilities', UtilitiesController::class . '@index')
       ->name('administrator.utilities.index');

$router->post('utilities/backup/{task?}', UtilitiesController::class . '@backup')
       ->name('administrator.utilities.backup');
$router->post('utilities/cache', UtilitiesController::class . '@cache')
       ->name('administrator.utilities.cache');
$router->post('utilities/views', UtilitiesController::class . '@views')
       ->name('administrator.utilities.views');

$router->post('utilities/config/{task}', UtilitiesController::class . '@config')
       ->name('administrator.utilities.config');

$router->get('utilities/logs', UtilitiesController::class . '@logs')
       ->name('administrator.utilities.logs');
