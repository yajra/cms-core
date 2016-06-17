<?php

namespace Yajra\CMS\Providers;

use Illuminate\Support\ServiceProvider;
use Yajra\CMS\Console\WidgetMakeCommand;
use Yajra\CMS\Console\WidgetPublishCommand;
use Yajra\CMS\Widgets\EloquentRepository;
use Yajra\CMS\Widgets\Repository;

class WidgetServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->commands(WidgetPublishCommand::class);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('widgets', function () {
            return new EloquentRepository;
        });

        $this->app->alias('widgets', Repository::class);

        // override arrilot widget command.
        $this->app->singleton('command.widget.make', function ($app) {
            return new WidgetMakeCommand($app['files']);
        });
    }

    /**
     * @return array
     */
    public function provides()
    {
        return ['widgets'];
    }
}
