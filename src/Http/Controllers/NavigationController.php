<?php

namespace Yajra\CMS\Http\Controllers;

use Yajra\CMS\DataTables\NavigationDataTable;
use Yajra\CMS\Entities\Navigation;
use App\Http\Requests;
use Illuminate\Http\Request;

class NavigationController extends Controller
{
    /**
     * Controller specific permission ability map.
     *
     * @var array
     */
    protected $customPermissionMap = [
        'publish' => 'update',
    ];

    /**
     * NavigationController constructor.
     */
    public function __construct()
    {
        $this->authorizePermissionResource('navigation');
    }

    /**
     * Display list of navigation.
     *
     * @param \Yajra\CMS\DataTables\NavigationDataTable $dataTable
     * @return \Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function index(NavigationDataTable $dataTable)
    {
        return $dataTable->render('administrator.navigation.index');
    }

    /**
     * Show navigation form.
     *
     * @param \Yajra\CMS\Entities\Navigation $navigation
     * @return mixed
     */
    public function create(Navigation $navigation)
    {
        return view('administrator.navigation.create', compact('navigation'));
    }

    /**
     * Store a newly created navigation.
     *
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'type'  => 'required|max:255|alpha|unique:navigation,type',
        ]);

        $navigation = new Navigation;
        $navigation->fill($request->all());
        $navigation->published = $request->get('published', false);
        $navigation->save();
        flash()->success(trans('cms::navigation.store.success'));

        return redirect()->route('administrator.navigation.index');
    }

    /**
     * Show and edit selected navigation.
     *
     * @param \Yajra\CMS\Entities\Navigation $navigation
     * @return mixed
     */
    public function edit(Navigation $navigation)
    {
        return view('administrator.navigation.edit', compact('navigation'));
    }

    /**
     * Update selected navigation.
     *
     * @param \Yajra\CMS\Entities\Navigation $navigation
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    public function update(Navigation $navigation, Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'type'  => 'required|max:255|alpha|unique:navigation,type,' . $navigation->id,
        ]);

        $navigation->fill($request->all());
        $navigation->published = $request->get('published', false);
        $navigation->save();
        flash()->success(trans('cms::navigation.update.success'));

        return redirect()->route('administrator.navigation.index');
    }

    /**
     * Remove selected navigation.
     *
     * @param \Yajra\CMS\Entities\Navigation $navigation
     * @return string
     * @throws \Exception
     */
    public function destroy(Navigation $navigation)
    {
        $navigation->delete();

        return $this->notifySuccess(trans('cms::navigation.destroy.success'));
    }

    /**
     * Publish/Unpublish a navigation.
     *
     * @param \Yajra\CMS\Entities\Navigation $navigation
     * @return \Illuminate\Http\JsonResponse
     */
    public function publish(Navigation $navigation)
    {
        $navigation->togglePublishedState();

        return $this->notifySuccess(sprintf(
            trans('cms::navigation.update.publish'),
            $navigation->published ? 'published' : 'unpublished'
        ));
    }
}
