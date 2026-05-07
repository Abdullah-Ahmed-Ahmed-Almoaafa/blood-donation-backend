<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnableBiometricRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            // التأكد من أنه UUID صالح يتم إرساله من الموبايل
            'device_uuid' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'device_uuid.required' => 'معرف الجهاز مطلوب.',
            'device_uuid.uuid' => 'صيغة معرف الجهاز غير صحيحة.',
        ];
    }
}