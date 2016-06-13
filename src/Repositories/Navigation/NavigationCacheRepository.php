<?php

namespace Yajra\CMS\Repositories\Navigation;

use Illuminate\Contracts\Cache\Repository as Cache;

/**
 * Class NavigationCacheRepository
 *
 * @package App\Repositories\Administrator\Navigation
 */
class NavigationCacheRepository implements NavigationRepository
{
    /**
     * @var \Yajra\CMS\Repositories\Navigation\NavigationRepository
     */
    protected $repository;

    /**
     * @var \Illuminate\Contracts\Cache\Repository
     */
    protected $cache;

    /**
     * NavigationRepository constructor.
     *
     * @param \Yajra\CMS\Repositories\Navigation\NavigationRepository $repository
     * @param \Illuminate\Contracts\Cache\Repository $cache
     */
    public function __construct(NavigationRepository $repository, Cache $cache)
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
}