<?php

namespace Yajra\CMS\Console;

use Illuminate\Console\Command;
use Yajra\CMS\Repositories\Extension\Repository;

class WidgetPublishCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'widget:install {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install YajraCMS widget extension.';

    /**
     * @var \Yajra\CMS\Repositories\Extension\Repository
     */
    private $extensions;

    /**
     * Create a new command instance.
     *
     * @param \Yajra\CMS\Repositories\Extension\Repository $extensions
     */
    public function __construct(Repository $extensions)
    {
        parent::__construct();
        $this->extensions = $extensions;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $path = app_path('Widgets') . DIRECTORY_SEPARATOR . $this->argument('name') . '.json';

        $this->extensions->registerManifest($path);
        $this->laravel->make('cache.store')->forget('extensions.widgets');
        $this->laravel->make('cache.store')->forget('extensions.all');

        $this->info($this->argument('name') . ' widget extension installed!');
    }
}
