<?php
/**
 * Lookup routes registration.
 *
 * @var \Illuminate\Routing\Router $router
 */

use Yajra\CMS\Http\Controllers\ProfileController;

$router->get('user/profile', ProfileController::class . '@edit')->name('profile.edit');
$router->post('user/profile', ProfileController::class . '@update')->name('profile.update');
$router->get('user/profile/remove-avatar', ProfileController::class . '@removeAvatar')->name('profile.remove-avatar');
