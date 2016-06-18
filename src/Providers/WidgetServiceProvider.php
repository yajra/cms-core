<?php

namespace Yajra\CMS\Providers;

use Illuminate\Support\ServiceProvider;
use Yajra\CMS\Console\WidgetMakeCommand;
use Yajra\CMS\Console\WidgetPublishCommand;

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
