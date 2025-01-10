<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
        $requestedBy = $this->input('requestedBy');

        // GeneralRules
        $generalRules = [
            'password' => ['required', 'string', 'min:3', 'max:64']
        ];

        // Check the requested by
        switch ($requestedBy) {
            case "admin":
                $generalRules['username'] = ['required', 'string', 'min:3', 'max:15'];
                break;
            case "officer":
                $generalRules['username'] = ['required', 'string', 'min:3', 'max:15'];
                break;
            case "student":
                $generalRules['username'] = ['required', 'string', 'min:3', 'max:15'];
                break;
        }

        // Return general rules
        return $generalRules;
    }
}
