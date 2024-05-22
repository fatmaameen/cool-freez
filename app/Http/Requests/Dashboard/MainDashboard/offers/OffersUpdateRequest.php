<?php

namespace App\Http\Requests\Dashboard\MainDashboard\offers;

use Illuminate\Foundation\Http\FormRequest;

class OffersUpdateRequest extends FormRequest
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
            'offer' => [
                'nullable',
                'image' => [
                    'extensions' => ['jpeg', 'jpg', 'png', 'gif']
                ]
            ],
            'link' => ['required', 'string', 'url', 'max:250','min:2'],
            'type' => ['required','string'],
        ];
    }
}
