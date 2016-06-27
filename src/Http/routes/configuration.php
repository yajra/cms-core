<?php
/**
 * Configuration routes registration.
 *
 * @var \Illuminate\Routing\Router $router
 */

use Yajra\CMS\Http\Controllers\FileAssetController;
use Yajra\CMS\Http\Controllers\SiteConfigurationController;

$router->get('configuration/assets/{category}', FileAssetController::class . '@getAssets');
$router->post('configuration/asset/store', FileAssetController::class . '@storeAsset');
$router->resource('configuration', SiteConfigurationController::class);