<?php
/**
 * Administrator extension module routes main entry point.
 *
 * @var \Illuminate\Routing\Router $router
 */

use Yajra\CMS\Http\Controllers\ExtensionsController;

$router->get('extension', ExtensionsController::class . '@index')->name('administrator.extension.index');
$router->get('extension/create', ExtensionsController::class . '@create')->name('administrator.extension.create');
$router->post('extension', ExtensionsController::class . '@store')->name('administrator.extension.store');
$router->get('extension/{extension}/edit', ExtensionsController::class . '@edit')->name('administrator.extension.edit');
$router->put('extension/{extension}', ExtensionsController::class . '@update')->name('administrator.extension.update');
$router->delete('extension/{extension}', ExtensionsController::class . '@destroy')->name('administrator.extension.destroy');
