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
        $siteAssets = config('site.assets.' . config('site.assets.default'));
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

    /**
     * Generate Javascript assets.
     *
     * @param string $siteAssets
     * @return string
     */
    protected function assetJs($siteAssets)
    {
        Blade::directive('assetJs', function ($asset) use ($siteAssets) {
            $replaceBrackets = str_replace(['(', ')'], '', $asset . '.js');
            $setAsset        = str_replace("'", '', $replaceBrackets);

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
            $replaceBrackets = str_replace(['(', ')'], '', $asset . '.css');
            $setAsset        = str_replace("'", '', $replaceBrackets);

            return '<link rel=\"stylesheet\" type=\"text/css\" href=\"' . array_get($siteAssets, $setAsset) . '\">';
        });
    }
}
