<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentRequest extends FormRequest
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

    private function getPostRules()
    {
        return [
            'name' => 'required|max:191|unique:departments',
            'code' => 'required|max:191|unique:departments',
            'is_active' => 'required|boolean',
        ];
        
    }
    private function getPutRules()
    {
        return [
            'name' => 'required|max:191|unique:departments',
            'code' => 'required|max:191|unique:departments',
        ];
    }
}
