<?php

namespace Yajra\CMS\Providers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Yajra\Acl\Models\Permission;
use Yajra\CMS\Entities\Category;
use Yajra\CMS\Entities\Configuration;
use Yajra\CMS\Entities\Menu;
use Symfony\Component\Finder\Finder;

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

        view()->composer('*', function (View $view) {
            $view->with('active_menu', session('active_menu', new Menu));
        });
    }

    /**
     * Register administrator view composers.
     */
    protected function bootAdministratorViewComposer()
    {
        view()->composer('administrator.widgets.*', function (View $view) {
            /** @var \Yajra\CMS\Themes\Repositories\Repository $themes */
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
            $widgets    = $extensions->allWidgets()->filter(function ($extension) {
                return $extension->enabled;
            });
            $view->with('extensions', $widgets);
        });

        view()->composer(['administrator.partials.permissions'], function (View $view) {
            $view->with('permissions', Permission::orderBy('resource')->get());
        });

        view()->composer(['system.macro.image-browser'], function (View $view) {
            $view->with('mediaDirectories', $this->getFileDirectories());
        });
    }

    /**
     * Show all directories on media path.
     *
     * @return array
     */
    protected function getFileDirectories()
    {
        $mediaFiles['/'] = '/';
        $path            = storage_path('app/' . config('media.root_dir'));
        foreach ($this->getFiles($path)->directories() as $file) {
            $strFile              = str_replace($path, '', $file->getRealPath());
            $mediaFiles[$strFile] = $strFile;
        }

        return $mediaFiles;
    }

    /**
     * Symfony file finder.
     * Show all files in selected $path directory.
     * Sort by file type.
     *
     * @param string $path
     * @return \Symfony\Component\Finder\Finder
     */
    protected function getFiles($path)
    {
        return Finder::create()->in($path)->sortByType();
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
