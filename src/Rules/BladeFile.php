<?php

namespace Yajra\CMS\Rules;

use Illuminate\Contracts\Validation\Rule;

class BladeFile implements Rule
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
        return view()->exists($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The view blade file must exists.';
    }
}
