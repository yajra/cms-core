<?php

namespace Yajra\CMS\Theme;

use Illuminate\Contracts\Config\Repository as Config;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Collection;
use Symfony\Component\Finder\Finder;
use Yajra\CMS\Exceptions\ThemeNotFoundException;

class Repository
{
    use ValidatesRequests;

    /**
     * Registered themes collection.
     *
     * @var array
     */
    protected $themes = [];

    /**
     * @var \Symfony\Component\Finder\Finder
     */
    protected $finder;

    /**
     * @var \Illuminate\Contracts\Config\Repository
     */
    protected $config;

    /**
     * Repository constructor.
     *
     * @param \Symfony\Component\Finder\Finder $finder
     * @param Config $config
     */
    public function __construct(Finder $finder, Config $config)
    {
        $this->finder = $finder;
        $this->config = $config;
    }

    /**
     * Scan themes directory.
     */
    public function scan()
    {
        $files = $this->finder->create()->in($this->config->get('theme.path'))->name('theme.json');
        foreach ($files as $file) {
            $this->register($file);
        }
    }

    /**
     * Register theme.json file.
     *
     * @param \SplFileInfo $file
     * @throws \Exception
     */
    public function register($file)
    {
        $theme = json_decode(file_get_contents($file), true);

        $validator = $this->getValidationFactory()->make($theme, [
            'name'        => 'required',
            'theme'       => 'required',
            'version'     => 'required',
            'description' => 'required',
            'positions'   => 'required',
        ]);

        if ($validator->fails()) {
            throw new \Exception('Invalid theme configuration: ' . $file->getRealPath());
        }

        $this->themes[$theme['theme']] = new Theme(
            $theme['name'],
            $theme['theme'],
            $theme['version'],
            $theme['description'],
            (array) $theme['positions'],
            $theme
        );
    }

    /**
     * Get all themes.
     *
     * @return \Illuminate\Support\Collection
     */
    public function all()
    {
        return new Collection($this->themes);
    }

    /**
     * Get current frontend theme.
     *
     * @return \Yajra\CMS\Theme\Theme
     * @throws \Yajra\CMS\Exceptions\ThemeNotFoundException
     */
    public function current()
    {
        return $this->findOrFail($this->config->get('theme.frontend'));
    }

    /**
     * Find or fail a theme.
     *
     * @param string $theme
     * @return \Yajra\CMS\Theme\Theme
     * @throws \Yajra\CMS\Exceptions\ThemeNotFoundException
     */
    public function findOrFail($theme)
    {
        if (in_array($theme, array_keys($this->themes))) {
            return $this->themes[$theme];
        }

        throw new ThemeNotFoundException('Theme not found!');
    }

    /**
     * Uninstall a theme.
     *
     * @param string $theme
     * @return bool
     */
    public function uninstall($theme)
    {
        /** @var Filesystem $filesystem */
        $filesystem = app(Filesystem::class);
        $dir        = $this->getDirectoryPath($theme);

        return $filesystem->deleteDirectory($dir);
    }

    /**
     * Get directory path of the theme.
     *
     * @param string $theme
     * @return string
     */
    public function getDirectoryPath($theme)
    {
        return $this->getBasePath() . DIRECTORY_SEPARATOR . $theme;
    }

    /**
     * Get themes base path.
     *
     * @return string
     */
    public function getBasePath()
    {
        return $this->config->get('theme.path');
    }
}
