<?php

namespace Yajra\CMS\Http\Controllers;

use Yajra\CMS\DataTables\CategoriesDataTable;
use Yajra\CMS\Entities\Category;
use Yajra\CMS\Http\Requests\CategoriesFormRequest;

class CategoriesController extends Controller
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
     * CategoriesController constructor.
     */
    public function __construct()
    {
        $this->authorizePermissionResource('category');
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Yajra\CMS\DataTables\CategoriesDataTable $dataTable
     * @return \Illuminate\Http\Response
     */
    public function index(CategoriesDataTable $dataTable)
    {
        return $dataTable->render('administrator.categories.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Yajra\CMS\Entities\Category $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Category $category)
    {
        $category->published = true;

        return view('administrator.categories.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Yajra\CMS\Http\Requests\CategoriesFormRequest $request
     * @param  \Yajra\CMS\Entities\Category $category
     * @return \Illuminate\Http\Response
     */
    public function store(CategoriesFormRequest $request, Category $category)
    {
        $category->fill($request->all());
        $category->published     = $request->get('published', false);
        $category->authenticated = $request->get('authenticated', false);
        $category->save();
        flash()->success(trans('cms::categories.store.success'));

        return redirect()->route('administrator.categories.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Yajra\CMS\Entities\Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        if ($category->isRoot()) {
            abort(404);
        }

        return view('administrator.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CategoriesFormRequest $request
     * @param  \Yajra\CMS\Entities\Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoriesFormRequest $request, Category $category)
    {
        $category->fill($request->all());
        $category->published     = $request->get('published', false);
        $category->authenticated = $request->get('authenticated', false);
        $category->save();
        flash()->success(trans('cms::categories.update.success'));

        return redirect()->route('administrator.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Yajra\CMS\Entities\Category $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Category $category)
    {
        if ($category->isRoot()) {
            abort(404);
        }

        if ($category->has('articles')) {
            return $this->notifyError(trans('cms::categories.destroy.error'));
        }

        $category->delete();

        return $this->notifySuccess(trans('cms::categories.destroy.success'));
    }

    /**
     * Button Response from DataTable request to publish status.
     *
     * @param  \Yajra\CMS\Entities\Category $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function publish(Category $category)
    {
        $category->togglePublishedState();

        $category->getDescendants()->each(
            function (Category $cat) use ($category) {
                $cat->published = $category->published;
                $cat->save();
            }
        );

        $message = $category->published ? trans('cms::categories.publish.success') : trans('cms::categories.publish.error');

        return $this->notifySuccess($message);
    }
}
