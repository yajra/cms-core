<?php

namespace Yajra\CMS\Repositories\FileAsset;

/**
 * Interface AssetRepository
 *
 * @package Yajra\CMS\Repositories\Article
 */
interface FileAssetRepository
{
    /**
     * Get all file assets.
     *
     * @return \Yajra\CMS\Entities\FileAsset
     */
    public function all();

    /**
     * Register admin required assets.
     */
    public function registerAdminRequireAssets();

    /**
     * Get file asset by name.
     *
     * @param string $name
     * @param null $category
     * @return \Yajra\CMS\Entities\FileAsset
     */
    public function getByName($name, $category = null);

    /**
     * Add site asset.
     *
     * @param string $type
     * @return \Roumen\Asset\Asset;
     */
    public function addAsset($type);
}