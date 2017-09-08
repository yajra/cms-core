<?php

namespace Yajra\CMS\Http\Middleware;

use Caffeinated\Menus\Builder;
use Caffeinated\Menus\Facades\Menu;
use Closure;

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
        if (auth()->check() && $request->is(admin_prefix() . '*')) {
            Menu::make('admin', function (Builder $menu) {
                $menu->add('Dashboard', route('administrator.index'))->icon('home');

                $navs = app('navigation')->getPublished();
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
                event('admin.menu.nav', $navs);

                $contents = $menu->add('Contents', '#')->icon('files-o');
                $contents->add('Articles', route('administrator.articles.index'))
                         ->icon('files-o')
                         ->data([
                             'permission' => 'article.view',
                             'append'     => route('administrator.articles.create'),
                         ]);
                $contents->add('Categories', route('administrator.categories.index'))
                         ->icon('folder-open-o')
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
                event('admin.menu.contents', $contents);

                $modules = $menu->add('Modules', '#')->icon('cubes')->data('permission', 'module.view');
                $modules->add('Manage', route('administrator.modules.index'))->icon('cogs')->data('permission', 'module.view');
                event('admin.menu.modules', $modules);

                $menu->add('Themes', route('administrator.themes.index'))
                     ->icon('windows')
                     ->data(['permission' => 'theme.view']);

                $users = $menu->add('Users', '#')->icon('key')
                              ->data([
                                  'permission' => ['user.view', 'role.view', 'permission.view']
                              ]);
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
                event('admin.menu.users', $users);

                $config = $menu->add('Configurations', '#')->icon('gears')
                               ->data([
                                   'permission' => ['extension.view', 'utilities.config']
                               ]);
                $config->add('Extensions', route('administrator.extension.index'))->icon('plug')
                       ->data('permission', 'extension.view');
                $config->add('Global', route('administrator.configuration.index'))->icon('globe')
                       ->data('permission', 'utilities.config');
                event('admin.menu.config', $config);

                $menu->add('Utilities', route('administrator.utilities.index'))->icon('wrench')
                     ->data('permission', 'utilities.view');

                $menu->divide(['class' => 'header text-uppercase', 'text' => 'Add-ons Menu']);
                event('admin.menu.add-ons', $menu);

                $menu->add('Logout', route('administrator.logout'))->icon('power-off')->attribute(['name' => 'logout']);
            })->filter(function ($item) {
                $permissions = (array) $item->data('permission');
                if (! $permissions) {
                    return true;
                }

                return current_user()->canAtLeast($permissions);
            });
        }

        $response = $next($request);

        return $response;
    }
}
