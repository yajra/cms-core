<?php

namespace Yajra\CMS\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Roumen\Asset\Asset;
use Yajra\CMS\Entities\Configuration;
use Yajra\CMS\Entities\FileAsset;
use Illuminate\Database\QueryException;

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
            $this->addAdminAssets();
            $this->requireAdminDefaultAssets();
            $this->assetJs();
            $this->assetCss();
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
    }

    /**
     * Load admin assets.
     */
    protected function addAdminAssets()
    {
        $this->addAssets('css');
        $this->addAssets('js');
    }

    /**
     * Load require admin default assets.
     */
    protected function requireAdminDefaultAssets()
    {
        foreach (config('asset.admin_required_assets', []) as $asset => $requiredValue) {
            Asset::add($requiredValue);
        }
    }

    /**
     * Load js assets.
     *
     * @return string
     */
    protected function assetJs()
    {
        Blade::directive('assetJs', function ($asset) {
            $asset = $this->getAssetUrlByname($this->strParser($asset . '.js'));

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
            $asset = $this->getAssetUrlByname($this->strParser($asset . '.css'));

            return '<?php echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"' . $asset->url . '\">"; ?>';
        });
    }

    /**
     * @param string $str
     * @return string
     */
    private function strParser($str)
    {
        return str_replace("'", '', str_replace(['(', ')'], '', $str));
    }

    /**
     * Get url by asset name.
     *
     * @param string $asset
     * @return FileAsset
     */
    private function getAssetUrlByname($asset)
    {
        return FileAsset::where('name', $asset)
                        ->where('category', Configuration::key('asset.default'))
                        ->first();
    }

    /**
     * @param string $type
     */
    protected function addAssets($type)
    {
        $assets = config('asset.admin_assets.' . $type);
        ksort($assets);
        foreach ($assets as $key => $value) {
            Asset::add($this->getAssetUrlByname($value)->url);
        }
    }
}
