<?php

namespace Yajra\CMS\Repositories\FileAsset;

use Illuminate\Contracts\Cache\Repository as Cache;

class FileAssetCacheRepository implements FileAssetRepository
{
    /**
     * @var \Yajra\CMS\Repositories\FileAsset\FileAssetRepository
     */
    private $repository;

    /**
     * @var \Illuminate\Contracts\Cache\Repository
     */
    private $cache;

    /**
     * FileAssetCacheRepository constructor.
     *
     * @param \Yajra\CMS\Repositories\FileAsset\FileAssetRepository $repository
     * @param \Illuminate\Contracts\Cache\Repository $cache
     */
    public function __construct(FileAssetRepository $repository, Cache $cache)
    {
        $this->repository = $repository;
        $this->cache      = $cache;
    }

    /**
     * Get all file assets.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {
        return $this->cache->rememberForever('fileAssets.all', function () {
            return $this->repository->all();
        });
    }

    /**
     * Register admin required assets.
     */
    public function registerAdminRequireAssets()
    {
        return $this->repository->registerAdminRequireAssets();
    }

    /**
     * Get file asset by name.
     *
     * @param string $name
     * @return FileAsset
     */
    public function getByName($name)
    {
        return $this->repository->getByName($name);
    }

    /**
     * Register css blade directive.
     */
    public function registerCssBlade()
    {
        return $this->repository->registerCssBlade();
    }

    /**
     * Register javascript blade directive.
     */
    public function registerJsBlade()
    {
        return $this->repository->registerJsBlade();
    }

    /**
     * Add site asset.
     *
     * @param string $type
     * @return \Roumen\Asset\Asset;
     */
    public function addAsset($type)
    {
        return $this->repository->addAsset($type);
    }
}