<?php

namespace Yajra\CMS\Providers;

use Yajra\CMS\View\ThemeViewFinder;
use Illuminate\Support\ServiceProvider;

class ThemeViewFinderServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app['view']->setFinder($this->app['theme.view.finder']);
        $this->app['view']->addLocation(__DIR__.'/../resources/views');
        $this->loadViewsFrom(__DIR__.'/../resources/theme', 'admin');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('theme.view.finder', function ($app) {
            $finder = new ThemeViewFinder($app['files'], $app['config']['view.paths']);
            $finder->setBasePath(base_path('themes/' . config('site.template', 'default')));

            return $finder;
        });
    }
}
