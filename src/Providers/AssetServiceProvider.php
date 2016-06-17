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
        $this->addAdminAssets();
        $this->requireAdminDefaultAssets();
    }

    /**
     * Add theme assets.
     */
    protected function addAdminAssets()
    {
        foreach (config('site.admin_assets.' . config('site.admin_assets.default'), []) as $asset => $value) {
            Asset::add($value);
        }
    }

    /**
     * Add require default assets.
     */
    protected function requireAdminDefaultAssets()
    {
        foreach (config('site.admin_assets.required_assets', []) as $asset => $requiredValue) {
            Asset::add($requiredValue);
        }
    }
}
