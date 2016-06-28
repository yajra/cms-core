<?php

namespace Yajra\CMS\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\CMS\DataTables\FileAssetsDataTable;
use Yajra\CMS\Entities\FileAsset;
use Yajra\CMS\Http\Requests\FileAssetFormRequest;

/**
 * Class FileAssetController
 *
 * @package Yajra\CMS\Http\Controllers
 */
class FileAssetController extends Controller
{
    /**
     * @param \Yajra\CMS\Http\Requests\FileAssetFormRequest $request
     * @return \Yajra\CMS\Entities\FileAsset
     */
    public function storeAsset(FileAssetFormRequest $request)
    {
        return FileAsset::create($request->all());
    }

    /**
     * Show all site assets.
     *
     * @param string $category
     * @param \Yajra\CMS\DataTables\FileAssetsDataTable $dataTable
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAssets($category, FileAssetsDataTable $dataTable)
    {
        return $dataTable->ajax();
    }

    /**
     * Remove selected asset.
     *
     * @param \Yajra\CMS\Entities\FileAsset $asset
     * @return bool|null
     */
    public function deleteAsset(FileAsset $asset)
    {
        $asset->delete();

        return $asset;
    }

    /**
     * Get selected asset information.
     *
     * @param \Yajra\CMS\Entities\FileAsset $asset
     * @return \Yajra\CMS\Entities\FileAsset
     */
    public function editAsset(FileAsset $asset)
    {
        return $asset;
    }

    /**
     * Update selected asset.
     *
     * @param \Yajra\CMS\Entities\FileAsset $asset
     * @param \Illuminate\Http\Request $request
     * @return \Yajra\CMS\Entities\FileAsset
     */
    public function updateAsset(FileAsset $asset, Request $request)
    {
        $this->validate($request, [
            'name'     => 'required',
            'type'     => 'required',
            'category' => 'required',
            'url'      => 'required',
        ]);
        $asset->fill($request->all());
        $asset->save();

        return $asset;
    }
}
