<?php

namespace Yajra\CMS\Entities\Traits;

use Illuminate\Support\Fluent;

trait HasParameters
{
    /**
     * Parameters attribute setter.
     *
     * @param array $parameters
     */
    public function setParametersAttribute($parameters = [])
    {
        $this->attributes['parameters'] = json_encode($parameters);
    }

    /**
     * Fluent version of the entity json encoded parameters.
     *
     * @return \Illuminate\Support\Fluent
     */
    public function fluentParameters()
    {
        $parameters = $this->parameters ?? '{}';

        return new Fluent(json_decode($parameters));
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
}
