<?php

namespace Yajra\CMS\Rules;

use Illuminate\Contracts\Validation\Rule;

class Json implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        json_decode($value);

        return (json_last_error() == JSON_ERROR_NONE);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute value is not a valid json.';
    }
}
