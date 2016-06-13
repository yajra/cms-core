<?php
/**
 * Configuration routes registration.
 *
 * @var \Illuminate\Routing\Router $router
 */

use Yajra\CMS\Http\Controllers\SiteConfigurationController;

$router->resource('configuration', SiteConfigurationController::class);