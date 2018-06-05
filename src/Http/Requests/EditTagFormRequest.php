<?php

namespace Yajra\CMS\Http\Requests;

class EditTagFormRequest extends Request
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
        /** @var \Conner\Tagging\Model\Tag $tag */
        $tag = $this->route('tag');

        return [
            'name' => 'required|max:255|' . 'unique:tagging_tags,name,' . $tag->id,
        ];
    }
}
