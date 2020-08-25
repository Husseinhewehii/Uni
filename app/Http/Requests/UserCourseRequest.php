<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserCourseRequest extends FormRequest
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
            'course'=>['required', Rule::unique('course_user', 'course_id')->where(function ($query) {
                return $query->where('user_id', $this->get("user_id"));
             })
            ],

        ];

        return $rules;
    }
}
