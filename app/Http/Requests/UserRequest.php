<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class UserRequest extends FormRequest
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
            'first_name'=>'required|string|min:4',
            'last_name'=>'required|string|min:3',
            'email'=>["required",
            "email",
            Rule::unique('users', 'email')->ignore($this->user)],
            'password'=>'required|string|min:6|confirmed',
            'image'=>   'image',
            'permissions' => 'required|min:1',
        ];
    }
}
