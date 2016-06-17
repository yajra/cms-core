<?php

namespace Yajra\CMS\Widgets;

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
     * @param string $name
     * @return \Yajra\CMS\Widgets\Widget
     * @throws \Yajra\CMS\Widgets\NotFoundException
     */
    public function findOrFail($name);

    /**
     * Get all registered widgets.
     *
     * @return \Illuminate\Support\Collection
     */
    public function all();
}
