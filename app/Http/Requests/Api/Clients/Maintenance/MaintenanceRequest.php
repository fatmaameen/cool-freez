<?php

namespace App\Http\Requests\Api\Clients\Maintenance;

use Illuminate\Foundation\Http\FormRequest;

use function Laravel\Prompts\text;

class MaintenanceRequest extends FormRequest
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
            'client_id'=>['required'],
            'address'=>['required', 'string'],
            'street_address'=>['required', 'string'],
            'phone_number'=>['required', 'string'],
            'device_type'=>['required', 'string'],
            'type_of_malfunction'=>['required','string'],
        ];
    }
}
