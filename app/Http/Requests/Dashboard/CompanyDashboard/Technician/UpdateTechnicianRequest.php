<?php

namespace App\Http\Requests\Dashboard\CompanyDashboard\Technician;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTechnicianRequest extends FormRequest
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
        $technicianId = $this->route('technician');
        return [
            'name' => ['nullable', 'string', 'max:250'],
            'email' => ['nullable', 'email', Rule::unique('technicians', 'email')->ignore($technicianId)],
            'password' => ['nullable', 'string', 'max:250'],
            'phone_number' => ['nullable', Rule::unique('technicians', 'phone_number')->ignore($technicianId)],
            'image' => ['nullable', 'image', 'mimes:jpeg,bmp,png'],
        ];
    }
}
