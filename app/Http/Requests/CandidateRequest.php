<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CandidateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'position_id' => ['required', 'integer', 'exists:positions,id'],
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'photo' => ['nullable', 'file', 'image', 'mimes:png,jpg,jpeg', 'max:20000'],
            'cor' => ['nullable', 'file', 'mimes:pdf', 'max:20000'],
            'grades' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:20000'],
            'moral' => ['nullable', 'file', 'image', 'mimes:png,jpg,jpeg', 'max:20000'],
            'certificate' => ['nullable', 'file', 'mimes:pdf', 'max:20000'],
            'facebook_link' => ['nullable', 'string', 'min:1', 'max:255'],
        ];
    }
}
