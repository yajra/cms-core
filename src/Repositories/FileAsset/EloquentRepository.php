<?php

namespace Yajra\CMS\Repositories\FileAsset;

use Yajra\CMS\Entities\FileAsset;
use Yajra\CMS\Repositories\RepositoryAbstract;

/**
 * Class FileAssetEloquentRepository
 *
 * @package Yajra\CMS\Repositories\Article
 */
class EloquentRepository extends RepositoryAbstract implements Repository
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
     * Get file asset by name.
     *
     * @param string $name
     * @param null $category
     * @return \Yajra\CMS\Entities\FileAsset
     */
    public function getByName($name, $category = null)
    {
        if (is_null($category)) {
            $category = config('asset.default');
        }

        return $this->getModel()
                    ->where('name', $name)
                    ->where('category', $category)
                    ->first();
    }
}