<?php

namespace Yajra\CMS\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Yajra\Acl\Models\Permission;
use Yajra\Acl\Models\Role;
use Yajra\CMS\DataTables\PermissionsDataTable;

class PermissionsController extends Controller
{
    /**
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * Controller specific permission ability map.
     *
     * @var array
     */
    protected $customPermissionMap = [
        'createResource' => 'create',
        'storeResource'  => 'create',
    ];

    /**
     * PermissionsController constructor.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->authorizePermissionResource('permission');
    }

    /**
     * Display list of permissions.
     *
     * @param \Yajra\CMS\DataTables\PermissionsDataTable $dataTable
     * @return \Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function index(PermissionsDataTable $dataTable)
    {
        return $dataTable->render('administrator.permissions.index');
    }

    /**
     * Show permission form.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $permission           = new Permission;
        $permission->resource = 'System';
        $roles                = Role::all();

        return view('administrator.permissions.create', compact('permission', 'roles'));
    }

    /**
     * Store a newly created permission.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        $this->validate($this->request, [
            'name'     => 'required',
            'resource' => 'required|alpha_num',
            'slug'     => 'required|unique:permissions,slug',
        ]);

        $permission = Permission::create($this->request->all());
        $permission->syncRoles($this->request->get('roles', []));

        return redirect()->route('administrator.permissions.index');
    }

    /**
     * Create a permission resource form.
     *
     * @return \BladeView|bool|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createResource()
    {
        $permission = new Permission;
        $roles      = Role::all();

        return view('administrator.permissions.create-resource', compact('permission', 'roles'));
    }

    /**
     * Store permission resource.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeResource()
    {
        $this->validate($this->request, [
            'resource' => 'required|alpha_num',
        ]);

        $permissions = Permission::createResource($this->request->resource);
        foreach ($permissions as $permission) {
            $permission->syncRoles($this->request->get('roles', []));
        }

        return redirect()->route('administrator.permissions.index');
    }

    /**
     * Show and edit selected permission.
     *
     * @param \Yajra\Acl\Models\Permission $permission
     * @return \Illuminate\View\View
     */
    public function edit(Permission $permission)
    {
        $roles = Role::all();

        return view('administrator.permissions.edit', compact('permission', 'roles'));
    }

    /**
     * Update selected permission.
     *
     * @param \Yajra\Acl\Models\Permission $permission
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Permission $permission)
    {
        $this->validate($this->request, [
            'name'     => 'required',
            'resource' => 'required|alpha_num',
            'slug'     => 'required|unique:permissions,slug,' . $permission->id,
        ]);

        $permission->name     = $this->request->get('name');
        $permission->resource = $this->request->get('resource');
        if (! $permission->system) {
            $permission->slug = $this->request->get('slug');
        }
        $permission->save();

        $permission->syncRoles($this->request->get('roles', []));

        return redirect()->route('administrator.permissions.index');
    }

    /**
     * Remove selected permission.
     *
     * @param \Yajra\Acl\Models\Permission $permission
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Permission $permission)
    {
        if (! $permission->system) {
            try {
                $permission->delete();

                return $this->notifySuccess('Permission successfully deleted!');
            } catch (QueryException $e) {
                return $this->notifyError($e->getMessage());
            }
        }

        return $this->notifyError('System permission is protected and cannot be deleted!');
    }
}
