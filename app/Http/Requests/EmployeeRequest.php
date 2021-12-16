<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
            'th_firstname' => 'required|string|max:191',
            'th_lastname' => 'required|string|max:191',
            'en_firstname' => 'required|string|max:191',
            'en_lastname' => 'required|string|max:191'
        ];
    }
}
