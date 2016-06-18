<?php

namespace Yajra\CMS\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\CMS\DataTables\ExtensionsDataTable;
use Yajra\CMS\Repositories\Extension\Repository;

class ExtensionsController extends Controller
{
    /**
     * @var \Yajra\CMS\Repositories\Extension\Repository
     */
    protected $repository;

    /**
     * ExtensionsController constructor.
     *
     * @param \Yajra\CMS\Repositories\Extension\Repository $repository
     */
    public function __construct(Repository $repository)
    {
        $this->authorizePermissionResource('extension');
        $this->repository = $repository;
    }

    /**
     * Display extensions resource.
     *
     * @param \Yajra\CMS\DataTables\ExtensionsDataTable $dataTable
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(ExtensionsDataTable $dataTable)
    {
        return $dataTable->render('administrator.extensions.index');
    }

    public function store(Request $request)
    {
        $extension          = $this->repository->findOrFail($request->get('id'));
        $extension->enabled = ! $extension->enabled;
        $extension->save();

        $response = 'cms::extension.' . ($extension->enabled ? 'enabled' : 'disabled');

        return $this->notifySuccess(trans($response));
    }

    /**
     * Uninstall an extension.
     *
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $extension = $this->repository->findOrFail($id);
        if ($extension->protected) {
            return $this->notifyError(trans('cms::extension.protected'));
        }

        if ($this->repository->uninstall($id)) {
            flash()->success(trans('cms::extension.deleted', compact('id')));
        } else {
            flash()->error(trans('cms::extension.error', compact('id')));
        }

        return back();
    }
}
