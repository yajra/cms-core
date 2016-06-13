<?php
/**
 * Lookup routes registration.
 *
 * @var \Illuminate\Routing\Router $router
 */

use Yajra\CMS\Http\Controllers\LookupController;

$router->get('lookup/search/{type}', LookupController::class . '@search');
$router->resource('lookup', LookupController::class);
