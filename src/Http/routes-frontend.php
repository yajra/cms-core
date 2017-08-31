<?php

use Yajra\CMS\Http\Controllers\SearchController;
use DaveJamesMiller\Breadcrumbs\Generator;

/**
 * Register site specific routes.
 */
Route::get('search', SearchController::class . '@show')->name('search');

/**
 * Register breadcrumbs.
 */
Breadcrumbs::register('site.search', function (Generator $breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Search', route('site.search'));
});
