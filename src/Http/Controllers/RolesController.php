<?php

namespace Yajra\CMS\Http\Controllers;

use Yajra\CMS\DataTables\RolesDataTable;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Yajra\Acl\Models\Permission;
use Yajra\Acl\Models\Role;

class RolesController extends Controller
{
    /**
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * RolesController constructor.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->authorizePermissionResource('role');
    }

    /**
     * Display list of roles.
     *
     * @param \Yajra\CMS\DataTables\RolesDataTable $dataTable
     * @return \Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function index(RolesDataTable $dataTable)
    {
        return $dataTable->render('administrator.roles.index');
    }

    /**
     * Show role form.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $role                = new Role;
        $permissions         = Permission::all();
        $selectedPermissions = $this->request->old('permissions', []);

        return view('administrator.roles.create', compact('role', 'permissions', 'selectedPermissions'));
    }

    /**
     * Store a newly created role.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        $this->validate($this->request, [
            'name'        => 'required',
            'slug'        => 'required|unique:roles,slug',
        ]);

        $role = Role::create($this->request->all());
        $role->syncPermissions($this->request->get('permissions'));
        flash()->success('Role ' . $role->name . ' successfully created!');

        return redirect()->route('administrator.roles.index');
    }

    /**
     * Show and edit selected role.
     *
     * @param \Yajra\Acl\Models\Role $role
     * @return \Illuminate\View\View
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();

        return view('administrator.roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update role permission.
     *
     * @param \Yajra\Acl\Models\Role $role
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Role $role)
    {
        $this->validate($this->request, [
            'name'        => 'required',
            'slug'        => 'required|unique:roles,slug,' . $role->id,
            'permissions' => 'required',
        ]);

        $role->update($this->request->all());
        $role->syncPermissions($this->request->get('permissions', []));
        flash()->success('Role ' . $role->name . ' successfully updated!');

        return redirect()->route('administrator.roles.index');
    }

    /**
     * Remove selected role.
     *
     * @param \Yajra\Acl\Models\Role $role
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Role $role)
    {
        if (! $role->system) {
            try {
                $role->delete();

                return $this->notifySuccess('Role successfully deleted!');
            } catch (QueryException $e) {
                return $this->notifyError($e->getMessage());
            }
        }

        return $this->notifyError('Role is protected and cannot be deleted!');
    }
}
