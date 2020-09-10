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
        $password_rule = 'min:8|max:255';

        $rules =  [
            'name'=>'required|max:255',
            'gender'=>'required',
            'type'=>'required',
        ];

        if ($this->isMethod("POST")) {
            $rules["email"] = "required|email|unique:users,email";
            $rules["password"] = $password_rule;
        }
        if ($this->isMethod("PUT")) {
            if($this->password){
                $rules["password"] = $password_rule;

            }

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
