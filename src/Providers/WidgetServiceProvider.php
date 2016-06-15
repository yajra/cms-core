<?php

namespace Yajra\CMS\Providers;

use Illuminate\Support\ServiceProvider;
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
        $factory->register('menu', 'Menu Widget', Menu::class, [
            'widgets.menu.bootstrap' => 'Bootstrap Menu (widgets.menu.bootstrap)',
            'custom'                 => 'Custom Template',
        ])->register('wysiwyg', 'WYSIWYG', Wysiwyg::class, [
            'widgets.wysiwyg.default' => 'Default Bootstrap Panel (widgets.wysiwyg.default)',
            'widgets.wysiwyg.raw'     => 'Plain Body Contents (widgets.wysiwyg.raw)',
            'custom'                  => 'Custom Template',
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
    }

    /**
     * @return array
     */
    public function provides()
    {
        return ['widgets'];
    }
}
