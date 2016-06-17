<?php

namespace Yajra\CMS\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Yajra\CMS\Entities\Traits\HasParameters;

/**
 * @property string name
 * @property string type
 * @property string parameters
 * @property bool enabled
 * @property string manifest
 */
class Extension extends Model
{
    use HasParameters;

    /**
     * @var array
     */
    protected $fillable = ['name', 'type', 'enabled', 'parameters'];

    /**
     * Get a widget by name.
     *
     * @param string $name
     * @return $this
     */
    public static function widget($name)
    {
        $builder = static::query();

        return $builder->where('type', 'widget')
                       ->whereRaw('LOWER(name) = ?', [Str::lower($name)])
                       ->first();
    }

    /**
     * Get manifest attribute.
     *
     * @return object
     */
    public function getManifestAttribute()
    {
        return json_decode($this->attributes['manifest'], true);
    }
}
