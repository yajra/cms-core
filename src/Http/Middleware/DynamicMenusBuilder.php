<?php

namespace Yajra\CMS\Http\Middleware;

use Caffeinated\Menus\Builder;
use Caffeinated\Menus\Facades\Menu as MenuFactory;
use Closure;
use Yajra\CMS\Entities\Menu;
use Yajra\CMS\Entities\Navigation;
use Yajra\CMS\Entities\Widget;
use Yajra\CMS\Repositories\Navigation\Repository;

class DynamicMenusBuilder
{
    /**
     * @var Repository
     */
    protected $repository;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (! $request->is('administrator*')) {
            $this->repository = app(Repository::class);
            $this->repository->getPublished()->each(function (Navigation $navigation) {
                MenuFactory::make($navigation->type, function (Builder $builder) use ($navigation) {
                    $widgets    = $navigation->getConnection()->table('widget_menu');
                    $assignment = [0];
                    $navigation->menus->each(function (Menu $menu) use ($builder, $widgets, $assignment) {
                        if ($menu->isActive()) {
                            $assignment[] = $menu->id;
                            session(['active_menu' => $menu]);
                        }

                        $menus = $menu->descendantsAndSelf()->with('permissions')->get()->toHierarchy();
                        foreach ($menus as $menu) {
                            $this->generateMenu($builder, $menu);
                        }
                    });

                    $widgets = $widgets->where('menu_id', $assignment);
                    Widget::addGlobalScope('menu_assignment', function ($query) use ($widgets) {
                        $query->whereIn('id', $widgets->pluck('widget_id'));
                    });
                });
            });
        }

        return $next($request);
    }

    /**
     * Generate the menu.
     *
     * @param \Caffeinated\Menus\Builder|\Caffeinated\Menus\Item $parentMenu
     * @param \Yajra\CMS\Entities\Menu $menu
     */
    protected function generateMenu($parentMenu, $menu)
    {
        $subMenu = $this->registerMenu($parentMenu, $menu);
        $menu->children->each(function (Menu $subItem) use ($subMenu) {
            $subMenuChild = $this->registerMenu($subMenu, $subItem);
            if (count($subItem->children)) {
                $this->generateMenu($subMenuChild, $subItem);
            }
        });
    }

    /**
     * Register a menu.
     *
     * @param \Caffeinated\Menus\Builder|\Caffeinated\Menus\Item $parentMenu
     * @param \Yajra\CMS\Entities\Menu $menu
     * @return \Caffeinated\Menus\Builder|bool
     * @throws \Laracasts\Presenter\Exceptions\PresenterException
     */
    protected function registerMenu($parentMenu, Menu $menu)
    {
        if (! $menu->published) {
            return false;
        }

        if ($menu->requiresAuthentication() && ! auth()->check()) {
            return false;
        }

        if (count($menu->permissions)) {
            if ($menu->authorization === 'can') {
                foreach ($menu->permissions as $permission) {
                    if (auth()->guest() ||
                        (auth()->check() && ! auth()->user()->can($permission->slug))
                    ) {
                        return false;
                    }
                }
            } else {
                if (auth()->guest() ||
                    (auth()->check() && ! auth()
                            ->user()
                            ->canAtLeast($menu->permissions->pluck('slug')->toArray()))
                ) {
                    return false;
                }
            }
        }

        return $parentMenu->add($menu->title, $menu->present()->url())
                          ->attribute('target', $menu->present()->target());
    }
}
