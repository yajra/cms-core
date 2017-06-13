<?php
/**
 * Administrator routes main entry point.
 *
 * @prefix /administrator
 * @middleware("administrator") /administrator
 * @var \Illuminate\Routing\Router $router
 */

use Yajra\CMS\Http\Controllers\DashboardController;

$router->get('/', DashboardController::class . '@index')->name('index');

require 'routes/configuration.php';
require 'routes/navigation.php';
require 'routes/utilities.php';
require 'routes/extension.php';
require 'routes/content.php';
require 'routes/widgets.php';
require 'routes/modules.php';
require 'routes/profile.php';
require 'routes/media.php';
require 'routes/acl.php';

$router->get('abort/{code}', function ($code) {
    abort($code, "$code simulation");
});
