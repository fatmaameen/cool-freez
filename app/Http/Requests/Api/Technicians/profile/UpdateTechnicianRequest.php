<?php

namespace App\Http\Requests\Api\Technicians\profile;

use Illuminate\Foundation\Http\FormRequest;

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
        $technician = $this->route('technician');
        return [
            'name' => ['required', 'string', 'max:250'],
            'email' => ['required', 'email', 'unique:technicians,email,' . $technician->id],
            'password' => ['nullable', 'string', 'min:8', 'max:250'],
            'phone_number' => ['nullable', 'unique:technicians,phone_number,' . $technician->id],
            'image' => ['nullable', 'image', 'mimes:jpg,bmp,png'],
        ];
    }
}
