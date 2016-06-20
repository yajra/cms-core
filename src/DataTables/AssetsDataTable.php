<?php

namespace Yajra\CMS\DataTables;

use Yajra\CMS\Entities\FileAsset;
use Yajra\Datatables\Services\DataTable;

class AssetsDataTable extends DataTable
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
            ->editColumn('name', function ($asset) {
                $label = $asset->type == 'css' ? 'success' : 'warning';
                $type  = $asset->type == 'css' ? 'css' : 'javascript';

                return $asset->name . " &nbsp;<span class=\"label label-{$label}\">{$type}</span>";
            })
            ->make(true);
    }

    /**
     * Get the query object to be processed by datatables.
     *
     * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $assets = FileAsset::select()
                           ->where('category', config('asset.default'))
                           ->where('type', $this->request()->get('type'))
                           ->orderBy('order', 'asc');

        return $this->applyScopes($assets);
    }
}
