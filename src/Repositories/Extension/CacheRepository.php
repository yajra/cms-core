<?php

namespace Yajra\CMS\Repositories\Extension;

use Illuminate\Contracts\Cache\Repository as Cache;
use Illuminate\Foundation\Validation\ValidatesRequests;

class CacheRepository implements Repository
{
    use ValidatesRequests;

    /**
     * @var \Yajra\CMS\Repositories\Extension\Repository
     */
    protected $repository;

    /**
     * @var \Illuminate\Contracts\Cache\Repository
     */
    protected $cache;

    /**
     * CacheRepository constructor.
     *
     * @param \Yajra\CMS\Repositories\Extension\Repository $repository
     * @param \Illuminate\Contracts\Cache\Repository $cache
     */
    public function __construct(Repository $repository, Cache $cache)
    {
        $this->repository = $repository;
        $this->cache      = $cache;
    }

    /**
     * Install an extension.
     *
     * @param string $type
     * @param array $attributes
     * @return \Yajra\CMS\Entities\Extension
     */
    public function install($type, array $attributes)
    {
        return $this->repository->install($type, $attributes);
    }

    /**
     * Get all extensions.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {
        return $this->cache->rememberForever('extensions.all', function () {
            return $this->repository->all();
        });
    }

    /**
     * Uninstall extension.
     *
     * @param int $id
     * @throws \Exception
     */
    public function uninstall($id)
    {
        $this->repository->uninstall($id);
    }

    /**
     * Find or fail an extension.
     *
     * @param int $id
     * @return \Yajra\CMS\Entities\Extension
     */
    public function findOrFail($id)
    {
        return $this->cache->rememberForever('extension.' . $id, function () use ($id){
            return $this->repository->findOrFail($id);
        });
    }

    /**
     * Register an extension using manifest config file.
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
     * Register an extension.
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
     * Get all registered widgets.
     *
     * @return \Illuminate\Support\Collection
     */
    public function allWidgets()
    {
        return $this->cache->rememberForever('extensions.widgets', function () {
            return $this->repository->allWidgets();
        });
    }
}
