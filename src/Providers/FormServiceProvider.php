<?php

namespace Yajra\CMS\Providers;

use Yajra\CMS\Entities\Category;
use Illuminate\Support\ServiceProvider;

class FormServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        form()->macro('categories', function ($name = 'category_id', $selected = null, $options = []) {
            return form()->select($name, Category::lookup(), $selected, $options);
        });

        form()->macro('selectCategories', function ($options = []) {
            return form()->select('category_id', Category::lists(), null, $options);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
