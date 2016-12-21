<?php

namespace Yajra\CMS\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\CMS\Entities\Configuration;

/**
 * Class SiteConfigurationController
 *
 * @package Yajra\CMS\Controllers
 */
class ConfigurationsController extends Controller
{
    /**
     * Limit the config results based on given key.
     *
     * @var array
     */
    protected $limits = [
        'site'     => ['name', 'version', 'keywords', 'author', 'description', 'admin_theme', 'registration'],
        'app'      => ['name', 'debug', 'debugbar', 'env', 'locale', 'log', 'timezone', 'url'],
        'database' => ['default', 'connections', 'migrations', 'redis'],
    ];

    /**
     * Site configuration setup page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $config = $this->setupConfig();

        return view('administrator.configuration.index', compact('config'));
    }

    /**
     * Get configuration setup.
     *
     * @return \Illuminate\Support\Collection
     */
    protected function setupConfig()
    {
        return collect([
            [
                'title' => 'Site Management',
                'key'   => 'site',
                'icon'  => 'fa-cog',
            ],
            [
                'title' => 'Application Environment',
                'key'   => 'app',
                'icon'  => 'fa-laptop',
            ],
            [
                'title' => 'Database Connection',
                'key'   => 'database',
                'icon'  => 'fa-database',
            ],
            [
                'title' => 'Mail Driver',
                'key'   => 'mail',
                'icon'  => 'fa-envelope',
            ],
            [
                'title' => 'Cache Store',
                'key'   => 'cache',
                'icon'  => 'fa-cloud-download',
            ],
            [
                'title' => 'Session Driver',
                'key'   => 'session',
                'icon'  => 'fa-comment-o',
            ],
            [
                'title' => 'File System',
                'key'   => 'filesystems',
                'icon'  => 'fa-briefcase',
            ],
        ]);
    }

    /**
     * Store submitted configurations.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function store(Request $request)
    {
        $config = $request->input('config');

        foreach (array_dot($request->input('data')) as $key => $value) {
            $path = $config . '.' . $key;
            $this->destroy($path);
            if (is_array($value)) {
                $value = implode(',', $value);
            }
            Configuration::create(['key' => $path, 'value' => $value]);
        }

        return $this->notifySuccess("Configuation ($config) successfully saved! You may need to refresh the page to reflect some changes.");
    }

    /**
     * Remove configuration by key.
     *
     * @param string $key
     * @return Configuration
     */
    public function destroy($key)
    {
        return Configuration::where('key', $key)->delete();
    }

    /**
     * Show configuration by key.
     *
     * @param string $key
     * @return array|mixed
     */
    public function show($key)
    {
        $config = config($key) ?? [];

        if (! isset($this->limits[$key])) {
            return $config;
        }

        return response()->json(array_only($config, $this->limits[$key]));
    }
}
