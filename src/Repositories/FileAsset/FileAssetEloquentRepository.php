<?php

namespace Yajra\CMS\Repositories\FileAsset;

use Yajra\CMS\Entities\Configuration;
use Yajra\CMS\Entities\FileAsset;
use Yajra\CMS\Repositories\RepositoryAbstract;
use Roumen\Asset\Asset;
use Illuminate\Support\Facades\Blade;

/**
 * Class FileAssetEloquentRepository
 *
 * @package Yajra\CMS\Repositories\Article
 */
class FileAssetEloquentRepository extends RepositoryAbstract implements FileAssetRepository
{
    /**
     * Get repository model.
     *
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Builder
     */
    public function getModel()
    {
        return new FileAsset();
    }

    /**
     * Register admin required assets.
     */
    public function registerAdminRequireAssets()
    {
        foreach (config('asset.admin_required_assets', []) as $asset => $requiredValue) {
            Asset::add($requiredValue);
        }
    }

    /**
     * Get file asset by name.
     *
     * @param string $name
     * @return FileAsset
     */
    public function getByName($name)
    {
        return FileAsset::where('name', $name)
                        ->where('category', Configuration::key('asset.default'))
                        ->first();
    }

    /**
     * Register css blade directive.
     */
    public function registerCssBlade()
    {
        Blade::directive('assetCss', function ($asset) {
            $asset = $this->getByName($this->strParser($asset . '.css'));

            return '<?php echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"' . $asset->url . '\">"; ?>';
        });
    }

    /**
     * Register javascript blade directive.
     */
    public function registerJsBlade()
    {
        Blade::directive('assetJs', function ($asset) {
            $asset = $this->getByName($this->strParser($asset . '.js'));

            return '<?php echo "<script src=\"' . $asset->url . '\"></script>"; ?>';
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
     * Add site asset.
     *
     * @param string $type
     * @return \Roumen\Asset\Asset;
     */
    public function addAsset($type)
    {
        $assets = config('asset.admin_assets.' . $type);
        ksort($assets);
        foreach ($assets as $key => $value) {
            Asset::add($this->getByName($value)->url);
        }
    }
}