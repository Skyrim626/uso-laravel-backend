<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrganizationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Get authenticated user
        $authUser = $this->user();

        // Authorize if the user has this role
        return $authUser->hasRole('admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        // General rules
        $generalRules =  [
            "curricular_id" => ['required', 'exists:curriculars,id'],
            'officer_id' => ['nullable', 'integer', 'exists:users,id'],
            "name" => ['required', 'min:5', 'max:255'],
            'address' => ['nullable', 'min:10', 'max:255'],
            'phone_number' => ['nullable', 'digits_between:7,11'],
            'email' => ['nullable', 'email', 'min:3', 'max:255', 'unique:organizations,email,' . $this->route('organization_id') . ',id'],
        ];

        // Merge logo rules
        $generalRules = array_merge(
            OrganizationLogoRequest::logoRules(),
            $generalRules,
        );

        // Merge name rules
        $generalRules = array_merge(
            OrganizationNameRequest::nameRules(),
            $generalRules,
        );

        // Return
        return $generalRules;
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            "curricular_id" => $this->curricular_id ?? 1, // Set a default value if null
        ]);
    }
}
