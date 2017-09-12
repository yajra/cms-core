<?php

namespace Yajra\CMS\Http\Requests;

use Yajra\CMS\Rules\Slug;

class CategoriesFormRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->authorizeResource('category');
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
            'alias' => ['max:255', new Slug],
        ];
    }
}
