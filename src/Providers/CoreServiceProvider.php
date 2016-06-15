<?php

namespace Yajra\CMS\Providers;

use Yajra\CMS\View\Directives\PageHeaderDirective;
use Yajra\CMS\View\Directives\TooltipDirective;
use Arrilot\Widgets\ServiceProvider as ArrilotWidgetServiceProvider;
use Barryvdh\Debugbar\ServiceProvider as DebugbarServiceProvider;
use Barryvdh\Snappy\ServiceProvider as SnappyServiceProvider;
use Baum\Providers\BaumServiceProvider;
use Caffeinated\Menus\MenusServiceProvider;
use DaveJamesMiller\Breadcrumbs\ServiceProvider as BreadcrumbsServiceProvider;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;
use Laracasts\Flash\FlashServiceProvider;
use Pingpong\Modules\ModulesServiceProvider;
use Rap2hpoutre\LaravelLogViewer\LaravelLogViewerServiceProvider;
use Spatie\Backup\BackupServiceProvider;
use Spatie\Fractal\FractalServiceProvider;
use Themsaid\MailPreview\MailPreviewServiceProvider;
use Yajra\Acl\AclServiceProvider;
use Yajra\Datatables\DatatablesServiceProvider;
use Yajra\Oci8\Oci8ServiceProvider;

class CoreServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->bootCustomValidations();
        $this->bootCustomBladeDirectives();

        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'cms');

        $this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/cms'),
        ]);

        if (config('app.debug') && config('app.debugbar')) {
            $this->app->registerDeferredProvider(DebugbarServiceProvider::class);
        }
    }

    /**
     * Boot custom app validations.
     */
    protected function bootCustomValidations()
    {
        $this->app['validator']->extend('view_exists', function ($attribute, $value, $parameters, $validator) {
            return view()->exists($value);
        });

        $this->app['validator']->extend('slug', function ($attribute, $value) {
            return preg_match('/^[\pL\.\-\_\d+]+$/u', $value);
        });

        $this->app['validator']->extend('json', function ($attribute, $value, $parameters, $validator) {
            json_decode($value);

            return (json_last_error() == JSON_ERROR_NONE);
        });
    }

    /**
     * Boot custom blade directives.
     */
    protected function bootCustomBladeDirectives()
    {
        /** @var BladeCompiler $blade */
        $blade = $this->app['blade.compiler'];
        $blade->directive('tooltip', function ($expression) {
            return "<?php echo app('Yajra\\CMS\\View\\Directives\\TooltipDirective')->handle{$expression}; ?>";
        });

        $blade->directive('pageHeader', function ($expression) {
            return "<?php echo app('Yajra\\CMS\\View\\Directives\\PageHeaderDirective')->handle{$expression}; ?>";
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerProviders();
        $this->registerBindings();
        $this->registerAliases();
    }

    /**
     * Registered required administrator providers.
     */
    protected function registerProviders()
    {
        $this->app->register(ConfigurationServiceProvider::class);
        $this->app->register(RouteServiceProvider::class);
        $this->app->register(ViewComposerServiceProvider::class);
        $this->app->register(ThemeViewFinderServiceProvider::class);
        $this->app->register(Oci8ServiceProvider::class);
        $this->app->register(DatatablesServiceProvider::class);
        $this->app->register(AclServiceProvider::class);
        $this->app->register(MenusServiceProvider::class);
        $this->app->register(BreadcrumbsServiceProvider::class);
        $this->app->register(FlashServiceProvider::class);
        $this->app->register(FractalServiceProvider::class);
        $this->app->register(SnappyServiceProvider::class);
        $this->app->register(BaumServiceProvider::class);
        $this->app->register(RepositoryServiceProvider::class);
        $this->app->register(BackupServiceProvider::class);
        $this->app->register(MailPreviewServiceProvider::class);
        $this->app->register(FormServiceProvider::class);
        $this->app->register(LaravelLogViewerServiceProvider::class);
        $this->app->register(ArrilotWidgetServiceProvider::class);
        $this->app->register(WidgetServiceProvider::class);
        $this->app->register(ModulesServiceProvider::class);
    }

    /**
     * Register IOC bindings.
     */
    protected function registerBindings()
    {
        $this->app->singleton(PageHeaderDirective::class, PageHeaderDirective::class);
        $this->app->singleton(TooltipDirective::class, TooltipDirective::class);
    }

    /**
     * Register application aliases.
     */
    protected function registerAliases()
    {
        $loader = AliasLoader::getInstance();
        $loader->alias('Breadcrumbs', \DaveJamesMiller\Breadcrumbs\Facade::class);
        $loader->alias('Form', \Collective\Html\FormFacade::class);
        $loader->alias('Html', \Collective\Html\HtmlFacade::class);
        $loader->alias('Excel', \Maatwebsite\Excel\Facades\Excel::class);
        $loader->alias('PDF', \Barryvdh\Snappy\Facades\SnappyPdf::class);
        $loader->alias('Image', \Barryvdh\Snappy\Facades\SnappyImage::class);
        $loader->alias('Widget', \Arrilot\Widgets\Facade::class);
        $loader->alias('AsyncWidget', \Arrilot\Widgets\AsyncFacade::class);
        $loader->alias('Module', \Pingpong\Modules\Facades\Module::class);
    }
}
