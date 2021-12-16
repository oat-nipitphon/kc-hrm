<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
        switch ($this->method()) {
            case 'POST':
                return $this->getPostRules();
            case 'PUT':
                return $this->getPutRules();
            default:
                return $this->rules;
        }
    }

    public function getPostRules()
    {
            return [
            'display_name' => 'required|max:255',
            'name' => 'required|max:100|unique:roles,name',
            'description' => 'required|max:255'
        ];
    }

    public function getPutRules()
    {
            return [
            'display_name' => 'required|max:255',
            'description' => 'required|max:255'
        ];
    }

}
