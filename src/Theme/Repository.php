<?php

namespace Yajra\CMS\Theme;

use Illuminate\Contracts\Config\Repository as Config;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Collection;
use Symfony\Component\Finder\Finder;

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
     * Find or fail a theme.
     *
     * @param string $theme
     * @return mixed
     * @throws \Yajra\CMS\Theme\NotFoundException
     */
    public function findOrFail($theme)
    {
        if (in_array($theme, array_keys($this->themes))) {
            return $this->themes[$theme];
        }

        throw new NotFoundException('Theme not found!');
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
}
