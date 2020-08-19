<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'password'=>'required|max:255',
            'confirm_password'=>'required_with:password|same:password',
            'gender'=>'required',
            'type'=>'required',
        ];

        if ($this->isMethod("POST")) {
            $rules["email"] = "required|email|unique:users,email";
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'gender.required' => 'Male or Female?',
            'type.required' => 'Admin or not Admin?'
        ];
    }
}
