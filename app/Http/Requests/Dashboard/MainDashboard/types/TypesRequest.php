<?php

namespace App\Http\Requests\Dashboard\MainDashboard\types;

use Illuminate\Foundation\Http\FormRequest;

class TypesRequest extends FormRequest
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
            'id' => ['numeric'],
            'type_en' => ['required', 'string', 'max:250'],
            'type_ar' => ['required', 'string', 'max:250'],
        ];
    }
}
