<?php

namespace Yajra\CMS\DataTables;

use Yajra\Datatables\Services\DataTable;

class ModulesDataTable extends DataTable
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        return $this->datatables
            ->collection($this->query())
            ->editColumn('active', function ($module) {
                return $module['active'] ? 'Yes' : 'No';
            })
            ->addColumn('action', 'administrator.modules.datatables.action')
            ->make(true);
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
            ->addAction(['width' => '80px'])
            ->parameters([
                'stateSave' => true,
                'order'     => [[0, 'desc']],
                'buttons'   => [
//                    [
//                        'extend' => 'create',
//                        'text'   => '<i class="fa fa-plus"></i>&nbsp;&nbsp;' . trans('cms::module.table.buttons.create'),
//                    ],
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
            'name'   => ['title' => trans('cms::module.table.columns.name')],
            'alias'  => ['title' => trans('cms::module.table.columns.alias')],
            'active' => ['title' => trans('cms::module.table.columns.active')],
            'order'  => ['title' => trans('cms::module.table.columns.order')],
        ];
    }
}
