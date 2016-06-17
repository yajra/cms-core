<?php

namespace Yajra\CMS\Providers;

use Illuminate\Support\ServiceProvider;
use Roumen\Asset\Asset;

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
        foreach (config('site.admin-assets.' . config('site.admin-assets.default'), []) as $asset => $value) {
            Asset::add($value);
        }
        foreach (config('site.admin-assets.admin-required-assets', []) as $asset => $requiredValue) {
            Asset::add($requiredValue);
        }
    }
}
