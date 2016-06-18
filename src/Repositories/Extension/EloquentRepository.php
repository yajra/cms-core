<?php

namespace Yajra\CMS\Repositories\Extension;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\File;
use Yajra\CMS\Entities\Extension;
use Yajra\CMS\Exceptions\InvalidManifestException;
use Yajra\CMS\Repositories\RepositoryAbstract;

class EloquentRepository extends RepositoryAbstract implements Repository
{
    use ValidatesRequests;

    /**
     * Install an extension.
     *
     * @param string $type
     * @param array $attributes
     * @return \Yajra\CMS\Entities\Extension
     */
    public function install($type, array $attributes)
    {
        $extension       = new Extension;
        $extension->type = $type;
        $extension->name = $attributes['name'];
        if (isset($attributes['parameters'])) {
            $extension->parameters = $attributes['parameters'];
        }
        $extension->manifest = json_encode($attributes);
        $extension->save();

        return $extension;
    }

    /**
     * Uninstall extension.
     *
     * @param int $id
     * @throws \Exception
     */
    public function uninstall($id)
    {
        $extension = $this->getModel()->query()->findOrFail($id);
        // TODO: remove extension files.
        $extension->delete();
    }

    /**
     * Get repository model.
     *
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Builder
     */
    public function getModel()
    {
        return new Extension;
    }

    /**
     * Get all extensions.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {
        return $this->getModel()->all();
    }

    /**
     * Find or fail an extension.
     *
     * @param int $id
     * @return \Yajra\CMS\Entities\Extension
     */
    public function findOrFail($id)
    {
        return $this->getModel()->query()->findOrFail($id);
    }

    /**
     * Get all registered widgets.
     *
     * @return \Illuminate\Support\Collection
     */
    public function allWidgets()
    {
        return $this->getModel()->query()->where('type', 'widget')->get();
    }

    /**
     * Register an extension using manifest config file.
     *
     * @param string $path
     * @throws \Exception
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function registerManifest($path)
    {
        if (! File::exists($path)) {
            throw new \Exception('Extension manifest file does not exist! Path: ' . $path);
        }

        $manifest = File::get($path);
        $manifest = json_decode($manifest, true);
        $this->register($manifest);
    }

    /**
     * Register an extension.
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
        ]);

        if ($validator->fails()) {
            throw new InvalidManifestException("Invalid manifest file detected!");
        }

        $extension       = new Extension;
        $extension->type = $attributes['type'];
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
}
