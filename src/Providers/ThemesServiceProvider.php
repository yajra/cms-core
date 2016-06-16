<?php

namespace Yajra\CMS\Providers;

use Illuminate\Support\ServiceProvider;
use Symfony\Component\Finder\Finder;
use Yajra\CMS\Theme\Repository;
use Yajra\CMS\View\ThemeViewFinder;

class ThemesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app['view']->setFinder($this->app['theme.view.finder']);
        $this->app['view']->addLocation(__DIR__ . '/../resources/views');
        $this->loadViewsFrom(__DIR__ . '/../resources/theme', 'admin');

        /** @var Repository $themes */
        $themes = $this->app['themes'];
        $themes->scan();
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

        $this->app->singleton('themes', function () {
            return new Repository(new Finder, $this->app['config']);
        });

        $this->app->alias('themes', Repository::class);
    }
}
