<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GroupUserRequest extends FormRequest
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
        $rules = [
            'user'=>['required', Rule::unique('group_user', 'user_id')->where(function ($query) {
                return $query->where('group_id', $this->get("group_id"));
            })
        ],];

        return $rules;
    }

    public function messages()
    {
        return [
            'user.required' => 'Please Choose an Admin.',
            'user.unique' => 'This Admin Is Already Registered On This Group.'
        ];
    }

}
