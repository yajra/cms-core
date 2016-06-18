<?php

namespace Yajra\CMS\Providers;

use Illuminate\Support\ServiceProvider;
use Symfony\Component\Finder\Finder;
use Yajra\CMS\Repositories\Theme\CollectionRepository;
use Yajra\CMS\Repositories\Theme\Repository;
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
        $theme = config('theme.backend', 'default');
        $this->loadViewsFrom(__DIR__ . '/../resources/themes/' . $theme, 'admin');

        /** @var \Yajra\CMS\Repositories\Theme\Repository $themes */
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
            $finder   = new ThemeViewFinder($app['files'], $app['config']['view.paths']);
            $basePath = config('theme.path', base_path('themes'));
            $theme    = config('theme.frontend', 'default');
            $finder->setBasePath($basePath . DIRECTORY_SEPARATOR . $theme);

            return $finder;
        });

        $this->app->singleton('themes', function () {
            return new CollectionRepository(new Finder, $this->app['config']);
        });

        $this->app->alias('themes', Repository::class);
    }
}
