<?php

namespace Yajra\CMS\Widgets\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\File;
use Yajra\CMS\Entities\Extension;
use Yajra\CMS\Exceptions\WidgetNotFoundException;

class EloquentRepository implements Repository
{
    use ValidatesRequests;

    /**
     * Register a widget using manifest config file.
     *
     * @param string $path
     * @throws \Exception
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function registerManifest($path)
    {
        if (! File::exists($path)) {
            throw new \Exception('Widget manifest file does not exist! Path: ' . $path);
        }

        $manifest = File::get($path);
        $manifest = json_decode($manifest, true);
        $this->register($manifest);
    }

    /**
     * Register a widget.
     *
     * @param array $attributes
     * @return $this
     * @throws \Exception
     */
    public function register(array $attributes)
    {
        $validator = $this->getValidationFactory()->make($attributes, [
            'type'       => 'required',
            'name'       => 'required',
            'class'      => 'required',
            'templates'  => 'required',
            'parameters' => 'json',
        ]);

        if ($validator->fails()) {
            throw new \Exception('Invalid widget config detected!');
        }

        $extension       = new Extension;
        $extension->type = 'widget';
        $extension->name = $attributes['name'];
        if (isset($attributes['protected'])) {
            $extension->protected = $attributes['protected'];
        }
        if (isset($attributes['parameters'])) {
            $extension->parameters = $attributes['parameters'];
        }
        $extension->manifest = json_encode($attributes);
        $extension->save();

        return $this;
    }

    /**
     * Find or fail a widget.
     *
     * @param int $id
     * @return \Yajra\CMS\Entities\Extension
     * @throws \Yajra\CMS\Exceptions\WidgetNotFoundException
     */
    public function findOrFail($id)
    {
        try {
            return Extension::query()->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new WidgetNotFoundException('Widget not found!');
        }
    }

    /**
     * Get all registered widgets.
     *
     * @return \Illuminate\Support\Collection
     */
    public function all()
    {
        return Extension::query()->where('type', 'widget')->get();
    }
}
