<?php

namespace Yajra\CMS\Http\Controllers;

use App\Http\Requests;
use Baum\MoveNotPossibleException;
use Exception;
use Illuminate\Http\Request;
use Yajra\CMS\DataTables\ArticlesDataTable;
use Yajra\CMS\DataTables\MenuItemsDataTable;
use Yajra\CMS\Entities\Extension;
use Yajra\CMS\Entities\Menu;
use Yajra\CMS\Entities\Navigation;
use Yajra\CMS\Http\Requests\MenuItemsFormRequest;
use Yajra\CMS\Repositories\Extension\Repository;

class MenuItemsController extends Controller
{
    /**
     * Controller specific permission ability map.
     *
     * @var array
     */
    protected $customPermissionMap = [
        'publish'  => 'update',
        'articles' => 'view',
        'types'    => 'view',
    ];

    /**
     * @var \Yajra\CMS\Repositories\Extension\Repository
     */
    protected $extensions;

    /**
     * MenuItemsController constructor.
     *
     * @param \Yajra\CMS\Repositories\Extension\Repository $extensions
     */
    public function __construct(Repository $extensions)
    {
        $this->authorizePermissionResource('menu');
        $this->extensions = $extensions;

        view()->share('extensions', $this->extensions->all()->where('type', 'menu'));
    }

    /**
     * @param \Yajra\CMS\Entities\Navigation $navigation
     * @param \Yajra\CMS\DataTables\MenuItemsDataTable $dataTable
     * @return \Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function index(Navigation $navigation, MenuItemsDataTable $dataTable)
    {
        return $dataTable->forNavigation($navigation)
                         ->render('administrator.navigation.menu.index', compact('navigation'));
    }

    /**
     * @param \Yajra\CMS\Entities\Navigation $navigation
     * @param \Yajra\CMS\Entities\Menu $menu
     * @return mixed
     */
    public function create(Navigation $navigation, Menu $menu)
    {
        $menu->extension_id = old('extension_id', Extension::MENU_INTERNAL);
        $menu->published    = true;
        $menu->load('extension');

        return view('administrator.navigation.menu.create', compact('navigation', 'menu'));
    }

    /**
     * @param \Yajra\CMS\Entities\Navigation $navigation
     * @param \Yajra\CMS\Http\Requests\MenuItemsFormRequest $request
     * @return mixed
     */
    public function store(Navigation $navigation, MenuItemsFormRequest $request)
    {
        $menu = new Menu();
        $menu->fill($request->all());
        $menu->published     = $request->get('published', false);
        $menu->authenticated = $request->get('authenticated', false);
        $navigation->menus()->save($menu);

        $menu->makeChildOf(Menu::query()->findOrFail($request->get('parent_id')));

        $menu->permissions()->sync($request->get('permissions', []));

        flash()->success(trans('cms::menu.store.success'));

        return redirect()->route('administrator.navigation.menu.index', $navigation->id);
    }

    /**
     * @param \Yajra\CMS\Entities\Navigation $navigation
     * @param \Yajra\CMS\Entities\Menu $menu
     * @return mixed
     */
    public function edit(Navigation $navigation, Menu $menu)
    {
        if ($menu->isRoot()) {
            abort(404);
        }

        return view('administrator.navigation.menu.edit', compact('navigation', 'menu'));
    }

    /**
     * @param \Yajra\CMS\Entities\Navigation $navigation
     * @param \Yajra\CMS\Entities\Menu $menu
     * @param \Yajra\CMS\Http\Requests\MenuItemsFormRequest $request
     * @return mixed
     */
    public function update(Navigation $navigation, Menu $menu, MenuItemsFormRequest $request)
    {
        try {
            $menu->makeChildOf(Menu::query()->findOrFail($request->get('parent_id')));
        } catch (MoveNotPossibleException $e) {
            flash()->error(trans('cms::menu.update.move_error'));

            return back();
        }
        $menu->fill($request->all());
        $menu->published     = $request->get('published', false);
        $menu->authenticated = $request->get('authenticated', false);
        $navigation->menus()->save($menu);

        $menu->permissions()->sync($request->get('permissions', []));

        flash()->success(trans('cms::menu.update.success'));

        return redirect()->route('administrator.navigation.menu.index', $navigation->id);
    }

    /**
     * @param \Yajra\CMS\Entities\Navigation $navigation
     * @param \Yajra\CMS\Entities\Menu $menu
     * @return string
     * @throws \Exception
     */
    public function destroy(Navigation $navigation, Menu $menu)
    {
        if ($menu->isRoot()) {
            abort(404);
        }

        $navigation->menus()->findOrFail($menu->id)->delete();

        return $this->notifySuccess(trans('cms::menu.destroy.success'));
    }

    /**
     * Publish/Unpublish a menu.
     *
     * @param \Yajra\CMS\Entities\Navigation $navigation
     * @param \Yajra\CMS\Entities\Menu $menu
     * @return \Illuminate\Http\JsonResponse
     */
    public function publish(Navigation $navigation, Menu $menu)
    {
        /** @var \Yajra\CMS\Entities\Menu $menu */
        $menu = $navigation->menus()->findOrFail($menu->id);
        $menu->togglePublishedState();

        return $this->notifySuccess(sprintf(
            'Menu successfully %s!',
            $menu->published ? 'published' : 'unpublished'
        ));
    }

    /**
     * Get articles list.
     *
     * @param \Yajra\CMS\DataTables\ArticlesDataTable $dataTable
     * @return \Illuminate\Http\JsonResponse
     */
    public function articles(ArticlesDataTable $dataTable)
    {
        return $dataTable->ajax();
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \Yajra\CMS\Entities\Menu $menu
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    public function extensions(Request $request, Menu $menu)
    {
        $extension = $this->extensions->findOrFail($request->query('key'));
        $template  = $extension->param('template');

        if (view()->exists($template)) {
            return view($template, compact('menu'));
        }

        return '';
    }
}
