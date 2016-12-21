<?php

namespace Yajra\CMS\Http\Requests;

class ProfileFormRequest extends Request
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
            'first_name' => 'required',
            'last_name'  => 'required',
            'email'      => 'required|unique:users,email,' . $this->user()->id,
            'avatar'     => 'image',
            'password'   => 'min:4|confirmed',
        ];
    }
}
