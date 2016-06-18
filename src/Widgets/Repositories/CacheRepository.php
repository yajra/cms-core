<?php

namespace Yajra\CMS\Widgets\Repositories;

use Illuminate\Contracts\Cache\Repository as Cache;
use Illuminate\Support\Str;

class CacheRepository implements Repository
{
    /**
     * @var \Yajra\CMS\Widgets\Repositories\EloquentRepository
     */
    protected $repository;

    /**
     * @var \Illuminate\Contracts\Cache\Repository
     */
    protected $cache;

    /**
     * CacheRepository constructor.
     *
     * @param \Yajra\CMS\Widgets\Repositories\EloquentRepository $repository
     * @param \Illuminate\Contracts\Cache\Repository $cache
     */
    public function __construct(EloquentRepository $repository, Cache $cache)
    {
        $this->repository = $repository;
        $this->cache      = $cache;
    }

    /**
     * Register a widget using manifest config file.
     *
     * @param string $path
     * @throws \Exception
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function registerManifest($path)
    {
        $this->repository->registerManifest($path);
    }

    /**
     * Register a widget.
     *
     * @param array $attributes
     * @return $this
     * @throws \Exception
     */
    public function register(array $attributes)
    {
        return $this->repository->register($attributes);
    }

    /**
     * Find or fail a widget.
     *
     * @param int $id
     * @return \Yajra\CMS\Widgets\Widget
     * @throws \Yajra\CMS\Exceptions\WidgetNotFoundException
     */
    public function findOrFail($id)
    {
        $id = Str::lower($id);

        return $this->cache->rememberForever("extension.widget.$id", function () use ($id) {
            return $this->repository->findOrFail($id);
        });
    }

    /**
     * Get all registered widgets.
     *
     * @return \Illuminate\Support\Collection
     */
    public function all()
    {
        return $this->cache->rememberForever("extension.widget.all", function () {
            return $this->repository->all();
        });
    }
}
