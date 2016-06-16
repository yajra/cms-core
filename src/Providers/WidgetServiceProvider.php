<?php

namespace Yajra\CMS\Providers;

use Illuminate\Support\ServiceProvider;
use Yajra\CMS\Console\WidgetMakeCommand;
use Yajra\CMS\Widgets\Menu;
use Yajra\CMS\Widgets\Repository;
use Yajra\CMS\Widgets\Wysiwyg;

class WidgetServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        /** @var Repository $factory */
        $factory = $this->app['widgets'];
        $factory->register([
            'type'        => 'menu',
            'name'        => 'Menu Widget',
            'version'     => '1.0.0',
            'class'       => Menu::class,
            'templates'   => [
                'widgets.menu.bootstrap' => 'Bootstrap Menu (widgets.menu.bootstrap)',
                'custom'                 => 'Custom Template',
            ],
        ])->register([
            'type'      => 'wysiwyg',
            'name'      => 'WYSIWYG',
            'version'   => '1.0.0',
            'class'     => Wysiwyg::class,
            'templates' => [
                'widgets.wysiwyg.default' => 'Default Bootstrap Panel (widgets.wysiwyg.default)',
                'widgets.wysiwyg.raw'     => 'Plain Body Contents (widgets.wysiwyg.raw)',
                'custom'                  => 'Custom Template',
            ],
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('widgets', function () {
            return new Repository;
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
