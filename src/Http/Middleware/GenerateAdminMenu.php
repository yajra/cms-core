<?php

namespace Yajra\CMS\Http\Middleware;

use Caffeinated\Menus\Builder;
use Caffeinated\Menus\Facades\Menu;
use Closure;
use Yajra\CMS\Repositories\Navigation\NavigationRepository;

class GenerateAdminMenu
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->check() && $request->is('administrator*')) {
            Menu::make('admin', function (Builder $menu) {
                $menu->add('Dashboard', route('administrator.index'))->icon('home');

                $navs = app(NavigationRepository::class)->getPublished();
                if ($navs->count()) {
                    $nav = $menu->add('Navigation', '#')->icon('sitemap')
                                ->data('permission', 'navigation.view');
                    $nav->add('Manage', route('administrator.navigation.index'))
                        ->icon('cogs')
                        ->data([
                            'permission' => 'navigation.view',
                            'append'     => route('administrator.navigation.create'),
                        ]);
                    $navs->each(function ($item) use ($nav) {
                        $nav->add($item->title, route('administrator.navigation.menu.index', $item->id))
                            ->icon('link')
                            ->data([
                                'permission' => 'navigation.view',
                                'append'     => route('administrator.navigation.menu.create', $item->id),
                            ]);
                    });
                } else {
                    $menu->add('Navigation', route('administrator.navigation.index'))->icon('link')
                         ->data(['permission' => 'navigation.view']);
                }

                $contents = $menu->add('Contents', '#')->icon('files-o');
                $contents->add('Articles', route('administrator.articles.index'))
                         ->icon('files-o')
                         ->data([
                             'permission' => 'article.view',
                             'append'     => route('administrator.articles.create'),
                         ]);
                $contents->add('Categories', route('administrator.categories.index'))
                         ->icon('file-text')
                         ->data([
                             'permission' => 'category.view',
                             'append'     => route('administrator.categories.create'),
                         ]);
                $contents->add('Widgets', route('administrator.widgets.index'))->icon('plug')
                         ->data([
                             'permission' => 'widget.view',
                             'append'     => route('administrator.widgets.create'),
                         ]);
                $contents->add('Media', route('administrator.media.index'))->icon('image')
                         ->data('permission', 'media.view');

                $mod     = $menu->add('Modules', '#')->icon('plug');
                $modules = app('modules')->all();
                collect($modules)->each(function ($module) use ($mod) {
                    /** @var \Pingpong\Modules\Module $module */
                    $mod->add($module->getStudlyName(), url("administrator/{$module->getLowerName()}"))->icon('file');
                });

                $themes = $menu->add('Themes', route('administrator.themes.index'))->icon('windows');

                $users = $menu->add('Users', '#')->icon('key');
                $users->add('Manage', route('administrator.users.index'))->icon('users')
                      ->data([
                          'permission' => 'user.view',
                          'append'     => route('administrator.users.create'),
                      ]);
                $users->add('Roles', route('administrator.roles.index'))->icon('shield')
                      ->data([
                          'permission' => 'role.view',
                          'append'     => route('administrator.roles.create'),
                      ]);
                $users->add('Permissions', route('administrator.permissions.index'))->icon('tag')
                      ->data([
                          'permission' => 'permission.view',
                          'append'     => route('administrator.permissions.create'),
                      ]);

                $config = $menu->add('Configurations', '#')->icon('gears');
                $config->add('Lookup Registry', route('administrator.lookup.index'))->icon('list-ul')
                       ->data([
                           'permission' => 'lookup.view',
                           'append'     => route('administrator.lookup.create'),
                       ]);
                $config->add('Global', route('administrator.configuration.index'))->icon('globe')
                       ->data('permission', 'utilities.config');;

                $menu->add('Utilities', route('administrator.utilities.index'))->icon('wrench')
                     ->data('permission', 'utilities.view');

                $menu->add('Logout', route('administrator.logout'))->icon('power-off');
            })->filter(function ($item) {
                if (! $item->data('permission')) {
                    return true;
                }

                return currentUser()->can($item->data('permission')) ?: false;
            });
        }

        $response = $next($request);

        return $response;
    }
}
