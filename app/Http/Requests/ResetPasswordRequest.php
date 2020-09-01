<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
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
            'email'=>'required|email|max:255|exists:users,email',
        ];

        return $rules;
    }

    public  function messages()
    {
        return[
            'email.required'=>'your email please',
            'email.email'=>'form of an email please',
            'email.exists'=>'this email does not exist drinnen',
            ];

    }
}
