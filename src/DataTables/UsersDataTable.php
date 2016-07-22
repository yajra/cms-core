<?php

namespace Yajra\CMS\DataTables;

use App\User;
use Yajra\Datatables\Services\DataTable;

class UsersDataTable extends DataTable
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->editColumn('created_at', function(User $user) {
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
            ->addColumn('action', 'administrator.users.datatables.action')
            ->make(true);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $users = User::query();

        if ($this->datatables->request->get('deleted') == 'true') {
            $users->onlyTrashed();
        }

        if ($status = $this->datatables->request->get('status')) {
            $users->whereIn('confirmed', $status);
        }

        if ($roles = $this->datatables->request->get('roles')) {
            $users->havingRoles($roles);
        }

        return $this->applyScopes($users);
    }

    /**
     * @return \Yajra\Datatables\Html\Builder
     */
    public function html()
    {
        return $this
            ->builder()
            ->columns([
                'id'            => ['width' => '20px'],
                'first_name',
                'last_name',
                'email',
                'roles'         => ['searchable' => false, 'orderable' => false],
                'administrator' => [
                    'width' => '20px',
                    'title' => '<i class="fa fa-shield" data-toggle="tooltip" data-title="IsAdministrator"></i>',
                ],
                'confirmed'     => [
                    'width' => '20px',
                    'title' => '<i class="fa fa-check" data-toggle="tooltip" data-title="IsActivated"></i>',
                ],
                'blocked'       => [
                    'width' => '20px',
                    'title' => '<i class="fa fa-ban" data-toggle="tooltip" data-title="IsBlocked"></i>',
                ],
                'created_at',
            ])
            ->addAction(['width' => '80px'])
            ->parameters([
                'stateSave' => true,
                'order'     => [[0, 'desc']],
                'buttons'   => [
                    [
                        'extend' => 'create',
                        'text'   => '<i class="fa fa-plus"></i>&nbsp;&nbsp;New User',
                    ],
                    'export',
                    'print',
                    'reset',
                    'reload',
                ],
            ]);
    }
}
