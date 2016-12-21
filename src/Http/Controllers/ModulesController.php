<?php

namespace Yajra\CMS\Http\Controllers;

use Nwidart\Modules\Repository;
use Yajra\CMS\DataTables\ModulesDataTable;

class ModulesController extends Controller
{
    /**
     * @var \Nwidart\Modules\Repository
     */
    protected $modules;

    /**
     * ModulesController constructor.
     *
     * @param \Nwidart\Modules\Repository $modules
     */
    public function __construct(Repository $modules)
    {
        $this->modules = $modules;
        $this->authorizePermissionResource('module');
    }

    /**
     * Display list of modules.
     *
     * @param \Yajra\CMS\DataTables\ModulesDataTable $dataTable
     * @return \Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function index(ModulesDataTable $dataTable)
    {
        return $dataTable->render('administrator.modules.index');
    }

    /**
     * @param string $module
     * @return \Illuminate\View\View
     */
    public function show($module)
    {
        return view('administrator.modules.profile', compact('module'));
    }

    /**
     * Remove selected module.
     *
     * @param string $module
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy($module)
    {
        /** @var \Nwidart\Modules\Module $module */
        $module = $this->modules->find($module);
        $module->delete();

        return $this->notifySuccess(trans('cms::module.destroy', ['module' => (string) $module]));
    }

    /**
     * Toggle module active status.
     *
     * @param string $module
     * @return \Illuminate\Http\JsonResponse
     */
    public function toggle($module)
    {
        /** @var \Nwidart\Modules\Module $module */
        $module = $this->modules->find($module);

        if ($module->disabled()) {
            $module->enable();
        } else {
            $module->disable();
        }

        $message = 'cms::module.toggle.' . ($module->enabled() ? 'enable' : 'disable');

        return $this->notifySuccess(trans($message, ['module' => (string) $module]));
    }
}
