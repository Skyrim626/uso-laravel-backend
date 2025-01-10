<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PositionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Get authenticated user
        $authUser = $this->user();

        // Allow autorization base on the required role
        return $authUser->hasRole('admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        // Initialize rule
        $generalRules = [
            'name' => ['required', 'min:3', 'max:50'],
            'max_candidates' => ['required', 'integer' ,'min:1'],
        ];

        // POST
        if($this->isMethod('post')) {
            $generalRules['election_id'] = ['required', 'integer', 'exists:elections,id'];
        }

        // Return rules
        return $generalRules;
    }
}
