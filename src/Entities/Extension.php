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
 * @property bool protected
 */
class Extension extends Model
{
    use HasParameters;
    const WIDGET_MENU        = 1;
    const WIDGET_WYSIWYG     = 2;
    const MENU_INTERNAL      = 3;
    const MENU_EXTERNAL      = 4;
    const MENU_ARTICLE       = 5;
    const MENU_CATEGORY_LIST = 6;
    const MENU_CATEGORY_BLOG = 7;
    const WIDGET_BREADCRUMB  = 8;
    const WIDGET_BLADE_VIEW  = 9;
    const WIDGET_LOGIN       = 10;

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

    /**
     * Get version.
     *
     * @return string
     */
    public function getVersionAttribute()
    {
        return $this->manifest['version'] ?? '0.0.0';
    }

    /**
     * Get description.
     *
     * @return string
     */
    public function getDescriptionAttribute()
    {
        return $this->manifest['description'] ?? 'No description';
    }
}
