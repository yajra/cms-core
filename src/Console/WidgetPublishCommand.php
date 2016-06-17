<?php

namespace Yajra\CMS\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Yajra\CMS\Widgets\EloquentRepository;

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
    protected $description = 'Install YajraCMS widget.';

    /**
     * @var \Yajra\CMS\Widgets\EloquentRepository
     */
    protected $widgets;

    /**
     * Create a new command instance.
     *
     * @param \Yajra\CMS\Widgets\EloquentRepository $widgets
     */
    public function __construct(EloquentRepository $widgets)
    {
        parent::__construct();
        $this->widgets = $widgets;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $path = app_path('Widgets') . DIRECTORY_SEPARATOR . Str::title($this->argument('name')) . '.json';

        $this->widgets->registerManifest($path);

        $this->info($this->argument('name') . ' widget installed!');
    }
}
