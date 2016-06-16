<?php

namespace Yajra\CMS\Providers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Yajra\Acl\Models\Permission;
use Yajra\CMS\Entities\Category;
use Yajra\CMS\Theme\Repository;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->bootAdministratorViewComposer();
    }

    /**
     * Register administrator view composers.
     */
    protected function bootAdministratorViewComposer()
    {
        view()->composer('administrator.widgets.*', function (View $view) {
            /** @var Repository $themes */
            $themes    = $this->app['themes'];
            $theme     = $themes->current();
            $positions = $theme->positions;
            $data      = [];
            foreach ($positions as $position) {
                $data[$position] = Str::title($position);
            }

            $view->with('widget_positions', $data);
            $view->with('theme', $theme);
        });

        view()->composer('administrator.articles.partials.form', function (View $view) {
            $view->with('categories', Category::lists());
        });

        view()->composer(['administrator.partials.permissions'], function (View $view) {
            $view->with('permissions', Permission::all());
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
