<?php

namespace App\Http\Requests\MainDashboard\consultants;

use Illuminate\Foundation\Http\FormRequest;

class UpdateConsultantsRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'job_title' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:App\Models\consultant,email'],
            'phone_number' => ['required', 'string'],
            'image' => [
                'nullable',
                'image' => [
                    'extensions' => ['jpeg', 'jpg', 'png', 'gif']
                ]
            ],
        ];
    }
}
