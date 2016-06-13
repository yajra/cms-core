<?php

namespace Yajra\CMS\Repositories\Article;

use Yajra\CMS\Entities\Article;
use Yajra\CMS\Repositories\RepositoryAbstract;

class ArticleEloquentRepository extends RepositoryAbstract implements ArticleRepository
{
    /**
     * Get repository model.
     *
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Builder
     */
    public function getModel()
    {
        return new Article;
    }

    /**
     * Get all published articles.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllPublished()
    {
        return $this->getModel()->with('permissions')->published()->get();
    }
}