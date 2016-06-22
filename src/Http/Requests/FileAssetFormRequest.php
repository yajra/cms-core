<?php

namespace Yajra\CMS\Http\Requests;

class FileAssetFormRequest extends Request
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
            'name'     => 'required|unique:file_assets|max:255',
            'type'     => 'required',
            'category' => 'required',
            'url'      => 'required',
        ];
    }
}
