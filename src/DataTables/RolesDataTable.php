<?php

namespace Yajra\CMS\DataTables;

use Yajra\Acl\Models\Role;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Factory;
use Yajra\DataTables\Services\DataTable;

class RolesDataTable extends DataTable
{
    /**
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns(trans('cms::role.dataTable.columns'))
                    ->postAjax()
                    ->parameters(trans('cms::role.dataTable.parameters'));
    }

    /**
     * Build DataTable api response.
     *
     * @param DataTables $dataTable
     * @param mixed      $builder
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable(DataTables $dataTable, $builder)
    {
        return $dataTable->eloquent($builder)
                         ->editColumn('system', function (Role $role) {
                             return dt_check($role->system);
                         })
                         ->addColumn('users', function (Role $role) {
                             return view('administrator.roles.datatables.users', compact('role'));
                         })
                         ->addColumn('permissions', function (Role $role) {
                             return view('administrator.roles.datatables.permissions', compact('role'));
                         })
                         ->addColumn('action', 'administrator.roles.datatables.action')
                         ->rawColumns(['system', 'users', 'permissions', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \Yajra\Acl\Models\Role $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Role $model)
    {
        return $model->newQuery()->select('roles.*')->withCount('users')->withCount('permissions');
    }

    /**
     * @return string
     */
    protected function filename()
    {
        return trans('cms::role.dataTable.filename');
    }
}
