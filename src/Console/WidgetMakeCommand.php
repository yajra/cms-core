<?php

namespace Yajra\CMS\Console;

use Arrilot\Widgets\Console\WidgetMakeCommand as ArrilotWidgetMakeCommand;

class WidgetMakeCommand extends ArrilotWidgetMakeCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'widget:make';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new YajraCMS widget.';

    /**
     * Build the class with the given name.
     *
     * @param string $name
     * @return string
     */
    protected function buildClass($name)
    {
        $stub = parent::buildClass($name);

        $this->createJsonConfig($name);

        return $stub;
    }

    /**
     * Create json config file for widget details.
     *
     * @param string $name
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    protected function createJsonConfig($name)
    {
        if ($this->files->exists($path = $this->getJsonPath())) {
            $this->error('Widget json config already exists!');

            return;
        }

        $stub = $this->files->get($this->getJsonStubPath());
        $stub = $this->replaceNamespace($stub, $name)->replaceClass($stub, $name);
        $stub = $this->replaceFQCN($stub, $name);
        $stub = $this->replaceView($stub);

        $this->files->put($path, $stub);

        $this->info('Json config created successfully.');
    }

    /**
     * Get the json stub file for the generator.
     *
     * @return string
     */
    protected function getJsonPath()
    {
        return $this->laravel->basePath() . '/app/Widgets/' . $this->argument('name') . '.json';
    }

    /**
     * Get json stub path.
     *
     * @return string
     */
    protected function getJsonStubPath()
    {
        $stubPath = $this->laravel->make('config')->get('laravel-widgets.widget_json_stub');

        return $this->laravel->basePath() . '/' . $stubPath;
    }

    /**
     * Replace class with FQCN.
     *
     * @param string $stub
     * @param string $name
     * @return string
     */
    protected function replaceFQCN($stub, $name)
    {
        $fqcn = str_replace("\\", "\\\\", $name);

        return str_replace('{{fqcn}}', $fqcn, $stub);
    }

    /**
     * Create a new view file for the widget.
     * return void
     */
    protected function createView()
    {
        if ($this->files->exists($path = $this->getViewPath())) {
            $this->error('View already exists!');

            return;
        }

        $this->makeDirectory($path);
        $view = $this->files->get($this->getViewStub('view'));
        $this->files->put($path, $view);

        $form = $this->files->get($this->getViewStub('form'));
        $this->files->put($this->getViewPath('_form'), $form);

        $this->info('Views successfully created.');
    }
}
