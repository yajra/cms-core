<?php

namespace Yajra\CMS\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\QueryException;
use Yajra\CMS\Entities\FileAsset;
use Yajra\CMS\Repositories\FileAsset\FileAssetCacheRepository;
use Yajra\CMS\Repositories\FileAsset\FileAssetEloquentRepository;
use Yajra\CMS\Repositories\FileAsset\FileAssetRepository;
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
     * Register javascript blade directive.
     */
    protected function assetJs()
    {
        Blade::directive('assetJs', function ($asset) {
            $asset = $this->app->make(FileAssetRepository::class)->getByName(
                $this->app->make(FileAssetRepository::class)->strParser($asset . '.js')
            );

            return '<?php echo "<script src=\"' . $asset->url . '\"></script>"; ?>';
        });
    }

    /**
     * Load css assets.
     *
     * @return string
     */
    protected function assetCss()
    {
        Blade::directive('assetCss', function ($asset) {
            $asset = $this->app->make(FileAssetRepository::class)->getByName(
                $this->app->make(FileAssetRepository::class)->strParser($asset . '.css')
            );

            return '<?php echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"' . $asset->url . '\">"; ?>';
        });
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
