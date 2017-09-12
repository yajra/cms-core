<?php

namespace Yajra\CMS\Providers;

use DaveJamesMiller\Breadcrumbs\BreadcrumbsGenerator;
use DaveJamesMiller\Breadcrumbs\BreadcrumbsManager;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;
use Yajra\Acl\Models\Permission;
use Yajra\CMS\Entities\Article;
use Yajra\CMS\Entities\Category;
use Yajra\CMS\Entities\Widget;
use Yajra\CMS\Http\Controllers\ArticleController;
use Yajra\CMS\Http\Controllers\AuthController;
use Yajra\CMS\Http\Controllers\CategoryController;
use Yajra\CMS\Http\Controllers\TagsController;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your site controller routes.
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router $router
     * @return void
     */
    public function map(Router $router)
    {
        $router->bind('widget', function ($id) use ($router) {
            if ($router->is(admin_prefix() . '*')) {
                return Widget::withoutGlobalScope('menu_assignment')->findOrFail($id);
            }

            return Widget::findOrFail($id);
        });

        $this->mapWebRoutes($router);
    }

    /**
     * Define the "web" routes for the application.
     * These routes all receive session state, CSRF protection, etc.
     *
     * @param  \Illuminate\Routing\Router $router
     * @return void
     */
    protected function mapWebRoutes(Router $router)
    {
        $this->mapArticleRoutes($router);
        $this->mapCategoryRoutes($router);
        $this->mapTagsRoutes($router);
        $this->mapAdministratorAuthenticationRoutes($router);
        $this->mapAdministratorRoutes($router);
        $this->mapFrontendRoutes($router);
    }

    /**
     * Map dynamic article routes using the slug.
     *
     * @param \Illuminate\Routing\Router $router
     */
    protected function mapArticleRoutes(Router $router)
    {
        try {
            /** @var \Yajra\CMS\Repositories\Article\Repository $repository */
            $repository = app('articles');
            $repository->getAllPublished()->each(function (Article $article) use ($router) {
                $middleware = ['web'];
                if ($article->requiresAuthentication()) {
                    $middleware[] = 'auth';
                }

                if ($article->permissions->count()) {
                    if ($article->authorization === 'can') {
                        $article->permissions->each(
                            function (Permission $permission) use ($middleware) {
                                $middleware[] = 'can:' . $permission->slug;
                            }
                        );
                    } else {
                        $abilities    = $article->permissions->pluck('slug')->toArray();
                        $middleware[] = 'canAtLeast:' . implode(',', $abilities);
                    }
                }

                if ($article->hasTheme()) {
                    $middleware[] = 'theme:' . $article->getTheme();
                }

                $router->get($article->present()->slug,
                    function () use ($article, $router) {
                        return $this->app->call(ArticleController::class . '@show', [
                            'id'         => $article->id,
                            'parameters' => $router->current()->parameters(),
                        ]);
                    })->middleware($middleware)->name($article->getRouteName());

                /** @var \DaveJamesMiller\Breadcrumbs\BreadcrumbsManager $breadcrumb */
                $breadcrumb = resolve(BreadcrumbsManager::class);
                $breadcrumb->register($article->getRouteName(),
                    function (BreadcrumbsGenerator $breadcrumbs) use ($article) {
                        if ($article->is_page) {
                            $breadcrumbs->parent('home');
                        } else {
                            $breadcrumbs->parent($article->category->getRouteName());
                        }
                        $breadcrumbs->push($article->title, route($article->getRouteName()));
                    }
                );
            });
        } catch (QueryException $e) {
            // \\_(",)_//
        }
    }

    /**
     * Map dynamic article routes using the slug.
     *
     * @param \Illuminate\Routing\Router $router
     */
    protected function mapCategoryRoutes(Router $router)
    {
        try {
            /** @var \Yajra\CMS\Repositories\Category\Repository $repository */
            $repository = app('categories');
            $repository->getAllPublished()->each(function (Category $category) use ($router) {
                $middleware = ['web'];
                if ($category->requiresAuthentication()) {
                    $middleware[] = 'auth';
                }

                $router->get($category->present()->slug,
                    function () use ($category, $router) {
                        return $this->app->call(CategoryController::class . '@show', [
                            'category'   => $category,
                            'parameters' => $router->current()->parameters(),
                        ]);
                    })->middleware($middleware)->name($category->getRouteName());

                /** @var \DaveJamesMiller\Breadcrumbs\BreadcrumbsManager $breadcrumb */
                $breadcrumb = resolve(BreadcrumbsManager::class);
                $breadcrumb->register($category->getRouteName(),
                    function (BreadcrumbsGenerator $breadcrumbs) use ($category) {
                        if ($category->isChild() && $category->depth > 1) {
                            $parent = $category->ancestors()->where('depth', '<>', 0)->first();
                            $breadcrumbs->parent($parent->getRouteName());
                        } else {
                            $breadcrumbs->parent('home');
                        }
                        $breadcrumbs->push($category->title, route($category->getRouteName()));
                    }
                );
            });
        } catch (QueryException $e) {
            // \\_(",)_//
        }
    }

    protected function mapTagsRoutes(Router $router)
    {
        $router->get('tags/{tag}', TagsController::class . '@show')->name('tags.show')->middleware('web');
        /** @var \DaveJamesMiller\Breadcrumbs\BreadcrumbsManager $breadcrumb */
        $breadcrumb = resolve(BreadcrumbsManager::class);
        $breadcrumb->register('tags.show', function (BreadcrumbsGenerator $breadcrumbs) {
            $breadcrumbs->parent('home');
        });
    }

    /**
     * Map administrator authentication routes.
     *
     * @param \Illuminate\Routing\Router $router
     */
    protected function mapAdministratorAuthenticationRoutes(Router $router)
    {
        $router->group(['prefix' => admin_prefix(), 'middleware' => 'web'], function () use ($router) {
            $router->get('login', AuthController::class . '@showLoginForm')->name('administrator.login');
            $router->get('logout', AuthController::class . '@logout')->name('administrator.logout');
            $router->post('login', AuthController::class . '@login')->name('administrator.login');
        });
    }

    /**
     * Map administrator routes.
     *
     * @param \Illuminate\Routing\Router $router
     */
    protected function mapAdministratorRoutes(Router $router)
    {
        $router->group([
            'middleware' => 'administrator',
            'prefix'     => admin_prefix(),
            'as'         => 'administrator.',
        ], function ($router) {
            require __DIR__ . '/../Http/routes-backend.php';
        });
    }

    /**
     * Frontend specific routes.
     *
     * @param \Illuminate\Routing\Router $router
     */
    protected function mapFrontendRoutes($router) {
        $router->group([
            'middleware' => 'web',
            'as'         => 'site.',
        ], function ($router) {
            require __DIR__ . '/../Http/routes-frontend.php';
        });
    }
}
