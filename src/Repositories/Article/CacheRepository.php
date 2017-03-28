<?php

namespace Yajra\CMS\Repositories\Article;

use Illuminate\Contracts\Cache\Repository as Cache;

class CacheRepository implements Repository
{
    /**
     * @var \Yajra\CMS\Repositories\Article\Repository
     */
    protected $repository;

    /**
     * @var \Illuminate\Contracts\Cache\Repository
     */
    protected $cache;

    /**
     * CacheRepository constructor.
     *
     * @param \Yajra\CMS\Repositories\Article\Repository $repository
     * @param \Illuminate\Contracts\Cache\Repository $cache
     */
    public function __construct(Repository $repository, Cache $cache)
    {
        $this->repository = $repository;
        $this->cache      = $cache;
    }

    /**
     * Get all published articles.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllPublished()
    {
        return $this->cache->rememberForever('articles.published', function () {
            return $this->repository->getAllPublished();
        });
    }
}
