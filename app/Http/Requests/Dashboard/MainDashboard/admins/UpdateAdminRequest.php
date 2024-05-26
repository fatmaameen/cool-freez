<?php

namespace App\Http\Requests\Dashboard\MainDashboard\admins;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        $userId = $this->route('admin');
        return [
            'name' => ['nullable', 'string', 'max:250'],
            'email' => ['nullable', 'email', Rule::unique('users', 'email')->ignore($userId)],
            'password' => ['nullable', 'string', 'max:250'],
            'phone_number' => ['nullable', Rule::unique('users', 'phone_number')->ignore($userId)],
            'image' => ['nullable','image', 'mimes:jpg,bmp,png'],
        ];
    }
}
