<?php

namespace Yajra\CMS\Repositories\Extension;

interface Repository
{
    /**
     * Install an extension.
     *
     * @param string $type
     * @param array $attributes
     * @return \Yajra\CMS\Entities\Extension
     */
    public function install($type, array $attributes);

    /**
     * Get all extensions.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all();

    /**
     * Uninstall extension.
     *
     * @param int $id
     * @throws \Exception
     */
    public function uninstall($id);

    /**
     * Find or fail an extension.
     *
     * @param int $id
     * @return \Yajra\CMS\Entities\Extension
     */
    public function findOrFail($id);

    /**
     * Register an extension using manifest config file.
     *
     * @param string $path
     * @throws \Exception
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function registerManifest($path);

    /**
     * Register an extension.
     *
     * @param array $attributes
     * @return $this
     * @throws \Exception
     */
    public function register(array $attributes);

    /**
     * Get all registered widgets.
     *
     * @return \Illuminate\Support\Collection
     */
    public function allWidgets();
}
