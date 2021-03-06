<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCourseRequest extends FormRequest
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
            'name'=>'required|max:255',
            'start_date' => 'required|date|after:today|before:end_date',
            'end_date' => 'required|date|after:start_date',

        ];
        if($this->isMethod("POST")){
            $rules['professor_id'] = 'required';
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'professor_id.required' => 'Please Specify The Professor'
        ];
    }
}
