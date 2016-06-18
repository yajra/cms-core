<?php

namespace Yajra\CMS\Widgets\Repositories;

interface Repository
{
    /**
     * Register a widget using manifest config file.
     *
     * @param string $path
     * @throws \Exception
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function registerManifest($path);

    /**
     * Register a widget.
     *
     * @param array $attributes
     * @return $this
     * @throws \Exception
     */
    public function register(array $attributes);

    /**
     * Find or fail a widget.
     *
     * @param int $id
     * @return \Yajra\CMS\Entities\Extension
     * @throws \Yajra\CMS\Exceptions\WidgetNotFoundException
     */
    public function findOrFail($id);

    /**
     * Get all registered widgets.
     *
     * @return \Illuminate\Support\Collection
     */
    public function all();
}
