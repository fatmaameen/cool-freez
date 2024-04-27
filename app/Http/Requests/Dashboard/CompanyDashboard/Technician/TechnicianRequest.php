<?php

namespace App\Http\Requests\Dashboard\CompanyDashboard\Technician;

use Illuminate\Foundation\Http\FormRequest;

class TechnicianRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:250'],
            'email' => ['required', 'email', 'unique:App\Models\technician,email'],
            'password' => ['required', 'string', 'max:250'],
            'phone_number' => ['required','unique:App\Models\technician,phone_number'],
            'image' => ['required','image', 'mimes:jpg,bmp,png,jpeg'],
        ];
    }
}
