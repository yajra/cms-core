<?php

namespace Yajra\CMS\Http\Controllers;

use Yajra\CMS\DataTables\ArticlesDataTable;
use Yajra\CMS\DataTables\MenuItemsDataTable;
use Yajra\CMS\Entities\Lookup;
use Yajra\CMS\Entities\Menu;
use Yajra\CMS\Entities\Navigation;
use Yajra\CMS\Http\Requests\MenuItemsFormRequest;
use App\Http\Requests;
use Exception;
use Illuminate\Http\Request;
use Yajra\Acl\Models\Permission;

class MenuItemsController extends Controller
{
    /**
     * Controller specific permission ability map.
     *
     * @var array
     */
    protected $customPermissionMap = [
        'publish'       => 'update',
        'getArticles'   => 'lists',
        'getTypesByKey' => 'lists',
    ];

    /**
     * MenuItemsController constructor.
     */
    public function __construct()
    {
        $this->authorizePermissionResource('menu');
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
        $menu->order = 1; // set default ordering
        $menu->type  = 'url.internal';
        $permissions = Permission::all();
        $menuItems   = Lookup::where('type', 'menu.types')->get();

        return view('administrator.navigation.menu.create', compact('navigation', 'menu', 'permissions', 'menuItems'));
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

        $menu->permissions()->sync($request->get('permissions', []));

        flash()->success('Menu successfully created!');

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
        $permissions = Permission::all();
        $menuItems   = Lookup::where('type', 'menu.types')->get();

        return view('administrator.navigation.menu.edit', compact('navigation', 'menu', 'permissions', 'menuItems'));
    }

    /**
     * @param \Yajra\CMS\Entities\Navigation $navigation
     * @param \Yajra\CMS\Entities\Menu $menu
     * @param \Yajra\CMS\Http\Requests\MenuItemsFormRequest $request
     * @return mixed
     */
    public function update(Navigation $navigation, Menu $menu, MenuItemsFormRequest $request)
    {
        $menu->fill($request->all());
        $menu->published     = $request->get('published', false);
        $menu->authenticated = $request->get('authenticated', false);
        $navigation->menus()->save($menu);
        $menu->permissions()->sync($request->get('permissions', []));

        flash()->success('Menu successfully updated!');

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

        $navigation->menus()->query()->find($menu->id)->delete();

        return $this->notifySuccess('Menu successfully deleted!');
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
    public function getArticles(ArticlesDataTable $dataTable)
    {
        return $dataTable->ajax();
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \Yajra\CMS\Entities\Menu $menu
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTypesByKey(Request $request, Menu $menu)
    {
        /** @var Lookup $item */
        $item     = Lookup::type('menu.types')->where('key', $request->query('key'))->firstOrFail();
        $template = $item->fluentParameters()->template;

        if (view()->exists($template)) {
            return view($template, compact('menu'));
        }

        $view = 'administrator.navigation.menu.partials.types.' . $request->query('key');

        return view($view, compact('menu'));
    }
}
