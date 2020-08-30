<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateGroupRequest extends FormRequest
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

        $rules =  [
            'name'=>'required|max:255',
            'status'=>'required'
        ];


        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => "What is the Group's name?",
            'status.required' => 'Activated or Deactivated'
        ];
    }
}
