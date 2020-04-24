<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
      $rules=['name'=>'required',
              'address'=>'required'];
      foreach($this->request->get('phone') as $key => $val)
            {
                $rules['phone'] = 'required|max:10';
            }
              return $rules;

    }
    public function messages()
{
    return [
      //  'title.required' => 'A title is required',
        'phone.required'  => 'A message is required',
    ];
}
}
