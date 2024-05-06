<?php

namespace App\Http\Requests\Dashboard\MainDashboard\cfmRates;

use Illuminate\Foundation\Http\FormRequest;

class cfmRatesRequest extends FormRequest
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
            'poor_from' => ['required','numeric'],
            'poor_to' => ['required','numeric'],
            'good_from' => ['required','numeric'],
            'good_to' => ['required','numeric'],
            'excellent_from' => ['required','numeric'],
            'excellent_to' => ['required','numeric'],
        ];
    }
}
