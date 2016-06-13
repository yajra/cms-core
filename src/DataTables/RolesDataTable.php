<?php

namespace Yajra\CMS\DataTables;

use Yajra\Acl\Models\Role;
use Yajra\Datatables\Services\DataTable;

class RolesDataTable extends DataTable
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->editColumn('system', function (Role $role) {
                return dt_check($role->system);
            })
            ->editColumn('slug', function (Role $role) {
                return '<small>' . $role->slug . '</small>';
            })
            ->addColumn('users', function (Role $role) {
                return view('administrator.roles.datatables.users', compact('role'))->render();
            })
            ->addColumn('permissions', function (Role $role) {
                return view('administrator.roles.datatables.permissions', compact('role'))->render();
            })
            ->addColumn('action', 'administrator.roles.datatables.action')
            ->escapeColumns(['name'])
            ->make(true);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return Role::query();
    }

    /**
     * @return \Yajra\Datatables\Html\Builder
     */
    public function html()
    {
        return $this
            ->builder()
            ->columns([
                'id',
                'name',
                'slug',
                'system'      => ['class' => 'text-center', 'width' => '30px', 'title' => 'Sys'],
                'users'       => ['orderable' => false, 'searchable' => false, 'class' => 'text-center'],
                'permissions' => ['orderable' => false, 'searchable' => false, 'class' => 'text-center'],
                'created_at',
                'updated_at',
            ])
            ->addAction(['width' => '60px'])
            ->parameters([
                'stateSave' => true,
                'order'     => [[0, 'desc']],
                'buttons'   => [
                    [
                        'extend' => 'create',
                        'text'   => '<i class="fa fa-plus"></i>&nbsp;&nbsp;NEW ROLE',
                    ],
                    'export',
                    'print',
                    'reset',
                    'reload',
                ],
            ]);
    }
}
