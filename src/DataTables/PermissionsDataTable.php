<?php

namespace Yajra\CMS\DataTables;

use Yajra\Acl\Models\Permission;
use Yajra\Datatables\Services\DataTable;

class PermissionsDataTable extends DataTable
{
    /**
     * @return \Yajra\Datatables\Html\Builder
     */
    public function html()
    {
        return $this
            ->builder()
            ->columns($this->getColumns())
            ->addAction(['width' => '60px'])
            ->parameters($this->getBuilderParameters());
    }

    /**
     * @return array
     */
    private function getColumns()
    {
        return [
            'id',
            'resource',
            'name',
            'slug',
            'system' => ['class' => 'text-center', 'width' => '30px', 'title' => 'Sys'],
            'roles'  => [
                'class'      => 'text-center',
                'width'      => '30px',
                'searchable' => false,
                'orderable'  => false,
                'printable'  => false,
            ],
            'created_at',
            'updated_at',
        ];
    }

    /**
     * Get builder params.
     *
     * @return array
     */
    protected function getBuilderParameters()
    {
        return array_merge_recursive(['buttons' => ['resource']], [
            'order'     => [[0, 'desc']],
            'buttons'   => [
                [
                    'extend' => 'create',
                    'text'   => '<i class="fa fa-plus"></i>&nbsp;&nbsp;' . trans('cms::permission.datatable.buttons.create'),
                ],
                'export',
                'print',
                'reset',
                'reload',
            ],
            'stateSave' => true,
        ]);
    }

    /**
     * Build DataTable api response.
     *
     * @return \Yajra\Datatables\Engines\BaseEngine
     */
    protected function dataTable()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->addColumn('roles', function (Permission $permission) {
                return view('administrator.permissions.datatables.roles', compact('permission'))->render();
            })
            ->editColumn('system', function (Permission $permission) {
                return dt_check($permission->system);
            })
            ->editColumn('slug', function (Permission $permission) {
                return '<small>' . $permission->slug . '</small>';
            })
            ->addColumn('action', 'administrator.permissions.datatables.action')
            ->rawColumns(['roles', 'system', 'slug', 'action']);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return $this->applyScopes(Permission::query());
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'permissions';
    }
}
