<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CurricularLogoRequest extends FormRequest
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
            'logo' => ['required', 'file', 'image', 'mimes:png,jpg,jpeg', 'max:20000']
        ];
    }
}
