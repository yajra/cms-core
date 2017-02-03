<?php
/**
 * Administrator extension module routes main entry point.
 *
 * @var \Illuminate\Routing\Router $router
 */

use Yajra\CMS\Http\Controllers\ExtensionsController;

$router->resource('extension', ExtensionsController::class, [
    'only' => ['index', 'store', 'destroy'],
]);
