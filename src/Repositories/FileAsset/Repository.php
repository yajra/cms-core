<?php

namespace Yajra\CMS\Repositories\FileAsset;

/**
 * Interface AssetRepository
 *
 * @package Yajra\CMS\Repositories\Article
 */
interface Repository
{
    /**
     * Get all file assets.
     *
     * @return \Yajra\CMS\Entities\FileAsset
     */
    public function all();

    /**
     * Get file asset by name.
     *
     * @param string $name
     * @param null $category
     * @return \Yajra\CMS\Entities\FileAsset
     */
    public function getByName($name, $category = null);
}