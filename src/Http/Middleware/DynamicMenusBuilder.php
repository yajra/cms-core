<?php

namespace Yajra\CMS\Http\Middleware;

use Caffeinated\Menus\Builder;
use Caffeinated\Menus\Facades\Menu as MenuFactory;
use Closure;
use Yajra\CMS\Entities\Menu;
use Yajra\CMS\Entities\Navigation;
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
        session()->forget('active_menu');

        if (! $request->is(admin_prefix() . '*')) {
            $this->repository = app('navigation');
            $this->repository->getPublished()->each(function (Navigation $navigation) {
                MenuFactory::make($navigation->type, function (Builder $builder) use ($navigation) {
                    $navigation->menus->each(function (Menu $menu) use ($builder, &$assignment) {
                        $this->generateMenu($builder, $menu);
                    });
                });
            });
        }

        return $next($request);
    }

    /**
     * Generate the menu.
     *
     * @param \Caffeinated\Menus\Builder|\Caffeinated\Menus\Item $menuBuilder
     * @param \Yajra\CMS\Entities\Menu $menu
     */
    protected function generateMenu($menuBuilder, $menu)
    {
        $subMenu = $this->registerMenu($menuBuilder, $menu);
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
     * @param \Caffeinated\Menus\Builder|\Caffeinated\Menus\Item $menuBuilder
     * @param \Yajra\CMS\Entities\Menu $menu
     * @return \Caffeinated\Menus\Builder|bool
     * @throws \Laracasts\Presenter\Exceptions\PresenterException
     */
    protected function registerMenu($menuBuilder, Menu $menu)
    {
        if (! $menuBuilder) {
            return false;
        }

        if (! $menu->published) {
            return false;
        }

        if ($menu->requiresAuthentication() && ! auth()->check()) {
            return false;
        }

        if (count($menu->permissions)) {
            if ($menu->authorization === 'can') {
                foreach ($menu->permissions as $permission) {
                    if (! current_user()->can($permission->slug)) {
                        return false;
                    }
                }
            } else {
                $permissions = $menu->permissions->pluck('slug')->toArray();
                if (! current_user()->canAtLeast($permissions)) {
                    return false;
                }
            }
        }

        $item = $menuBuilder->add($menu->title, url($menu->present()->url))
                            ->attribute('target', $menu->present()->target)
                            ->attribute('title', $menu->present()->linkTitle);

        if ($menu->present()->linkStyle) {
            $item->attribute('style', $menu->present()->linkStyle);
        }

        if ($menu->isActive()) {
            session()->flash('active_menu', $menu);
        }

        return $item;
    }
}
