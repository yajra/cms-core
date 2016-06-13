<?php

namespace Yajra\CMS\Providers;

use Yajra\CMS\Entities\Category;
use Yajra\CMS\Entities\Lookup;
use Illuminate\Contracts\View\View;
use Illuminate\Support\ServiceProvider;
use Yajra\Acl\Models\Permission;

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
            $view->with('widget_positions', Lookup::type('widgets.positions')->pluck('value', 'key'));
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
