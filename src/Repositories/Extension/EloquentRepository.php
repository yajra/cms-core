<?php

namespace Yajra\CMS\Repositories\Extension;

use Yajra\CMS\Entities\Extension;
use Yajra\CMS\Repositories\RepositoryAbstract;

class EloquentRepository extends RepositoryAbstract implements Repository
{
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
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    public function findOrFail($id)
    {
        return $this->getModel()->query()->findOrFail($id);
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
}
