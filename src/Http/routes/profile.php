<?php
/**
 * Lookup routes registration.
 *
 * @var \Illuminate\Routing\Router $router
 */

use Yajra\CMS\Http\Controllers\ProfileController;

$router->get('user/profile', ProfileController::class . '@edit')
       ->name('administrator.profile.edit');
$router->post('user/profile', ProfileController::class . '@update');
$router->get('user/profile/remove-avatar', ProfileController::class . '@removeAvatar')
       ->name('administrator.profile.remove-avatar');
