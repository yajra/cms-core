<?php

namespace Yajra\CMS\Repositories\Theme;

interface Repository
{
    /**
     * Scan themes directory.
     */
    public function scan();

    /**
     * Register theme.json file.
     *
     * @param \SplFileInfo $file
     * @throws \Exception
     */
    public function register($file);

    /**
     * Get all themes.
     *
     * @return \Illuminate\Support\Collection
     */
    public function all();

    /**
     * Get current frontend theme.
     *
     * @return \Yajra\CMS\Theme\Theme
     * @throws \Yajra\CMS\Exceptions\ThemeNotFoundException
     */
    public function current();

    /**
     * Find or fail a theme.
     *
     * @param string $theme
     * @return \Yajra\CMS\Theme\Theme
     * @throws \Yajra\CMS\Exceptions\ThemeNotFoundException
     */
    public function findOrFail($theme);

    /**
     * Uninstall a theme.
     *
     * @param string $theme
     * @return bool
     */
    public function uninstall($theme);

    /**
     * Get directory path of the theme.
     *
     * @param string $theme
     * @return string
     */
    public function getDirectoryPath($theme);

    /**
     * Get themes base path.
     *
     * @return string
     */
    public function getBasePath();
}
