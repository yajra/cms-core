<?php

namespace Yajra\CMS\Repositories\Category;

interface Repository
{
    /**
     * Get all published categories.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllPublished();
}
