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
        return $this
            ->builder()
            ->columns($this->getColumns())
            ->parameters([
                'stateSave' => true,
                'order'     => [[0, 'desc']],
                'buttons'   => [
                    [
                        'extend' => 'create',
                        'text'   => '<i class="fa fa-plus"></i>&nbsp;&nbsp;' . trans('cms::user.datatable.buttons.create'),
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
                'title' => trans('cms::user.datatable.columns.id'),
                'width' => '20px',
            ],
            [
                'data'  => 'first_name',
                'name'  => 'first_name',
                'title' => trans('cms::user.datatable.columns.first_name'),
            ],
            [
                'data'  => 'last_name',
                'name'  => 'last_name',
                'title' => trans('cms::user.datatable.columns.last_name'),
            ],
            [
                'data'  => 'email',
                'name'  => 'email',
                'title' => trans('cms::user.datatable.columns.email'),
            ],
            [
                'data'       => 'roles',
                'name'       => 'roles.name',
                'title'      => trans('cms::user.datatable.columns.roles'),
                'orderable'  => false,
            ],
            [
                'data'  => 'administrator',
                'name'  => 'administrator',
                'width' => '20px',
                'title' => '<i class="fa fa-shield" data-toggle="tooltip" data-title="' . trans('cms::user.datatable.columns.administrator') . '"></i>',
            ],
            [
                'data'  => 'confirmed',
                'name'  => 'confirmed',
                'width' => '20px',
                'title' => '<i class="fa fa-check" data-toggle="tooltip" data-title="' . trans('cms::user.datatable.columns.confirmed') . '"></i>',
            ],
            [
                'data'  => 'blocked',
                'name'  => 'blocked',
                'width' => '20px',
                'title' => '<i class="fa fa-ban" data-toggle="tooltip" data-title="' . trans('cms::user.datatable.columns.blocked') . '"></i>',
            ],
            [
                'data'  => 'created_at',
                'name'  => 'created_at',
                'title' => trans('cms::user.datatable.columns.created_at'),
                'width' => '100px',
            ],
            [
                'data'       => 'action',
                'name'       => 'action',
                'title'      => trans('cms::user.datatable.columns.action'),
                'width'      => '60px',
                'orderable'  => false,
                'searchable' => false,
            ],
        ];
    }
}
