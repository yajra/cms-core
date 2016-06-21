<?php

namespace Yajra\CMS\Repositories\FileAsset;

use Yajra\CMS\Entities\Configuration;
use Yajra\CMS\Entities\FileAsset;
use Yajra\CMS\Entities\FileAssetGroup;
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
     * @return \Yajra\CMS\Entities\FileAsset
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
     * @return \Yajra\CMS\Entities\FileAsset
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
     * Get file asset by type and name.
     *
     * @param string $type
     * @param string $name
     * @return \Yajra\CMS\Entities\FileAsset
     */
    private function getByTypeAndName($type, $name)
    {
        return $this->getModel()
                    ->where('type', $type)
                    ->where('name', $name)
                    ->where('category', Configuration::key('asset.default'))
                    ->first();
    }

    /**
     * Add site asset.
     *
     * @param string $type
     * @return \Roumen\Asset\Asset;
     */
    public function addAsset($type)
    {
        $backEndAssets = $this->getGroupByType($type, 'backend');
        foreach ($backEndAssets as $asset) {
            Asset::add($this->getByTypeAndName($type, $asset->file_asset_name)->url);
        }
    }

    /**
     * Get asset group by type and user.
     *
     * @param string $type
     * @param string $user
     * @return \Yajra\CMS\Entities\FileAssetGroup
     */
    public function getGroupByType($type, $user)
    {
        return FileAssetGroup::where('type', $type)
                             ->orderBy('order', 'asc')
                             ->orderBy('user', $user)
                             ->get();
    }
}