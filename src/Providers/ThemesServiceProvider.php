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
        /** @var \Illuminate\View\Factory $view */
        $view = $this->app['view'];
        $view->setFinder($this->app['theme.view.finder']);
        $view->addLocation(__DIR__ . '/../resources/views');

        // Load admin theme views.
        $this->loadViewsFrom(__DIR__ . '/../resources/themes/' . config('theme.backend', 'default'), 'admin');

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
            $finder->setBasePath(config('theme.path', base_path('themes')) . DIRECTORY_SEPARATOR . config('theme.frontend', 'default'));

            return $finder;
        });

        $this->app->singleton('themes', function () {
            return new Repository(new Finder, $this->app['config']);
        });

        $this->app->alias('themes', Repository::class);
    }
}
