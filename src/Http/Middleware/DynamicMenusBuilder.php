<?php

namespace Yajra\CMS\Http\Middleware;

use Caffeinated\Menus\Builder;
use Caffeinated\Menus\Facades\Menu as MenuFactory;
use Closure;
use Yajra\CMS\Entities\Menu;
use Yajra\CMS\Entities\Navigation;
use Yajra\CMS\Entities\Widget;
use Yajra\CMS\Repositories\Navigation\NavigationRepository;

class DynamicMenusBuilder
{
    /**
     * @var NavigationRepository
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
        if (! app()->runningInConsole() || ! $request->is('administrator/*')) {
            $this->repository = app(NavigationRepository::class);
            $this->repository->getPublished()->each(function (Navigation $navigation) {
                MenuFactory::make($navigation->type, function (Builder $builder) use ($navigation) {
                    $navigation->menus->each(function (Menu $menu) use ($builder) {
                        $widgets = $menu->getConnection()->table('widget_menu');

                        if ($menu->isActive()) {
                            $widgets->whereIn('menu_id', [0, $menu->id]);
                        } else {
                            $widgets->where('menu_id', 0);
                        }

                        Widget::addGlobalScope('menu_assignment', function ($query) use ($widgets) {
                            $query->whereIn('id', $widgets->pluck('widget_id'));
                        });

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
     * @param \Caffeinated\Menus\Builder|\Caffeinated\Menus\Item $parentMenu
     * @param \Yajra\CMS\Entities\Menu $item
     */
    protected function generateMenu($parentMenu, $item)
    {
        $subMenu     = $this->registerMenu($parentMenu, $item);
        $descendants = $item->descendants()->published()->get()->toHierarchy();
        $descendants->each(function (Menu $subItem) use ($subMenu) {
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

        if ($menu->permissions->count()) {
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

        return $parentMenu->add($menu->title, $menu->present()->url())->attribute('target', $menu->present()->target());
    }
}
