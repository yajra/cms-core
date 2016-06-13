<?php

namespace Yajra\CMS\Providers;

use Yajra\CMS\Widgets\Menu;
use Yajra\CMS\Widgets\WidgetManager;
use Yajra\CMS\Widgets\Wysiwyg;
use Illuminate\Support\ServiceProvider;

class WidgetServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(WidgetManager::class, WidgetManager::class);

        $this->app->make(WidgetManager::class)
                  ->register('menu', Menu::class)
                  ->register('wysiwyg', Wysiwyg::class);
    }
}
