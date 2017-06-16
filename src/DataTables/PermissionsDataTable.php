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
            ->columns(trans('cms::role.dataTable.columns'))
            ->parameters(trans('cms::role.dataTable.parameters'));
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
        return trans('cms::permission.dataTable.filename');
    }
}
