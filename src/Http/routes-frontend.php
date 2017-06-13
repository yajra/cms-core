<?php

use Yajra\CMS\Http\Controllers\SearchController;

Route::get('search', SearchController::class . '@show')->name('search');
