<?php

namespace Yajra\CMS\Http\Requests;

class WidgetFormRequest extends Request
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
            'title'           => 'required|max:255',
            'type'            => 'required|max:20',
            'template'        => 'required|view_exists',
            'custom_template' => 'required_if:template,custom|view_exists',
            'parameter'       => 'required_if:type,menu',
            'position'        => 'required',
            'order'           => 'required|numeric',
        ];
    }
}
