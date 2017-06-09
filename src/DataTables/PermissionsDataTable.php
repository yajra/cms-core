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
            ->parameters($this->getBuilderParameters());
    }

    /**
     * @return array
     */
    private function getColumns()
    {
        return [
            [
                'data'  => 'id',
                'name'  => 'id',
                'title' => trans('cms::permission.datatable.columns.id'),
            ],
            [
                'data'  => 'resource',
                'name'  => 'resource',
                'title' => trans('cms::permission.datatable.columns.resource'),
            ],
            [
                'data'  => 'name',
                'name'  => 'name',
                'title' => trans('cms::permission.datatable.columns.name'),
            ],
            [
                'data'  => 'slug',
                'name'  => 'slug',
                'title' => trans('cms::permission.datatable.columns.slug'),
            ],
            [
                'data'  => 'system',
                'name'  => 'system',
                'title' => trans('cms::permission.datatable.columns.system'),
                'class' => 'text-center',
                'width' => '30px',
            ],
            [
                'data'       => 'roles',
                'name'       => 'roles',
                'title'      => trans('cms::permission.datatable.columns.roles'),
                'class'      => 'text-center',
                'width'      => '30px',
                'searchable' => false,
                'orderable'  => false,
                'printable'  => false,
            ],
            [
                'data'  => 'created_at',
                'name'  => 'created_at',
                'title' => trans('cms::permission.datatable.columns.created_at'),
                'width' => '100px',
            ],
            [
                'data'  => 'updated_at',
                'name'  => 'updated_at',
                'title' => trans('cms::permission.datatable.columns.updated_at'),
                'width' => '100px',
            ],
            [
                'data'       => 'action',
                'name'       => 'action',
                'title'      => trans('cms::role.datatable.columns.action'),
                'width'      => '60px',
                'orderable'  => false,
                'searchable' => false,
            ],
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
