<?php

namespace Yajra\CMS\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\QueryException;
use Yajra\CMS\Entities\FileAsset;
use Yajra\CMS\Repositories\FileAsset\CacheRepository;
use Yajra\CMS\Repositories\FileAsset\EloquentRepository;
use Yajra\CMS\Repositories\FileAsset\Repository;
use Illuminate\Support\Facades\Blade;

/**
 * Class AssetServiceProvider
 *
 * @package Yajra\CMS\Providers
 */
class AssetServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        try {
            $this->customJsPlugin();
            $this->customCssPlugin();
            $this->addAssetAfter();
            $this->addAssetBefore();
        } catch (QueryException $e) {
            // \\_(",)_//
        }

        FileAsset::saved(function () {
            $this->app['cache.store']->forget('fileAssets.all');
        });
        FileAsset::deleted(function () {
            $this->app['cache.store']->forget('fileAssets.all');
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Repository::class, function () {
            return new CacheRepository(
                new EloquentRepository,
                $this->app['cache.store']
            );
        });
    }

    /**
     * Register custom javascript plugin.
     */
    protected function customJsPlugin()
    {
        Blade::directive('js', function ($expression) {
            return "<?php echo app(\\Yajra\\CMS\\View\\Directives\\AssetJsDirective::class)->handle{$expression} ?>";
        });
    }

    /**
     * Register custom css plugin.
     *
     * @return string
     */
    protected function customCssPlugin()
    {
        Blade::directive('css', function ($expression) {
            return "<?php echo app(\\Yajra\\CMS\\View\\Directives\\AssetCssDirective::class)->handle{$expression} ?>";
        });
    }

    /**
     * Add a css after the selected file.
     *
     * @return string
     */
    protected function addAssetAfter()
    {
        Blade::directive('assetAfter', function ($expression) {
            return "<?php echo app(\\Yajra\\CMS\\View\\Directives\\AssetAddAfterDirective::class)->handle{$expression} ?>";
        });
    }

    /**
     * Add a css before the selected file.
     *
     * @return string
     */
    protected function addAssetBefore()
    {
        Blade::directive('assetBefore', function ($expression) {
            return "<?php echo app(\\Yajra\\CMS\\View\\Directives\\AssetAddBeforeDirective::class)->handle{$expression} ?>";
        });
    }
}
