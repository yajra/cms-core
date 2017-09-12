<?php

namespace Yajra\CMS\Http\Requests;

use Yajra\CMS\Rules\BladeFile;

class ArticlesFormRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->authorizeResource('article');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $required = $this->isEditing('article') ? 'required|' : 'nullable|';

        return [
            'title'          => 'required|max:255',
            'alias'          => $required . 'max:255|alpha_dash',
            'order'          => 'required|numeric',
            'blade_template' => ['nullable', new BladeFile],
            'body'           => 'required_without:blade_template',
            'category_id'    => 'required',
        ];
    }
}
