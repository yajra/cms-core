<?php

namespace Yajra\CMS\Providers;

use Yajra\CMS\Entities\Configuration;
use Illuminate\Database\QueryException;
use Illuminate\Support\ServiceProvider;

class ConfigurationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        try {
            Configuration::all()->each(function($config) {
                config()->set($config->key, $config->value);
            });
        } catch (QueryException $e) {
            // \\_(",)_//
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
