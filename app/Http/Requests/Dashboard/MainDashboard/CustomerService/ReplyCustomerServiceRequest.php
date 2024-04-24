<?php

namespace App\Http\Requests\Dashboard\MainDashboard\CustomerService;

use Illuminate\Foundation\Http\FormRequest;

class ReplyCustomerServiceRequest extends FormRequest
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
            'subject' => ['required','string','max:100'],
            'title'   => ['required','string','max:100'],
            'email'    => ['required','email','max:100'],
            'message' => ['required','string','max:1000'],
        ];
    }
}
