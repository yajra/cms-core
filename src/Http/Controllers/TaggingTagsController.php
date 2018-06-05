<?php

namespace Yajra\CMS\Http\Controllers;

use Conner\Tagging\Model\Tag;
use Illuminate\Support\Facades\DB;
use Yajra\CMS\DataTables\TagsDataTable;
use Yajra\CMS\Http\Requests\EditTagFormRequest;
use Yajra\CMS\Http\Requests\NewTagFormRequest;

class TaggingTagsController extends Controller
{
    /**
     * TaggingTagsController constructor.
     */
    public function __construct()
    {
        $this->authorizePermissionResource('tag');
    }

    /**
     * Display a listing of the resource.
     *
     * @param \Yajra\CMS\DataTables\TagsDataTable $dataTable
     * @return \Illuminate\Http\Response
     */
    public function index(TagsDataTable $dataTable)
    {
        return $dataTable->render('administrator.tags.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param \Conner\Tagging\Model\Tag $tag
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Tag $tag)
    {
        return view('administrator.tags.create', compact('tag'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Yajra\CMS\Http\Requests\NewTagFormRequest $request
     * @param \Conner\Tagging\Model\Tag                  $tag
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function store(NewTagFormRequest $request, Tag $tag)
    {
        $tag->fill($request->all());
        $tag->slug = str_slug($request->get('tag'));
        $tag->save();
        flash()->success(trans('cms::tag.store.success'));

        return redirect()->route('administrator.tags.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Conner\Tagging\Model\Tag $tag
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Tag $tag)
    {
        DB::table('tagging_tagged')->where('tag_slug', $tag->slug)->delete();
        $tag->delete();

        return $this->notifySuccess(trans('cms::tag.destroy.success'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \Conner\Tagging\Model\Tag $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        return view('administrator.tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Yajra\CMS\Http\Requests\EditTagFormRequest $request
     * @param \Conner\Tagging\Model\Tag                   $tag
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function update(EditTagFormRequest $request, Tag $tag)
    {
        $tag->fill($request->all());
        $tag->save();
        flash()->success(trans('cms::tag.update.success'));

        return redirect()->route('administrator.tags.index');
    }
}
