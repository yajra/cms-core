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
     * @return mixed
     */
    public function param($key)
    {
        return $this->fluentParameters()->get($key);
    }

    /**
     * Fluent version of the entity json encoded parameters.
     *
     * @return \Illuminate\Support\Fluent
     */
    public function fluentParameters()
    {
        $parameters = $this->parameters ?? '{}';

        return new FluentParameters(json_decode($parameters, true));
    }
}
