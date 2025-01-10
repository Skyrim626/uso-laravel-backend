<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ElectionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Get authenticated user
        $authUser = $this->user();

        // Allow authorize
        return $authUser->hasRole('admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'organization_id' => ['required', 'string', 'exists:organizations,id'],
            'title' => ['required', 'min:5', 'max:150'],
            'description' => ['required', 'min:10', 'max:255'],
            'start_date' => ['required', 'date', 'before:end_date'], // Ensure start_date is before end_date
            'end_date' => ['required', 'date', 'after:start_date'], // Ensure end_date is after start_date
            'image' => ['nullable', 'file', 'image', 'mimes:png,jpg,jpeg', 'max:20000'],
        ];
    }
}
