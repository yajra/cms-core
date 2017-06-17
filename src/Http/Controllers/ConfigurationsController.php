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
     * List of array key where value should be hidden.
     *
     * @var array
     */
    protected $hidden = ['password'];

    /**
     * Site configuration setup page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $config = collect(trans('cms::config.setup'));

        return view('administrator.configuration.index', compact('config'));
    }

    /**
     * Store submitted configurations.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
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

        return $this->notifySuccess(trans('cms::config.success', ['config' => $config]));
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
            return $this->filter($config);
        }

        return response()->json(
            $this->filter(array_only($config, $this->limits[$key]))
        );
    }

    /**
     * Filter array response.
     *
     * @param array $array
     * @return array
     */
    protected function filter(array $array)
    {
        $config = collect(array_dot($array))->map(function ($value, $key) {
            if (str_contains($key, $this->hidden)) {
                return '';
            }

            return $value;
        });

        $array = [];
        foreach ($config as $key => $value) {
            array_set($array, $key, $value);
        }

        return $array;
    }
}
