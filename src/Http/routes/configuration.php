<?php
/**
 * Configuration routes registration.
 *
 * @var \Illuminate\Routing\Router $router
 */

use Yajra\CMS\Http\Controllers\ConfigurationsController as Controller;

$router->group(['middleware' => 'can:utilities.config'], function () use ($router) {
    $router->get('configuration', Controller::class . '@index')->name('configuration.index');
    $router->post('configuration', Controller::class . '@store')->name('configuration.store');
    $router->get('configuration/{key}', Controller::class . '@show')->name('configuration.show');
    $router->delete('configuration', Controller::class . '@destroy')->name('configuration.destroy');
});
