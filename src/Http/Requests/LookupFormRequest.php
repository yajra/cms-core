<?php

namespace Yajra\CMS\Http\Requests;

class LookupFormRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type'       => 'required|max:255|slug',
            'key'        => 'required|max:255|slug',
            'value'      => 'required|max:255',
            'parameters' => 'required|json',
        ];
    }
}
