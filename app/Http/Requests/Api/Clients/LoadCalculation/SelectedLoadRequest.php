<?php

namespace App\Http\Requests\Api\Clients\LoadCalculation;

use Illuminate\Foundation\Http\FormRequest;

class SelectedLoadRequest extends FormRequest
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
            'client_id' => ['required','numeric',],
            'service_id' => ['required','numeric'],
            'model_id' => ['required','numeric'],
        ];
    }
}
