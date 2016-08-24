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
$router->get('configuration/asset/edit/{asset}', FileAssetController::class . '@editAsset');
$router->post('configuration/asset/update/{asset}', FileAssetController::class . '@updateAsset');
$router->post('configuration/asset/delete/{asset}', FileAssetController::class . '@deleteAsset');

$router->get('configuration', SiteConfigurationController::class . '@index')->name('administrator.configuration.index');
$router->get('configuration/create', SiteConfigurationController::class . '@create')->name('administrator.configuration.create');
$router->post('configuration', SiteConfigurationController::class . '@store')->name('administrator.configuration.store');
$router->get('configuration/{configuration}/edit', SiteConfigurationController::class . '@edit')->name('administrator.configuration.edit');
$router->put('configuration/{configuration}', SiteConfigurationController::class . '@update')->name('administrator.configuration.update');
$router->delete('configuration/{configuration}', SiteConfigurationController::class . '@destroy')->name('administrator.configuration.destroy');
