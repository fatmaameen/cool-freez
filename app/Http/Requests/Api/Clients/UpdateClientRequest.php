<?php

namespace App\Http\Requests\Api\Clients;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClientRequest extends FormRequest
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
            'email' => ['required', 'email'],
            'password' => ['nullable','string','min:8', 'max:250'],
            'phone_number' => ['nullable'],
            'image' => ['nullable','image', 'mimes:jpg,bmp,png'],
            'address' => ['nullable', 'string', 'max:250'],
        ];
    }
}
