<?php

namespace Yajra\CMS\Providers;

use Illuminate\Support\Facades\Blade;
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
        $siteAssets = config('asset.assets.' . config('asset.default'));
        $this->addAdminAssets($siteAssets);
        $this->requireAdminDefaultAssets();
        $this->assetJs($siteAssets);
        $this->assetCss($siteAssets);
    }

    /**
     * Add admin assets.
     *
     * @param array $siteAssets
     */
    protected function addAdminAssets($siteAssets)
    {
        foreach (config('asset.admin_assets', []) as $asset => $value) {
            Asset::add(array_get($siteAssets, $value));
        }
    }

    /**
     * Add require admin default assets.
     */
    protected function requireAdminDefaultAssets()
    {
        foreach (config('asset.admin_required_assets', []) as $asset => $requiredValue) {
            Asset::add($requiredValue);
        }
    }

    /**
     * Generate Javascript assets.
     *
     * @param string $siteAssets
     * @return string
     */
    protected function assetJs($siteAssets)
    {
        Blade::directive('assetJs', function ($asset) use ($siteAssets) {
            $setAsset = $this->strParser($asset . '.js');

            return '<?php echo "<script src=\"' . array_get($siteAssets, $setAsset) . '\"></script>"; ?>';
        });
    }

    /**
     * Generate CSS assets.
     *
     * @param string $siteAssets
     * @return string
     */
    protected function assetCss($siteAssets)
    {
        Blade::directive('assetCss', function ($asset) use ($siteAssets) {
            $setAsset = $this->strParser($asset . '.css');

            return '<link rel=\"stylesheet\" type=\"text/css\" href=\"' . array_get($siteAssets, $setAsset) . '\">';
        });
    }

    /**
     * @param string $asset
     * @return string
     */
    private function strParser($asset)
    {
        $replaceBrackets = str_replace(['(', ')'], '', $asset);

        return str_replace("'", '', $replaceBrackets);
    }
}
