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
        foreach (config('site.assets.' . config('site.assets.default')) as $asset => $value) {
            Asset::add($value);
        }
        foreach (config('site.assets.admin-required') as $asset => $requiredValue) {
            Asset::add($requiredValue);
        }
    }
}
