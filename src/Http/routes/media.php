<?php
/**
 * Media routes registration.
 *
 * @var \Illuminate\Routing\Router $router
 */

use Yajra\CMS\Http\Controllers\MediaController;
use Yajra\CMS\Http\Controllers\ImageBrowserController;

// Media Routes
$router->post('media/delete-media', MediaController::class . '@deleteMedia')
	->name('media.destroy')
	->middleware('can:media.delete');
$router->post('media/add-folder', MediaController::class . '@addFolder')
	->name('media.add-folder')
	->middleware('can:media.create');
$router->post('media/add-file', MediaController::class . '@addFile')
	->name('media.add-file')
	->middleware('can:media.create');
$router->post('media/browse/image', ImageBrowserController::class . '@index')
       ->name('media.browse.image')
       ->middleware('can:media.view');
$router->get('media/browse/{filter?}', MediaController::class . '@browse')
	->name('media.browse')
	->middleware('can:media.view');
$router->get('media', MediaController::class . '@index')
	->name('media.index')
	->middleware('can:media.view');
