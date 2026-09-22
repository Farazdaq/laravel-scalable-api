<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterDeviceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'fcm_token' => [
                'required',
                'string',
                'max:4096',
            ],

            'platform' => [
                'required',
                Rule::in([
                    'ios',
                    'android',
                    'web',
                ]),
            ],

            'device_id' => [
                'nullable',
                'string',
                'max:255',
            ],

            'device_name' => [
                'nullable',
                'string',
                'max:255',
            ],
        ];
    }
}