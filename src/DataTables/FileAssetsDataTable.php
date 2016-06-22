<?php

namespace Yajra\CMS\DataTables;

use Yajra\CMS\Entities\FileAsset;
use Yajra\Datatables\Services\DataTable;

class FileAssetsDataTable extends DataTable
{
    /**
     * Display ajax response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->editColumn('url', function (FileAsset $asset) {
                return '<small><a target="_blank" href="' . $asset->url . '">' . $asset->url . '</a></small>';
            })
            ->addColumn('action', 'administrator.configuration.datatables.action')
            ->make(true);
    }

    /**
     * Get the query object to be processed by datatables.
     *
     * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $assets = FileAsset::select()->where('category', config('asset.default'))
                           ->where('type', $this->request()->get('type'));

        return $this->applyScopes($assets);
    }
}
