<?php
/**
 * Modules routes registration.
 *
 * @var \Illuminate\Routing\Router $router
 */

use Yajra\CMS\Http\Controllers\ModulesController;

$router->get('modules', ModulesController::class . '@index')->name('modules.index');
$router->post('modules/{module}', ModulesController::class . '@toggle')->name('modules.toggle');
$router->delete('modules/{module}', ModulesController::class . '@destroy')->name('modules.destroy');
