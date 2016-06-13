<?php
/**
 * Content (Article, Category) routes registration.
 *
 * @var \Illuminate\Routing\Router $router
 */

use Yajra\CMS\Http\Controllers\ArticlesController;
use Yajra\CMS\Http\Controllers\CategoriesController;

// Articles Routes
$router->post('articles/{articles}/publish', ArticlesController::class . '@publish')
       ->name('administrator.articles.publish');
$router->resource('articles', ArticlesController::class);

// Categories Routes
$router->post('categories/{category}/publish', CategoriesController::class . '@publish')
       ->name('administrator.categories.publish');
$router->resource('categories', CategoriesController::class);