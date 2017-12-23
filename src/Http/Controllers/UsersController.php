<?php

namespace Yajra\CMS\Http\Controllers;

use App\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Yajra\Acl\Models\Role;
use Yajra\CMS\Contracts\Validators\StoreUserValidator;
use Yajra\CMS\Contracts\Validators\UpdateUserValidator;
use Yajra\CMS\DataTables\UsersDataTable;
use Yajra\CMS\Events\Users\PasswordWasUpdated;
use Yajra\CMS\Events\Users\UserWasCreated;
use Yajra\CMS\Events\Users\UserWasUpdated;

class UsersController extends Controller
{
    /**
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * @var \Yajra\Acl\Models\Role
     */
    protected $role;

    /**
     * Controller specific permission ability map.
     *
     * @var array
     */
    protected $customPermissionMap = [
        'activate'       => 'update',
        'ban'            => 'update',
        'forceDelete'    => 'delete',
        'restore'        => 'update',
        'password'       => 'update',
        'updatePassword' => 'update',
        'impersonate'    => 'view',
    ];

    /**
     * @param \Illuminate\Http\Request $request
     * @param \Yajra\Acl\Models\Role   $role
     */
    public function __construct(Request $request, Role $role)
    {
        $this->request = $request;
        $this->role    = $role;

        $this->authorizePermissionResource('user');
    }

    /**
     * Display list of users.
     *
     * @param \Yajra\CMS\DataTables\UsersDataTable $dataTable
     * @return \Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function index(UsersDataTable $dataTable)
    {
        $roles = $this->role->pluck('name', 'id');

        return $dataTable->render('administrator.users.index', compact('roles'));
    }

    /**
     * Show user form.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $roles = $this->getAllowedRoles();

        $selectedRoles = $this->request->old('roles');
        $user          = new User([
            'blocked'   => 0,
            'confirmed' => 1,
        ]);

        return view('administrator.users.create', compact('user', 'roles', 'selectedRoles'));
    }

    /**
     * Get allowed roles for the current user.
     *
     * @return mixed
     */
    protected function getAllowedRoles()
    {
        if ($this->request->user('administrator')->isRole('super-administrator')) {
            $roles = $this->role->newQuery()->get();
        } else {
            $roles = $this->role->newQuery()->where('slug', '!=', 'super-administrator')->get();
        }

        return $roles->pluck('name', 'id');
    }

    /**
     * Store a newly created user.
     *
     * @param \Yajra\CMS\Contracts\Validators\StoreUserValidator $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreUserValidator $request)
    {
        $user               = new User($request->all());
        $user->password     = bcrypt($request->get('password'));
        $user->is_activated = $request->get('is_activated', false);
        $user->is_blocked   = $request->get('is_blocked', false);
        $user->is_admin     = $request->get('is_admin', false);
        $user->save();
        $user->syncRoles($request->get('roles'));

        event(new UserWasCreated($user));

        flash()->success('User ' . $user->first_name . 'successfully created!');

        return redirect()->route('administrator.users.index');
    }

    /**
     * Show and edit selected user.
     *
     * @param \App\User $user
     * @return \Illuminate\View\View
     */
    public function edit(User $user)
    {
        $roles         = $this->getAllowedRoles();
        $selectedRoles = $user->roles()->pluck('roles.id');

        return view('administrator.users.edit', compact('user', 'roles', 'selectedRoles'));
    }

    /**
     * Show and edit password.
     *
     * @param \App\User $user
     * @return \Illuminate\View\View
     */
    public function password(User $user)
    {
        return view('administrator.users.password', compact('user'));
    }

    /**
     * @param \App\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePassword(User $user)
    {
        $this->validate($this->request, [
            'password'              => 'required|min:4|confirmed',
            'password_confirmation' => 'required|min:4',
        ]);

        $password       = $this->request->get('password');
        $user->password = bcrypt($password);
        $user->save();

        event(new PasswordWasUpdated($user, $password));

        flash()->success($user->name . "'s password successfully updated!");

        return redirect()->route('administrator.users.index');
    }

    /**
     * @param \App\User $user
     * @return \Illuminate\View\View
     */
    public function show(User $user)
    {
        return view('administrator.users.profile', compact('user'));
    }

    /**
     * @param \App\User                                           $user
     * @param \Yajra\CMS\Contracts\Validators\UpdateUserValidator $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(User $user, UpdateUserValidator $request)
    {
        $user->fill($request->except('password'));
        $password = $request->get('password');
        if (! empty($password)) {
            $user->password = bcrypt($password);
        }
        $user->is_activated = $request->get('is_activated', false);
        $user->is_blocked   = $request->get('is_blocked', false);
        $user->is_admin     = $request->get('is_admin', false);
        $user->save();
        $user->syncRoles($request->get('roles'));

        event(new UserWasUpdated($user));

        flash()->success('User ' . $user->first_name . ' successfully updated!');

        return redirect()->route('administrator.users.index');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function forceDelete($id)
    {
        $user = User::withTrashed()->findOrFail($id);

        return $this->delete($user, true);
    }

    /**
     * Remove selected user.
     *
     * @param \App\User  $user
     * @param bool|false $force
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(User $user, $force = false)
    {
        if ($user->id <> auth('administrator')->id()) {
            try {
                if ($force) {
                    $user->forceDelete();
                } else {
                    $user->delete();
                }

                return $this->notifySuccess('User successfully deleted!');
            } catch (QueryException $e) {
                return $this->notifyError($e->getMessage());
            }
        }

        return $this->notifyError('You cannot delete your own record!');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function restore($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->restore();

        return $this->notifySuccess($user->name . ' successfully restored!');
    }

    /**
     * Toggle ban status of a user.
     *
     * @param \App\User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function ban(User $user)
    {
        $user->is_blocked = ! $user->is_blocked;
        $user->save();

        if ($user->is_blocked) {
            return $this->notifySuccess('User ' . $user->name . ' blocked!');
        } else {
            return $this->notifySuccess('User ' . $user->name . ' un-blocked!');
        }
    }

    /**
     * Toggle user activation status.
     *
     * @param \App\User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function activate(User $user)
    {
        $user->is_activated = ! $user->is_activated;
        $user->save();

        if ($user->is_activated) {
            return $this->notifySuccess('User ' . $user->name . ' activated!');
        } else {
            return $this->notifySuccess('User ' . $user->name . ' deactivated!');
        }
    }

    /**
     * Login on front-end as the given user.
     *
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function impersonate(User $user)
    {
        auth('web')->login($user);

        return $this->notifySuccess("You are now logged in as {$user->first_name}. You can now visit the authenticated part of the site.");
    }
}
