<?php

namespace Yajra\CMS\Http\Controllers;

use Yajra\CMS\DataTables\WidgetsDataTable;
use Yajra\CMS\Entities\Widget;
use Yajra\CMS\Http\Requests\WidgetFormRequest;
use Yajra\CMS\Widgets\Repository;

class WidgetsController extends Controller
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
     * @var \Yajra\CMS\Widgets\Repository
     */
    protected $repository;

    /**
     * WidgetsController constructor.
     *
     * @param \Yajra\CMS\Widgets\Repository $repository
     */
    public function __construct(Repository $repository)
    {
        $this->authorizePermissionResource('widget');
        $this->repository = $repository;
    }

    /**
     * Display list of widgets.
     *
     * @param \Yajra\CMS\DataTables\WidgetsDataTable $dataTable
     * @return \Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function index(WidgetsDataTable $dataTable)
    {
        return $dataTable->render('administrator.widgets.index');
    }

    /**
     * Show widget form.
     *
     * @param \Yajra\CMS\Entities\Widget $widget
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Widget $widget)
    {
        $widget->order    = 1;
        $widget->type     = old('type', 'wysiwyg');
        $widget->template = old('template', 'widgets.wysiwyg.default');

        return view('administrator.widgets.create', compact('widget'));
    }

    /**
     * Store a newly created widget.
     *
     * @param \Yajra\CMS\Http\Requests\WidgetFormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(WidgetFormRequest $request)
    {
        $widget = new Widget;
        $widget->fill($request->all());
        $widget->published     = $request->get('published', false);
        $widget->authenticated = $request->get('authenticated', false);
        $widget->show_title    = $request->get('show_title', false);
        $widget->save();

        $widget->syncPermissions($request->get('permissions', []));
        $widget->syncMenuAssignment($request->get('menu', []), $request->get('assignment', Widget::ALL_PAGES));

        flash()->success(trans('cms::widget.store.success'));

        return redirect()->route('administrator.widgets.index');
    }

    /**
     * Show and edit selected widget.
     *
     * @param \Yajra\CMS\Entities\Widget $widget
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Widget $widget)
    {
        $widget->type     = old('type', $widget->type);
        $widget->template = old('template', $widget->template);

        return view('administrator.widgets.edit', compact('widget'));
    }

    /**
     * Update selected widget.
     *
     * @param \Yajra\CMS\Entities\Widget $widget
     * @param \Yajra\CMS\Http\Requests\WidgetFormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Widget $widget, WidgetFormRequest $request)
    {
        $widget->fill($request->all());
        $widget->published     = $request->get('published', false);
        $widget->authenticated = $request->get('authenticated', false);
        $widget->show_title    = $request->get('show_title', false);
        $widget->save();

        $widget->syncPermissions($request->get('permissions', []));
        $widget->syncMenuAssignment($request->get('menu', []), $request->get('assignment', Widget::ALL_PAGES));

        flash()->success(trans('cms::widget.update.success'));

        return redirect()->route('administrator.widgets.index');
    }

    /**
     * Remove selected widget.
     *
     * @param \Yajra\CMS\Entities\Widget $widget
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Widget $widget)
    {
        $widget->delete();

        return $this->notifySuccess(trans('cms::widget.destroy.success'));
    }

    /**
     * Publish/Unpublish a widget.
     *
     * @param \Yajra\CMS\Entities\Widget $widget
     * @return \Illuminate\Http\JsonResponse
     */
    public function publish(Widget $widget)
    {
        $widget->published = ! $widget->published;
        $widget->save();

        return $this->notifySuccess(trans('cms::widget.update.publish', [
                'task' => $widget->published ? 'published' : 'unpublished',
            ])
        );
    }

    /**
     * Get all widget types.
     *
     * @param string $type
     * @return string
     */
    public function templates($type)
    {
        $data = [];
        foreach ($this->repository->all()->where('name', $type) as $widget) {
            foreach ($widget->templates as $key => $value) {
                $data[] = ['key' => $key, 'value' => $value];
            }
        }

        return response()->json([
            'selected' => $type,
            'data'     => $data,
        ], 200);
    }
}
