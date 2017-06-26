<?php

namespace Yajra\CMS\DataTables;

use Yajra\Datatables\Services\DataTable;

class ModulesDataTable extends DataTable
{
    /**
     * Build DataTable api response.
     *
     * @return \Yajra\Datatables\Engines\BaseEngine
     */
    public function dataTable()
    {
        return $this->datatables
            ->collection($this->query())
            ->editColumn('active', function ($module) {
                return $module['active'] ? 'Yes' : 'No';
            })
            ->addColumn('action', 'administrator.modules.datatables.action');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $collections = app('modules')->toCollection()->toArray();
        $modules     = collect($collections)->map(function ($module) {
            return $module;
        });

        return $this->applyScopes($modules);
    }

    /**
     * @return \Yajra\Datatables\Html\Builder
     */
    public function html()
    {
        return $this
            ->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
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
