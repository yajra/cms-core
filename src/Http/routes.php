<?php
/**
 * Administrator routes main entry point.
 *
 * @prefix /administrator
 * @middleware("administrator") /administrator
 * @var \Illuminate\Routing\Router $router
 */

use Yajra\CMS\Http\Controllers\DashboardController;

$router->get('/', DashboardController::class . '@index')->name('administrator.index');

require_once 'routes/configuration.php';
require_once 'routes/navigation.php';
require_once 'routes/utilities.php';
require_once 'routes/extension.php';
require_once 'routes/content.php';
require_once 'routes/widgets.php';
require_once 'routes/profile.php';
require_once 'routes/themes.php';
require_once 'routes/media.php';
require_once 'routes/acl.php';

$router->get('abort/{code}', function ($code) {
    abort($code, "$code simulation");
});
