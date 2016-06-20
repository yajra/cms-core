<?php
/**
 * Configuration routes registration.
 *
 * @var \Illuminate\Routing\Router $router
 */

use Yajra\CMS\Http\Controllers\SiteConfigurationController;

$router->get('configuration/assets', SiteConfigurationController::class . '@getAssets');
$router->resource('configuration', SiteConfigurationController::class);