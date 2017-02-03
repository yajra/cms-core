<?php
/**
 * Content (Article, Category) routes registration.
 *
 * @var \Illuminate\Routing\Router $router
 */

use Yajra\CMS\Http\Controllers\ArticlesController;
use Yajra\CMS\Http\Controllers\CategoriesController;

// Articles Routes
$router->post('articles/{article}/publish', ArticlesController::class . '@publish')
       ->name('articles.publish');
$router->resource('articles', ArticlesController::class, ['except' => ['show']]);

// Categories Routes
$router->post('categories/{category}/publish', CategoriesController::class . '@publish')
       ->name('categories.publish');
$router->resource('categories', CategoriesController::class, ['except' => ['show']]);
