<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseValidationRequest extends FormRequest
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
        return [
            'contact_fullname' => 'required',
            'contact_email' => 'required',
            'contact_phone' => 'required',
            'contact_question' => 'required',
            'g-recaptcha-response' => 'required'

        ];
    }
}
