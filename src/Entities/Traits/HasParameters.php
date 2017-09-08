<?php

namespace Yajra\CMS\Entities\Traits;

trait HasParameters
{
    /**
     * Parameters attribute setter.
     *
     * @param array|string $parameters
     */
    public function setParametersAttribute($parameters)
    {
        if (is_array($parameters)) {
            $this->attributes['parameters'] = json_encode($parameters);
        } else {
            $this->attributes['parameters'] = $parameters;
        }
    }

    /**
     * Get a value in fluent parameters.
     *
     * @param string $key
     * @param string $default
     * @return mixed
     */
    public function param($key, $default = '')
    {
        return $this->parameters[$key] ?? $default;
    }
}
