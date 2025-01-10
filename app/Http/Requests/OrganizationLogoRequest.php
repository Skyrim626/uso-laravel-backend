<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrganizationLogoRequest extends FormRequest
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
        return $this->logoRules();
    }

    /**
     * Return logo validation rules.
     *
     * @return array
     */
    public static function logoRules(): array
    {
        return [
            "logo" => ['required', 'file', 'image', 'mimes:png,jpg,jpeg'],
        ];
    }
}
