<?php
/**
 * Administrator utilities routes registration.
 *
 * @var \Illuminate\Routing\Router $router
 */

use Yajra\CMS\Http\Controllers\UtilitiesController;

$router->get('utilities', UtilitiesController::class . '@index')
       ->name('utilities.index');

$router->post('utilities/backup/{task?}', UtilitiesController::class . '@backup')
       ->name('utilities.backup');

$router->post('utilities/cache', UtilitiesController::class . '@cache')
       ->name('utilities.cache');

$router->post('utilities/views', UtilitiesController::class . '@views')
       ->name('utilities.views');

$router->post('utilities/rebuild-menu', UtilitiesController::class . '@rebuildMenu')
       ->name('utilities.menu.rebuild');
$router->post('utilities/rebuild-category', UtilitiesController::class . '@rebuildCategory')
       ->name('utilities.category.rebuild');

$router->post('utilities/config/{task}', UtilitiesController::class . '@config')
       ->name('utilities.config');

$router->post('utilities/route/{task}', UtilitiesController::class . '@route')
       ->name('utilities.route');

$router->get('utilities/logs', UtilitiesController::class . '@logs')
       ->name('utilities.logs');
