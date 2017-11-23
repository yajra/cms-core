<?php

namespace Yajra\CMS\Providers;

use Barryvdh\Debugbar\ServiceProvider as DebugbarServiceProvider;
use Baum\Providers\BaumServiceProvider;
use Conner\Tagging\Providers\TaggingServiceProvider;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;
use Yajra\CMS\Contracts\SearchEngine;
use Yajra\CMS\Search\Engines\LocalSearch;
use Yajra\CMS\View\Directives\PageHeaderDirective;
use Yajra\CMS\View\Directives\TooltipDirective;

class CoreServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->setDefaultTheme();
        $this->bootCustomBladeDirectives();
        $this->registerViews();
        $this->bootTranslations();
        $this->bootDebugbar();
    }

    /**
     * Set default theme.
     */
    protected function setDefaultTheme()
    {
        $theme = config('themes.frontend', 'default');
        $this->app['themes.view.finder']->use($theme);
    }

    /**
     * Boot custom blade directives.
     */
    protected function bootCustomBladeDirectives()
    {
        /** @var BladeCompiler $blade */
        $blade = $this->app['blade.compiler'];
        $blade->directive('tooltip', function ($expression) {
            return "<?php echo app('Yajra\\CMS\\View\\Directives\\TooltipDirective')->handle({$expression}); ?>";
        });

        $blade->directive('pageHeader', function ($expression) {
            return "<?php echo app('Yajra\\CMS\\View\\Directives\\PageHeaderDirective')->handle({$expression}); ?>";
        });

        $blade->directive('error', function ($expression) {
            return "<?php echo app('Yajra\\CMS\\View\\Directives\\ErrorDirective')->handle({$expression}); ?>";
        });
    }

    /**
     * Register cms-core view path.
     */
    protected function registerViews()
    {
        /** @var \Illuminate\View\Factory $view */
        $view = $this->app['view'];
        $view->addLocation(__DIR__ . '/../resources/views');
    }

    /**
     * Boot and publish translations.
     */
    protected function bootTranslations()
    {
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'cms');
        $this->publishes([
            __DIR__ . '/../resources/lang' => resource_path('lang/vendor/cms'),
        ], 'cms-core');
    }

    /**
     * Boot debugbar package.
     */
    protected function bootDebugbar()
    {
        if (config('app.debug') && config('app.debugbar')) {
            $this->app->registerDeferredProvider(DebugbarServiceProvider::class);
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerProviders();
        $this->registerBindings();
        $this->registerMigrations();
    }

    /**
     * Registered required administrator providers.
     */
    protected function registerProviders()
    {
        $this->app->register(ConfigurationServiceProvider::class);
        $this->app->register(RouteServiceProvider::class);
        $this->app->register(ViewComposerServiceProvider::class);
        $this->app->register(BaumServiceProvider::class);
        $this->app->register(RepositoryServiceProvider::class);
        $this->app->register(FormServiceProvider::class);
        $this->app->register(WidgetServiceProvider::class);
        $this->app->register(TaggingServiceProvider::class);
    }

    /**
     * Register IOC bindings.
     */
    protected function registerBindings()
    {
        $this->app->singleton(PageHeaderDirective::class, PageHeaderDirective::class);
        $this->app->singleton(TooltipDirective::class, TooltipDirective::class);
        $this->app->singleton(SearchEngine::class, LocalSearch::class);
    }

    /**
     * Register core migration files.
     */
    protected function registerMigrations()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../migrations');
    }
}
