<?php

namespace Yajra\CMS\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\QueryException;
use Yajra\CMS\Entities\FileAsset;
use Yajra\CMS\Repositories\FileAsset\FileAssetCacheRepository;
use Yajra\CMS\Repositories\FileAsset\FileAssetEloquentRepository;
use Yajra\CMS\Repositories\FileAsset\FileAssetRepository;

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
            $this->addAssets('css');
            $this->addAssets('js');
            $this->requireAdminDefaultAssets();
            $this->assetJs();
            $this->assetCss();
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
        $this->app->singleton(FileAssetRepository::class, function () {
            return new FileAssetCacheRepository(
                new FileAssetEloquentRepository,
                $this->app['cache.store']
            );
        });
    }

    /**
     * Load require admin default assets.
     */
    protected function requireAdminDefaultAssets()
    {
        $this->app->make(FileAssetRepository::class)->registerAdminRequireAssets();
    }

    /**
     * Load js assets.
     *
     * @return string
     */
    protected function assetJs()
    {
        return $this->app->make(FileAssetRepository::class)->registerJsBlade();
    }

    /**
     * Load css assets.
     *
     * @return string
     */
    protected function assetCss()
    {
        return $this->app->make(FileAssetRepository::class)->registerCssBlade();
    }

    /**
     * Add site assets.
     *
     * @param string $type
     */
    protected function addAssets($type)
    {
        return $this->app->make(FileAssetRepository::class)->addAsset($type);
    }
}
