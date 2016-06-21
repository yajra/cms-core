<?php

namespace Yajra\CMS\Http\Controllers;

use Yajra\CMS\DataTables\FileAssetsDataTable;
use Yajra\CMS\Entities\Configuration;
use App\Http\Requests;
use Illuminate\Http\Request;

/**
 * Class SiteConfigurationController
 *
 * @package Yajra\CMS\Controllers
 */
class SiteConfigurationController extends Controller
{
    /**
     * Site configuration setup page.
     *
     * @param \Yajra\CMS\Entities\Configuration $configuration
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Configuration $configuration)
    {
        return view('administrator.configuration.index', compact('configuration'));
    }

    /**
     * Store submitted configurations.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function store(Request $request)
    {
        $cleanArray = $request->all();
        $array      = ['config' => $cleanArray['config']] + $cleanArray; // set config array value to first.

        $this->storeConfiguration($array);
    }

    /**
     * Run submitted configurations.
     *
     * @param array $array
     */
    protected function storeConfiguration($array)
    {
        foreach ($array as $key => $value) {
            if ($key == 'config') {
                $setKey = $value;
            } else {
                $cleanKey = $setKey . '.' . str_replace('AAA', '.', $key); // remove js replacement string.
                $this->removeByKey($cleanKey);
                Configuration::create(['key' => $cleanKey, 'value' => $value]);
            }
        }
    }

    /**
     * Remove configuration by key.
     *
     * @param string $key
     * @return Configuration
     */
    protected function removeByKey($key)
    {
        return Configuration::where('key', $key)->delete();
    }

    /**
     * Show all site assets.
     *
     * @param \Yajra\CMS\DataTables\FileAssetsDataTable $dataTable
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAssets(FileAssetsDataTable $dataTable)
    {
        return $dataTable->ajax();
    }
}
