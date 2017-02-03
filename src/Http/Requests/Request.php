<?php

namespace Yajra\CMS\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class Request extends FormRequest
{
    /**
     * Check if user is authorized to perform the action.
     *
     * @param string $resource
     * @return bool
     */
    protected function authorizeResource($resource)
    {
        if ($this->isEditing($resource)) {
            return $this->user()->can($resource . '.update');
        }

        return $this->user()->can($resource . '.create');
    }

    /**
     * Check if request is for update or create.
     * Editing will be identified if route parameter exists.
     *
     * @param string $resource
     * @return bool
     */
    protected function isEditing($resource)
    {
        return !! $this->route($resource);
    }
}
