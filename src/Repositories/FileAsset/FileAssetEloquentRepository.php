<?php

namespace Yajra\CMS\Repositories\FileAsset;

use Yajra\CMS\Entities\FileAsset;
use Yajra\CMS\Repositories\RepositoryAbstract;

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
}