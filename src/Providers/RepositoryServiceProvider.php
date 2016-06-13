<?php

namespace Yajra\CMS\Providers;

use Yajra\CMS\Contracts\Cacheable;
use Yajra\CMS\Entities\Menu;
use Yajra\CMS\Entities\Navigation;
use Yajra\CMS\Entities\Widget;
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
use Illuminate\Support\ServiceProvider;

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
    }
}
