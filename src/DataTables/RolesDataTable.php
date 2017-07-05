<?php

namespace Yajra\CMS\DataTables;

use Yajra\Acl\Models\Role;
use Yajra\DataTables\EloquentDataTable;
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
                    ->minifiedAjax()
                    ->parameters(trans('cms::role.dataTable.parameters'));
    }

    /**
     * @return string
     */
    protected function filename()
    {
        return trans('cms::role.dataTable.filename');
    }

    /**
     * Build DataTable api response.
     *
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable()
    {
        return (new EloquentDataTable($this->query()))
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
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return $this->applyScopes(Role::query()->withCount('users')->withCount('permissions'));
    }
}
