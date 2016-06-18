<?php

namespace Yajra\CMS\Repositories\Article;

interface Repository
{
    /**
     * Get all published articles.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllPublished();
}
