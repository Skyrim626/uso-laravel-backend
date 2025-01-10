<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrganizationNameRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Get authenticated user
        $authUser = $this->user();

        // Authorize
        return $authUser->hasRole('admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return $this->nameRules();
    }

     /**
     * Return name validation rules.
     *
     * @return array
     */
    public static function nameRules(): array
    {
        return [
            "name" => ['required', 'min:5', 'max:255'],
        ];
    }
}
