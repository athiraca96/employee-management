<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EmployeeCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'company_id'    => 'required|exists:companies,id',
            'first_name'    => 'required|string|max:255',
            'last_name'     => 'required|string|max:255',
            'email'    => [
                'required',
                'string',
                'email',
                Rule::unique('users')->ignore($this->employee ? $this->employee->id : null),
            ],
            'phone'         => 'required|string|regex:/^\d{10}$/',
        ];

        if ($this->isMethod('post')) {
            $rules['password'] = 'required|string|min:8|max:25|confirmed';
        } else {
            $rules['password'] = 'nullable|string|min:8|max:25|confirmed';
        }

        return $rules;
    }
}
