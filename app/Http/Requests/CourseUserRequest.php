<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CourseUserRequest extends FormRequest
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
            'user'=>['required', Rule::unique('course_user', 'user_id')->where(function ($query) {
                return $query->where('course_id', $this->get("course_id"));
            })
            ],

        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'user.required' => 'Please Choose a Student.',
            'user.unique' => 'This Student Is Already Registered On This Course.'
        ];
    }
}
