<?php

namespace Yajra\CMS\DataTables;

use App\User;
use Yajra\Datatables\Services\DataTable;

class UsersDataTable extends DataTable
{
    /**
     * Build DataTable api response.
     *
     * @return \Yajra\Datatables\Engines\BaseEngine
     */
    public function dataTable()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->editColumn('created_at', function (User $user) {
                return $user->created_at->diffForHumans();
            })
            ->editColumn('email', function (User $user) {
                return $this->datatables->getHtmlBuilder()->html->mailto($user->email)->toHtml();
            })
            ->editColumn('blocked', function (User $user) {
                return dt_check($user->blocked);
            })
            ->editColumn('confirmed', function (User $user) {
                return dt_check($user->confirmed);
            })
            ->editColumn('administrator', function (User $user) {
                return dt_check($user->administrator);
            })
            ->editColumn('roles', function (User $user) {
                return dt_render('administrator.users.datatables.roles', compact('user'));
            })
            ->addColumn('action', function (User $user) {
                return dt_render('administrator.users.datatables.action', $user->toArray());
            })
            ->rawColumns(['email', 'blocked', 'confirmed', 'administrator', 'roles', 'action']);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $users = User::with('roles')->select('users.*');

        if ($this->datatables->getRequest()->get('deleted') == 'true') {
            $users->onlyTrashed();
        }

        if ($status = $this->datatables->getRequest()->get('status')) {
            $users->whereIn('confirmed', $status);
        }

        if ($roles = $this->datatables->getRequest()->get('roles')) {
            $users->havingRoles($roles);
        }

        return $this->applyScopes($users);
    }

    /**
     * @return \Yajra\Datatables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns(trans('cms::user.dataTable.columns'))
                    ->parameters(trans('cms::user.dataTable.parameters'));
    }
}
