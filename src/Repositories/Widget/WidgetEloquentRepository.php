<?php

namespace Yajra\CMS\Repositories\Widget;

use Yajra\CMS\Entities\Widget;
use Yajra\CMS\Repositories\RepositoryAbstract;

class WidgetEloquentRepository extends RepositoryAbstract implements WidgetRepository
{
    /**
     * Get all widgets.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {
        return $this->getModel()->query()->get();
    }

    /**
     * Get repository model.
     *
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Builder
     */
    public function getModel()
    {
        return new Widget;
    }

    /**
     * Get all published widgets.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getPublished()
    {
        return $this->getModel()->query()->with('permissions')->published()->get();
    }
}
