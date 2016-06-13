<?php

namespace Yajra\CMS\Repositories\Widget;

use Illuminate\Contracts\Cache\Repository as Cache;

class WidgetCacheRepository implements WidgetRepository
{
    /**
     * @var \Yajra\CMS\Repositories\Widget\WidgetRepository
     */
    protected $repository;

    /**
     * @var \Illuminate\Contracts\Cache\Repository
     */
    protected $cache;

    /**
     * WidgetCacheRepository constructor.
     *
     * @param \Yajra\CMS\Repositories\Widget\WidgetRepository $repository
     * @param \Illuminate\Contracts\Cache\Repository $cache
     */
    public function __construct(WidgetRepository $repository, Cache $cache)
    {
        $this->repository = $repository;
        $this->cache      = $cache;
    }

    /**
     * Get all widgets.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {
        return $this->cache->rememberForever('widgets.all', function () {
            return $this->repository->all();
        });
    }

    /**
     * Get all published widgets.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getPublished()
    {
        return $this->cache->rememberForever('widgets.published', function () {
            return $this->repository->getPublished();
        });
    }
}