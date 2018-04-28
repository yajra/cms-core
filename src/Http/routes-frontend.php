<?php

use Yajra\CMS\Http\Controllers\SearchController;
use DaveJamesMiller\Breadcrumbs\BreadcrumbsGenerator;

/**
 * Register site specific routes.
 */
Route::get('search', SearchController::class . '@show')->name('search');

/**
 * Register breadcrumbs.
 */
Breadcrumbs::register('site.search', function (BreadcrumbsGenerator $breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Search', route('site.search'));
});
