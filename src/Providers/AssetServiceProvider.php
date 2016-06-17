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
        $this->requireDefaultAssets();
    }

    /**
     * Add theme assets.
     */
    protected function addAdminAssets()
    {
        foreach (config('site.admin-assets.' . config('site.admin-assets.default'), []) as $asset => $value) {
            Asset::add($value);
        }
    }

    /**
     * Add require default assets.
     */
    protected function requireDefaultAssets()
    {
        foreach (config('site.admin-assets.admin-required-assets', []) as $asset => $requiredValue) {
            Asset::add($requiredValue);
        }
    }
}
