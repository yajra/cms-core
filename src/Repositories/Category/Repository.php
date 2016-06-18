<?php

namespace Yajra\CMS\Repositories\Category;

interface Repository
{
    /**
     * Get all published articles.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllPublished();
}
