<?php

namespace App\Http\Requests\Clients\pricing;

use Illuminate\Foundation\Http\FormRequest;

class pricingRequest extends FormRequest
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
            // '*.client_id' => 'required|unsignedBigInteger',
            // '*.service_id' => 'required|unsignedBigInteger',
            '*.building_type' => 'required|string',
            '*.floor' => 'required|string',
            '*.brand' => 'required|string',
            '*.air_conditioning_type' => 'required|string',
            // '*.drawing_of_building' => 'required|string',
        ];
    }
}
