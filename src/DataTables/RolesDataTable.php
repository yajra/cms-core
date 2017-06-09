<?php

namespace Yajra\CMS\DataTables;

use Yajra\Acl\Models\Role;
use Yajra\Datatables\Services\DataTable;

class RolesDataTable extends DataTable
{
    /**
     * @return \Yajra\Datatables\Html\Builder
     */
    public function html()
    {
        return $this
            ->builder()
            ->columns($this->getColumns())
            ->parameters([
                'stateSave' => true,
                'order'     => [[0, 'desc']],
                'buttons'   => [
                    [
                        'extend' => 'create',
                        'text'   => '<i class="fa fa-plus"></i>&nbsp;&nbsp;' . trans('cms::role.datatable.buttons.create'),
                    ],
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
                'data'  => 'id',
                'name'  => 'id',
                'title' => trans('cms::role.datatable.columns.id'),
            ],
            [
                'data'  => 'name',
                'name'  => 'name',
                'title' => trans('cms::role.datatable.columns.name'),
            ],
            [
                'data'  => 'slug',
                'name'  => 'slug',
                'title' => trans('cms::role.datatable.columns.slug'),
            ],
            [
                'data'  => 'system',
                'name'  => 'system',
                'title' => trans('cms::role.datatable.columns.system'),
                'class' => 'text-center',
                'width' => '30px',
            ],
            [
                'data'       => 'users',
                'name'       => 'users',
                'title'      => trans('cms::role.datatable.columns.users'),
                'orderable'  => false,
                'searchable' => false,
                'class'      => 'text-center',
            ],
            [
                'data'       => 'permissions',
                'name'       => 'permissions',
                'title'      => trans('cms::role.datatable.columns.permissions'),
                'orderable'  => false,
                'searchable' => false,
                'class'      => 'text-center',
            ],
            [
                'data'  => 'created_at',
                'name'  => 'created_at',
                'title' => trans('cms::role.datatable.columns.created_at'),
                'width' => '100px',
            ],
            [
                'data'  => 'updated_at',
                'name'  => 'updated_at',
                'title' => trans('cms::role.datatable.columns.updated_at'),
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
     * Build DataTable api response.
     *
     * @return \Yajra\Datatables\Engines\BaseEngine
     */
    protected function dataTable()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->editColumn('system', function (Role $role) {
                return dt_check($role->system);
            })
            ->addColumn('users', function (Role $role) {
                return view('administrator.roles.datatables.users', compact('role'))->render();
            })
            ->addColumn('permissions', function (Role $role) {
                return view('administrator.roles.datatables.permissions', compact('role'))->render();
            })
            ->addColumn('action', 'administrator.roles.datatables.action')
            ->rawColumns(['system', 'users', 'permissions', 'action']);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return $this->applyScopes(Role::query());
    }
}
