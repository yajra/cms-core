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
        return $this->authorizeResource('widget');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $required = $this->isEditing('widget') ? 'required|' : 'nullable|';

        return [
            'title'           => 'required|max:255',
            'extension_id'    => 'required|exists:extensions,id',
            'template'        => 'required',
            'custom_template' => $required . 'required_if:template,custom|view_exists',
            'parameter'       => 'required_if:type,menu',
            'position'        => 'required',
            'order'           => 'required|numeric',
        ];
    }
}
