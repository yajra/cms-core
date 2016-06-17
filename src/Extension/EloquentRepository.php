<?php

namespace Yajra\CMS\Extension;

use Yajra\CMS\Entities\Extension;

class EloquentRepository implements Repository
{
    /**
     * @var \Yajra\CMS\Entities\Extension
     */
    protected $extension;

    /**
     * EloquentRepository constructor.
     *
     * @param \Yajra\CMS\Entities\Extension $extension
     */
    public function __construct(Extension $extension)
    {
        $this->extension = $extension;
    }

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
        $extension = $this->extension->query()->findOrFail($id);
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
        return $this->extension->all();
    }

    /**
     * Find or fail an extension.
     *
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    public function findOrFail($id)
    {
        return $this->extension->query()->findOrFail($id);
    }
}
