<?php
/**
 * Content (Article, Category, Tag) routes registration.
 *
 * @var \Illuminate\Routing\Router $router
 */

use Yajra\CMS\Http\Controllers\ArticlesController;
use Yajra\CMS\Http\Controllers\CategoriesController;
use Yajra\CMS\Http\Controllers\TaggingTagsController;

// Articles Routes
$router->post('articles/{article}/published', ArticlesController::class . '@published')
       ->name('articles.published');
$router->post('articles/{article}/featured', ArticlesController::class . '@featured')
       ->name('articles.featured');
$router->resource('articles', ArticlesController::class)->except('show');

// Categories Routes
$router->post('categories/{category}/publish', CategoriesController::class . '@publish')
       ->name('categories.publish');
$router->resource('categories', CategoriesController::class)->except('show');

// Tags Routes
$router->resource('tags', TaggingTagsController::class);
