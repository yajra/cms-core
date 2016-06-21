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
     * Register admin required assets.
     */
    public function registerAdminRequireAssets();

    /**
     * Get file asset by name.
     *
     * @param string $name
     * @return FileAsset
     */
    public function getByName($name);

    /**
     * Register css blade directive.
     */
    public function registerCssBlade();

    /**
     * Register javascript blade directive.
     */
    public function registerJsBlade();

    /**
     * Add site asset.
     *
     * @param string $type
     * @return \Roumen\Asset\Asset;
     */
    public function addAsset($type);
}