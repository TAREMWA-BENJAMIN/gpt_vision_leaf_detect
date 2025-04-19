<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Change this based on your authorization logic
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'phone_number' => 'nullable|string|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|string',
            'user_type' => 'in:admin,researcher,user',
            'subregion_id' => 'nullable|exists:subregions,id',
            'country_id' => 'nullable|exists:countries,id',
            'district_id' => 'nullable|exists:districts,id',
            'is_verified' => 'boolean',
            'photo' => 'nullable|string', // base64 string
            'last_login' => 'nullable|date',
        ];
    }
}
