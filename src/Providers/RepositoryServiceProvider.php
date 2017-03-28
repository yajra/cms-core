<?php

namespace Yajra\CMS\Providers;

use Illuminate\Support\ServiceProvider;
use Yajra\CMS\Contracts\Cacheable;
use Yajra\CMS\Entities\Article;
use Yajra\CMS\Entities\Category;
use Yajra\CMS\Entities\Extension;
use Yajra\CMS\Entities\Menu;
use Yajra\CMS\Entities\Navigation;
use Yajra\CMS\Entities\Widget;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * List of model that implements caching.
     *
     * @var array
     */
    protected $cachedModels = [
        Widget::class,
        Navigation::class,
        Menu::class,
        Article::class,
        Category::class,
    ];

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        foreach ($this->cachedModels as $cachedModel) {
            $closure = function ($model) {
                if ($model instanceof Cacheable) {
                    foreach ($model->getCacheKeys() as $key) {
                        $this->app['cache.store']->forget($key);
                    }
                }
            };

            $cachedModel::saved($closure);
            $cachedModel::deleted($closure);
        }

        Extension::saved(function ($model) {
            $this->app['cache.store']->forget('extension.' . $model->id);
            $this->app['cache.store']->forget('extensions.widgets');
            $this->app['cache.store']->forget('extensions.all');
        });
        Extension::deleted(function ($model) {
            $this->app['cache.store']->forget('extension.' . $model->id);
            $this->app['cache.store']->forget('extensions.widgets');
            $this->app['cache.store']->forget('extensions.all');
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('core.widgets', function () {
            return new \Yajra\CMS\Repositories\Widget\WidgetCacheRepository(
                new \Yajra\CMS\Repositories\Widget\WidgetEloquentRepository,
                $this->app['cache.store']
            );
        });

        $this->app->singleton('navigation', function () {
            return new \Yajra\CMS\Repositories\Navigation\CacheRepository(
                new \Yajra\CMS\Repositories\Navigation\EloquentRepository,
                $this->app['cache.store']
            );
        });

        $this->app->singleton('articles', function () {
            return new \Yajra\CMS\Repositories\Article\CacheRepository(
                new \Yajra\CMS\Repositories\Article\EloquentRepository,
                $this->app['cache.store']
            );
        });

        $this->app->singleton('categories', function () {
            return new \Yajra\CMS\Repositories\Category\CacheRepository(
                new \Yajra\CMS\Repositories\Category\EloquentRepository,
                $this->app['cache.store']
            );
        });

        $this->app->singleton('extensions', function () {
            return new \Yajra\CMS\Repositories\Extension\CacheRepository(
                new \Yajra\CMS\Repositories\Extension\EloquentRepository,
                $this->app['cache.store']
            );
        });

        $this->app->alias('articles', \Yajra\CMS\Repositories\Article\Repository::class);
        $this->app->alias('categories', \Yajra\CMS\Repositories\Category\Repository::class);
        $this->app->alias('navigation', \Yajra\CMS\Repositories\Navigation\Repository::class);
        $this->app->alias('extensions', \Yajra\CMS\Repositories\Extension\Repository::class);
        $this->app->alias('core.widgets', \Yajra\CMS\Repositories\Widget\WidgetRepository::class);
    }
}
