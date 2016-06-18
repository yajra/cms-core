<?php

namespace Yajra\CMS\Repositories\Navigation;

use Illuminate\Contracts\Cache\Repository as Cache;

class CacheRepository implements Repository
{
    /**
     * @var \Yajra\CMS\Repositories\Navigation\Repository
     */
    protected $repository;

    /**
     * @var \Illuminate\Contracts\Cache\Repository
     */
    protected $cache;

    /**
     * NavigationRepository constructor.
     *
     * @param \Yajra\CMS\Repositories\Navigation\Repository $repository
     * @param \Illuminate\Contracts\Cache\Repository $cache
     */
    public function __construct(Repository $repository, Cache $cache)
    {
        $this->repository = $repository;
        $this->cache      = $cache;
    }

    /**
     * Get all navigation.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {
        return $this->cache->rememberForever('navigation.all', function () {
            return $this->repository->all();
        });
    }

    /**
     * Get all published navigation.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getPublished()
    {
        return $this->cache->rememberForever('navigation.published', function () {
            return $this->repository->getPublished();
        });
    }

    /**
     * Find or fail a navigation.
     *
     * @param int $id
     * @return \Yajra\CMS\Entities\Navigation
     */
    public function findOrFail($id)
    {
        return $this->repository->findOrFail($id);
    }
}
