<?php

namespace App\Http\Requests\Dashboard\MainDashboard\admins;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    // public function authorize(): bool
    // {
    //     return false;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['nullable', 'string', 'max:250'],
            // 'role_id' => ['required'],
            'email' => ['nullable', 'email', 'unique:App\Models\User,email'],
            'password' => ['nullable','nullable', 'string', 'max:250'],
            'phone_number' => ['nullable','unique:App\Models\User,phone_number'],
            'image' => ['image', 'mimes:jpg,bmp,png'],
            'is_active' => ['nullable', 'boolean'],
            'is_banned' => ['nullable', 'boolean'],
        ];
    }
}
