<?php

namespace Yajra\CMS\Http\Requests;

class ArticlesFormRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->isEditing()) {
            return $this->user()->can('article.update');
        }

        return $this->user()->can('article.create');
    }

    /**
     * @return \Illuminate\Routing\Route|object|string
     */
    protected function isEditing()
    {
        $article = $this->route('article');

        return $article;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $required = $this->isEditing() ? 'required|' : 'nullable|';

        return [
            'title'          => 'required|max:255',
            'alias'          => $required . 'max:255|alpha_dash',
            'order'          => 'required|numeric',
            'blade_template' => 'nullable|view_exists',
            'body'           => 'required_without:blade_template',
            'category_id'    => 'required',
        ];
    }
}
