<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PgtAiResultRequest extends FormRequest
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
        return [
            'plant_image' => [
                'required',
                'string',
                function ($attribute, $value, $fail) {
                    // Check if the string is a valid base64
                    if (!preg_match('/^data:.*;base64,/', $value)) {
                        $fail('The plant image must be a valid base64 encoded data.');
                        return;
                    }

                    // Remove the data URL prefix
                    $base64 = substr($value, strpos($value, ',') + 1);
                    
                    // Check if the remaining string is valid base64
                    if (!base64_decode($base64, true)) {
                        $fail('The plant image contains invalid base64 data.');
                        return;
                    }

                    // Check file size (max 5MB)
                    $size = strlen(base64_decode($base64));
                    if ($size > 5 * 1024 * 1024) {
                        $fail('The plant image must not be larger than 5MB.');
                    }
                }
            ],
            'plant_name' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', 'in:healthy,diseased'],
            'disease_name' => ['nullable', 'string', 'max:255'],
            'disease_details' => ['nullable', 'string'],
            'suggested_solution' => ['nullable', 'string'],
            'shared' => ['boolean']
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'plant_image.required' => 'The plant image is required.',
            'plant_name.required' => 'The plant name is required.',
            'plant_name.max' => 'The plant name may not be greater than 255 characters.',
            'status.required' => 'The plant status is required.',
            'status.in' => 'The plant status must be either healthy or diseased.',
            'disease_name.max' => 'The disease name may not be greater than 255 characters.',
            'shared.boolean' => 'The shared field must be true or false.'
        ];
    }
} 