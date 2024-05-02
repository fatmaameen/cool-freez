<?php

namespace App\Http\Requests\Api\Clients\Reviews;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
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
            'client_id' => ['required', 'integer'],
            'service_id' => ['required', 'integer'],
            'consultant_id' => ['required', 'integer'],
            'building_files' => ['required', 'array', 'min:1'],
            'building_files.*' => ['required', 'file', 'mimes:pdf'],
        ];
    }
}
