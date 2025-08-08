<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserProfileRequest extends FormRequest
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
            'name' => 'required|string|max:50',
            'email' => 'required|email|max:50|unique:users,email,' . $this->user()->id,
            'user_name' => 'nullable|string|max:10',
            'avatar' => 'nullable|image|max:2048',
            'current_password' => ['nullable', 'required_with:new_password', 'current_password'],
            'password' => ['nullable', 'required_with:current_password', 'confirmed', 'min:8', 'different:current_password'],
        ];
    }
}
