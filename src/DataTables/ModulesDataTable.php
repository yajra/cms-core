<?php

namespace Yajra\CMS\DataTables;

use Yajra\DataTables\CollectionDataTable;
use Yajra\DataTables\Services\DataTable;

class ModulesDataTable extends DataTable
{
    /**
     * Build DataTable api response.
     *
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable()
    {
        return (new CollectionDataTable($this->query()))
            ->editColumn('active', function ($module) {
                return $module['active'] ? 'Yes' : 'No';
            })
            ->addColumn('action', 'administrator.modules.datatables.action');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function query()
    {
        $collections = app('modules')->toCollection()->toArray();

        return collect($collections)->map(function ($module) {
            return $module;
        });
    }

    /**
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this
            ->builder()
            ->columns($this->getColumns())
            ->postAjax()
            ->parameters([
                'stateSave' => true,
                'order'     => [[0, 'desc']],
                'buttons'   => [
                    'export',
                    'print',
                    'reset',
                    'reload',
                ],
            ]);
    }

    /**
     * @return array
     */
    protected function getColumns()
    {
        return [
            [
                'data'  => 'action',
                'name'  => 'action',
                'title' => trans('cms::module.table.columns.action'),
                'width' => '60px',
            ],
            [
                'data'  => 'name',
                'name'  => 'name',
                'title' => trans('cms::module.table.columns.name'),
            ],
            [
                'data'  => 'alias',
                'name'  => 'alias',
                'title' => trans('cms::module.table.columns.alias'),
            ],
            [
                'data'  => 'description',
                'name'  => 'description',
                'title' => trans('cms::module.table.columns.description'),
            ],
            [
                'data'  => 'active',
                'name'  => 'active',
                'title' => trans('cms::module.table.columns.active'),
                'width' => '60px',
            ],
            [
                'data'  => 'order',
                'name'  => 'order',
                'title' => trans('cms::module.table.columns.order'),
                'width' => '60px',
            ],
        ];
    }
}
