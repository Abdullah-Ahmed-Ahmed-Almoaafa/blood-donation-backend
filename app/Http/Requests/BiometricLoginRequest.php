<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BiometricLoginRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'email' => 'required|email|exists:users,email',
            'device_uuid' => 'required|string',
            'biometric_key' => 'required|string|min:60', // الـ Key الذي يحفظه الموبايل
        ];
    }
}