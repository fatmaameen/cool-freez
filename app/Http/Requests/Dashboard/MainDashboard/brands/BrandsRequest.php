<?php

namespace App\Http\Requests\Dashboard\MainDashboard\brands;

use Illuminate\Foundation\Http\FormRequest;

class BrandsRequest extends FormRequest
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
            'id' => [ 'numeric'],
            'brand_en' => ['required', 'string', 'max:50','min:2'],
            'brand_ar' => ['required', 'string', 'max:50','min:2'],
        ];
    }
}
