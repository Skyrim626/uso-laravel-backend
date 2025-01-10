<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class MerchandiseRequest extends FormRequest
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
        return [
            'organization_id' => ['required', 'exists:organizations,id'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'name' => ['required', 'min:2', 'max:255'],
            'description' => ['required', 'min:10', 'max:255'],
            'size' => ['nullable', 'string', 'in:XS,S,M,L,XL,XXL'],  // List of possible sizes
            'color' => ['nullable', 'string', 'max:50'],
            'price' => ['required', 'numeric', 'min:0'],
            'quantity' => ['required', 'integer', 'min:1'],

            // Validation for array of images

            // Validation for array of images
            'images' => [
                'nullable',
                'array',
                function ($attribute, $value, $fail) {
                    /* Log::info('Checking images array:', ['images' => $value]); */

                    // Manually cast 'isMain' to boolean for all images
                    $mainCount = collect($value)->where(function ($image) {
                        // Cast 'isMain' to boolean
                        return filter_var($image['isMain'], FILTER_VALIDATE_BOOLEAN);
                    })->count();

                    // Log::info('Main image count: ' . $mainCount);

                    if ($mainCount !== 1) {
                        $fail('Exactly one image must have the main attribute set to true.');
                    }
                },
            ],
            'images.*.file' => ['file', 'image', 'mimes:png,jpeg,jpg', 'max:2048'], // Validate each file in the array
            'images.*.isMain' => ['required', 'string'], // Ensure isMain is a boolean
        ];
    }
}
