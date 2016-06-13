<?php

namespace Yajra\CMS\Entities;

use Yajra\CMS\Entities\Traits\HasParameters;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property string type
 * @property string key
 * @property string value
 * @property string parameters
 */
class Lookup extends Model
{
    use HasParameters;

    /**
     * @var string
     */
    protected $table = 'lookups';

    /**
     * @var array
     */
    protected $fillable = ['id', 'type', 'key', 'value', 'parameters'];

    /**
     * Lookup query scope by type.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $type
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeType($query, $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Parameters attribute setter.
     *
     * @param array $parameters
     */
    public function setParametersAttribute($parameters)
    {
        $this->attributes['parameters'] = $parameters;
    }
}
