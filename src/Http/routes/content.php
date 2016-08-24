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
$router->get('articles', ArticlesController::class . '@index')->name('administrator.articles.index');
$router->get('articles/create', ArticlesController::class . '@create')->name('administrator.articles.create');
$router->post('articles', ArticlesController::class . '@store')->name('administrator.articles.store');
$router->get('articles/{article}/edit', ArticlesController::class . '@edit')->name('administrator.articles.edit');
$router->put('articles/{article}', ArticlesController::class . '@update')->name('administrator.articles.update');
$router->delete('articles/{article}', CategoriesController::class . '@destroy')->name('administrator.articles.destroy');

// Categories Routes
$router->post('categories/{category}/publish', CategoriesController::class . '@publish')
       ->name('administrator.categories.publish');
$router->get('categories', CategoriesController::class . '@index')->name('administrator.categories.index');
$router->get('categories/create', CategoriesController::class . '@create')->name('administrator.categories.create');
$router->post('categories', CategoriesController::class . '@store')->name('administrator.categories.store');
$router->get('categories/{category}/edit', CategoriesController::class . '@edit')->name('administrator.categories.edit');
$router->put('categories/{category}', CategoriesController::class . '@update')->name('administrator.categories.update');
$router->delete('categories/{category}', CategoriesController::class . '@destroy')->name('administrator.categories.destroy');

