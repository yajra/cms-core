<?php
/**
 * Themes routes registration.
 *
 * @var \Illuminate\Routing\Router $router
 */

use Yajra\CMS\Http\Controllers\ThemesController;

$router->resource('themes', ThemesController::class);
