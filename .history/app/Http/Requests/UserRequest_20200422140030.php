<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'last_name'=>'required|string|min:6',
            'email'=>'required|email|unique:users| Rule::unique('product_translations', 'name')->ignore($this->product->id, 'product_id')',
            'password'=>'required|string|min:6|confirmed',
            'image'=>   'required|image',
            'permissions' => 'required|min:1',
        ];
    }
}
