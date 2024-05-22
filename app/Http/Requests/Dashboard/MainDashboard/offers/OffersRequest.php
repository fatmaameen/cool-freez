<?php

namespace App\Http\Requests\Dashboard\MainDashboard\offers;

use Illuminate\Foundation\Http\FormRequest;

class OffersRequest extends FormRequest
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
            'offer' => [
                'required',
                'image',
                'mimes:jpeg,jpg,png,gif'
            ],
            'link' => ['required', 'string', 'url', 'max:250', 'min:2'],
            'type' => ['required', 'string'],
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     */
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $notification = array(
            'message' => trans('main_trans.error'),
            'alert-type' => 'error'
        );

        throw new \Illuminate\Validation\ValidationException($validator, redirect()->back()->withErrors($validator)->with($notification));
    }
}
