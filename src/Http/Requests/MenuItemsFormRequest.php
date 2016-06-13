<?php

namespace Yajra\CMS\Http\Requests;

class MenuItemsFormRequest extends Request
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
            'title' => 'required|max:255',
            'type'  => 'required|max:255',
            'url'   => 'required|max:255',
            'order' => 'required|numeric|max:100',
        ];
    }
}
