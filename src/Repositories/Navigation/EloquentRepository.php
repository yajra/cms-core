<?php

namespace Yajra\CMS\Repositories\Navigation;

use Yajra\CMS\Entities\Navigation;
use Yajra\CMS\Repositories\RepositoryAbstract;

class EloquentRepository extends RepositoryAbstract implements Repository
{
    /**
     * Get all published navigation.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getPublished()
    {
        return $this->getModel()->with([
            'menus' => function ($query) {
                $query->limitDepth(1)->orderBy('order', 'asc');
            },
            'menus.permissions',
            'menus.children',
        ])->published()->get();
    }

    /**
     * Get repository model.
     *
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Builder
     */
    public function getModel()
    {
        return new Navigation();
    }

    /**
     * Find or fail a navigation.
     *
     * @param int $id
     * @return \Yajra\CMS\Entities\Navigation
     */
    public function findOrFail($id)
    {
        return $this->getModel()->query()->findOrFail($id);
    }
}
