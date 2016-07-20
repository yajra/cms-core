<?php

namespace Yajra\CMS\Repositories\Category;

use Yajra\CMS\Entities\Category;
use Yajra\CMS\Repositories\RepositoryAbstract;

class EloquentRepository extends RepositoryAbstract implements Repository
{
    /**
     * Get all published articles.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllPublished()
    {
        return $this->getModel()->published()->orderBy('depth', 'desc')->get();
    }

    /**
     * Get repository model.
     *
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Builder
     */
    public function getModel()
    {
        return new Category;
    }
}
