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
     * Get all file assets.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {
        return $this->getModel()->query()->get();
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
        return $this->getModel()
                    ->where('name', $name)
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
     * @param string $type
     * @param string $status
     * @return \Illuminate\Database\Eloquent\Model|null|static
     */
    private function getByTypeAndStatus($type, $status = null)
    {
        return $this->getModel()
                    ->where('type', $type)
                    ->where('category', Configuration::key('asset.default'))
                    ->where('asset', $status)
                    ->orderBy('order', 'asc')
                    ->get();
    }

    /**
     * Add site asset.
     *
     * @param string $type
     * @return \Roumen\Asset\Asset;
     */
    public function addAsset($type)
    {
        $assets = $this->getByTypeAndStatus($type, 'admin');
        foreach ($assets as $asset) {
            Asset::add($asset->url);
        }
    }
}