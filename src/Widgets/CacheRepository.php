<?php

namespace Yajra\CMS\Widgets;

use Illuminate\Contracts\Cache\Repository as Cache;
use Illuminate\Support\Str;

class CacheRepository implements Repository
{
    /**
     * @var \Yajra\CMS\Widgets\EloquentRepository
     */
    protected $repository;

    /**
     * @var \Illuminate\Contracts\Cache\Repository
     */
    protected $cache;

    /**
     * CacheRepository constructor.
     *
     * @param \Yajra\CMS\Widgets\EloquentRepository $repository
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
     * @param string $name
     * @return \Yajra\CMS\Widgets\Widget
     * @throws \Yajra\CMS\Widgets\NotFoundException
     */
    public function findOrFail($name)
    {
        $name = Str::lower($name);

        return $this->cache->rememberForever("extension.widget.$name", function () use ($name) {
            return $this->repository->findOrFail($name);
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
