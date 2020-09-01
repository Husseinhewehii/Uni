<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\authenticateUser;
use Auth,Hash;

class ChangePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {

//        $currentPassword = $this->input('old_password');
//            if (!Hash::check($currentPassword, Auth()->user()->password)){
//                return false;
//            }

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        $rules=[
            'old_password' => ['required',new authenticateUser],
            'new_password' => 'required|min:8|max:100|',
            'confirm_password' => 'required_with:new_password|same:new_password|min:8|max:100|',


        ];

        return $rules;
    }

    public function messages()
    {
        return[
            'old_password.required' => 'Old Password is required',
            'new_password.required' => 'New Password is required',
            'confirm_password.required_with' => 'Please confirm your new Passowrd',
            'confirm_password.same' => 'New Password mismatch'

        ];
    }
}
