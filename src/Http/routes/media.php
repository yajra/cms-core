<?php
/**
 * Media routes registration.
 *
 * @var \Illuminate\Routing\Router $router
 */

use Yajra\CMS\Http\Controllers\MediaController;
use Yajra\CMS\Http\Controllers\ImageBrowserController;

// Media Routes
$router->post('media/delete-media', MediaController::class . '@deleteMedia')->middleware('can:media.delete');
$router->post('media/add-folder', MediaController::class . '@addFolder')->middleware('can:media.create');
$router->post('media/add-file', MediaController::class . '@addFile')->middleware('can:media.create');
$router->post('media/delete-media', MediaController::class . '@deleteMedia')->middleware('can:media.delete');
$router->get('media/browse/{filter?}', MediaController::class . '@browse')->middleware('can:media.view');
$router->post('media/browse/image', ImageBrowserController::class . '@getFiles')->middleware('can:media.view');
$router->post('media/upload/image', ImageBrowserController::class . '@uploadFile')->middleware('can:media.create');
$router->get('media', MediaController::class . '@index')->middleware('can:media.view')->name('media.index');
