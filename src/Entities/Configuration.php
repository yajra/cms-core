<?php

namespace Yajra\CMS\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Configuration
 *
 * @property string key
 * @property string value
 */
class Configuration extends Model
{
    /**
     * @var string
     */
    protected $table = 'configurations';

    /**
     * @var array
     */
    protected $fillable = ['key', 'value'];

    /**
     * Get value by key.
     *
     * @param string $key
     * @return string
     */
    public static function key($key)
    {
        $config = static::where('key', $key)->first();

        return $config->value ?? config($key, null);
    }
}
