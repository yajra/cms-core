<?php

namespace Yajra\CMS\Providers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Yajra\Acl\Models\Permission;
use Yajra\CMS\Entities\Category;
use Yajra\CMS\Entities\Configuration;
use Yajra\CMS\Repositories\Theme\CollectionRepository;

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
            /** @var \Yajra\CMS\Repositories\Theme\CollectionRepository $themes */
            $themes    = $this->app['themes'];
            $theme     = $themes->current();
            $positions = $theme->positions;
            $data      = [];
            foreach ($positions as $position) {
                $data[$position] = Str::title($position);
            }

            $view->with('widget_positions', $data);
            $view->with('theme', $theme);

            /** @var \Yajra\CMS\Repositories\Extension\Repository $extensions */
            $extensions = $this->app['extensions'];
            $view->with('extensions', $extensions->allWidgets());
        });

        view()->composer('administrator.articles.partials.form', function (View $view) {
            $view->with('categories', Category::lists());
        });

        view()->composer('administrator.configuration.partials.form.database-connection', function (View $view) {
            $dbArray   = Configuration::key("database.connections");
            $databases = array_except($dbArray, ['IBPMWorkgroup', 'vueic', 'uigleads', 'faxmanager', 'aas']);
            $view->with('databases', $databases);
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
