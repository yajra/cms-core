<?php

namespace Yajra\CMS\Repositories\Article;

interface ArticleRepository
{
    /**
     * Get all published articles.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllPublished();
}