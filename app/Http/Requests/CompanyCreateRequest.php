<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CompanyCreateRequest extends FormRequest
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
            'name'     => 'required|string|max:255',
            'website'  => 'required|string|max:255',
            'email'    => [
                'required',
                'string',
                'email',
                Rule::unique('companies')->ignore($this->company ? $this->company->id : null),
            ],
        ];

        if ($this->isMethod('post')) {
            $rules['logo'] = 'required|image|mimes:jpeg,png,jpg,gif,svg|dimensions:width=100,height=100';
        } else {
            $rules['logo'] = 'nullable|image|mimes:jpeg,png,jpg,gif,svg|dimensions:width=100,height=100';
        }

        return $rules;
    }
}
