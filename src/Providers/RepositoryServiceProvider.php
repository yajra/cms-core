<?php

namespace Yajra\CMS\Providers;

use Illuminate\Support\ServiceProvider;
use Yajra\CMS\Contracts\Cacheable;
use Yajra\CMS\Entities\Extension;
use Yajra\CMS\Entities\Menu;
use Yajra\CMS\Entities\Navigation;
use Yajra\CMS\Entities\Widget;
use Yajra\CMS\Extension\EloquentRepository;
use Yajra\CMS\Repositories\Article\ArticleEloquentRepository;
use Yajra\CMS\Repositories\Article\ArticleRepository;
use Yajra\CMS\Repositories\Category\CategoryEloquentRepository;
use Yajra\CMS\Repositories\Category\CategoryRepository;
use Yajra\CMS\Repositories\Navigation\NavigationCacheRepository;
use Yajra\CMS\Repositories\Navigation\NavigationEloquentRepository;
use Yajra\CMS\Repositories\Navigation\NavigationRepository;
use Yajra\CMS\Repositories\Widget\WidgetCacheRepository;
use Yajra\CMS\Repositories\Widget\WidgetEloquentRepository;
use Yajra\CMS\Repositories\Widget\WidgetRepository;

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
            $this->app['cache.store']->forget('extension.widget.' . $model->id);
            $this->app['cache.store']->forget('extension.widget.all');
        });
        Extension::deleted(function ($model) {
            $this->app['cache.store']->forget('extension.widget.' . $model->id);
            $this->app['cache.store']->forget('extension.widget.all');
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(WidgetRepository::class, function () {
            return new WidgetCacheRepository(new WidgetEloquentRepository, $this->app['cache.store']);
        });

        $this->app->singleton(NavigationRepository::class, function () {
            return new NavigationCacheRepository(new NavigationEloquentRepository(), $this->app['cache.store']);
        });

        $this->app->singleton(ArticleRepository::class, ArticleEloquentRepository::class);
        $this->app->singleton(CategoryRepository::class, CategoryEloquentRepository::class);

        $this->app->singleton('extensions', function () {
            return new EloquentRepository(new Extension);
        });

        $this->app->singleton('widgets', function () {
            return new \Yajra\CMS\Widgets\CacheRepository(
                new \Yajra\CMS\Widgets\EloquentRepository,
                $this->app['cache.store']
            );
        });

        $this->app->alias('extensions', \Yajra\CMS\Extension\Repository::class);
        $this->app->alias('widgets', \Yajra\CMS\Widgets\Repository::class);
    }
}
