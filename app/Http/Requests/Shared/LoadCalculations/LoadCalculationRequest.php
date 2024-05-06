<?php

namespace App\Http\Requests\Shared\LoadCalculations;

use Illuminate\Foundation\Http\FormRequest;

class LoadCalculationRequest extends FormRequest
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
            'type_id' => ['required'],
            'brand_id' => ['required'],
            'length' => ['required', 'string'],
            'width' => ['required', 'string'],
            'floor' => ['required', 'string'],
            'using' => ['required', 'string'],
            'appLocal' => ['required', 'string'],
        ];
    }
}
