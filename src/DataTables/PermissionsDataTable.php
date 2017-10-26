<?php

namespace Yajra\CMS\DataTables;

use Yajra\Acl\Models\Permission;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class PermissionsDataTable extends DataTable
{
    /**
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this
            ->builder()
            ->columns(trans('cms::permission.dataTable.columns'))
            ->minifiedAjax()
            ->parameters(trans('cms::permission.dataTable.parameters'));
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return Permission::query()->select('permissions.*')->withCount('roles');
    }

    /**
     * Build DataTable api response.
     *
     * @param  mixed $query
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return (new EloquentDataTable($query))
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
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return trans('cms::permission.dataTable.filename');
    }
}
