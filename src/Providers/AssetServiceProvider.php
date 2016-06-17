<?php

namespace Yajra\CMS\Providers;

use Illuminate\Support\ServiceProvider;
use Roumen\Asset\Asset;

/**
 * Class AssetServiceProvider
 *
 * @package Yajra\CMS\Providers
 */
class AssetServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $siteAssets = config('site.assets.' . config('site.assets.default'));
        $this->addAdminAssets($siteAssets);
        $this->requireAdminDefaultAssets();
        Blade::directive('asset', function ($asset) use ($siteAssets) {
            $replaceBrackets = str_replace(['(', ')'], '', $asset);
            $setAsset        = str_replace("'", '', $replaceBrackets);
            Asset::add(array_get($siteAssets, $setAsset));
        });
    }

    /**
     * Add admin assets.
     *
     * @param array $siteAssets
     */
    protected function addAdminAssets($siteAssets)
    {
        foreach (config('site.admin_assets', []) as $asset => $value) {
            Asset::add(array_get($siteAssets, $value));
        }
    }

    /**
     * Add require admin default assets.
     */
    protected function requireAdminDefaultAssets()
    {
        foreach (config('site.admin_required_assets', []) as $asset => $requiredValue) {
            Asset::add($requiredValue);
        }
    }
}
