<?php

namespace App\Http\Requests\Dashboard\MainDashboard\admins;

use Illuminate\Foundation\Http\FormRequest;

class AddAdminRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:250'],
            'role_id' => ['required'],
            'email' => ['required', 'email', 'unique:App\Models\User,email'],
            'password' => ['required','nullable', 'string', 'max:250'],
            'phone_number' => ['required','unique:App\Models\User,phone_number'],
            'image' => ['required','image', 'mimes:jpg,bmp,png,jpeg'],
        ];
    }
}
