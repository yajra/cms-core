<?php

namespace Yajra\CMS\Http\Requests;

use Yajra\CMS\Rules\Slug;

class TagsFormRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->authorizeResource('tag');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'slug' => ['max:255', new Slug],
        ];
    }
}
