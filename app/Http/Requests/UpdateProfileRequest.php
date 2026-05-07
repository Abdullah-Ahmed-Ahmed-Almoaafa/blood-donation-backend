<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $user = $this->user();

        return [
            'full_name' => 'sometimes|required|string|min:2|max:60',
            'phone' => [
                'sometimes',
                'required',
                'string',
                'regex:/^(77|78|73|71)\d{7}$/',
                Rule::unique('users')->whereNull('deleted_at')->ignore($user->id)
            ],
            'email' => [
                'sometimes',
                'required',
                'string',
                'email',
                'ends_with:@gmail.com',
                'regex:/^[a-zA-Z]/',
                Rule::unique('users')->whereNull('deleted_at')->ignore($user->id)
            ],
            'blood_type' => 'sometimes|required|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'gender' => 'sometimes|required|in:male,female',
            'date_of_birth' => [
                'sometimes',
                'required',
                'date',
                'before_or_equal:' . now()->subYears(18)->format('Y-m-d'),
                'after_or_equal:' . now()->subYears(65)->format('Y-m-d'),
            ],
            'location' => 'sometimes|required|string|min:2|max:30',
        ];
    }

    public function messages(): array
    {
        return [
            'full_name.min' => 'الاسم الكامل يجب ألا يقل عن حرفين.',
            'full_name.max' => 'الاسم الكامل يجب ألا يزيد عن 60 حرفاً.',
            'phone.regex' => 'رقم الهاتف يجب أن يكون 9 أرقام ويبدأ بـ 77 أو 78 أو 73 أو 71.',
            'phone.unique' => 'رقم الهاتف مستخدم بالفعل.',
            'email.email' => 'صيغة البريد الإلكتروني غير صحيحة.',
            'email.ends_with' => 'البريد الإلكتروني يجب أن ينتهي بـ @gmail.com.',
            'email.regex' => 'البريد الإلكتروني يجب أن يبدأ بحرف إنجليزي (وليس برقم).',
            'email.unique' => 'البريد الإلكتروني مستخدم بالفعل.',
            'blood_type.in' => 'فصيلة الدم غير صالحة.',
            'gender.in' => 'الجنس غير صالح.',
            'date_of_birth.before_or_equal' => 'يجب أن يكون عمرك 18 سنة على الأقل.',
            'date_of_birth.after_or_equal' => 'لا يمكن أن يتجاوز العمر 65 سنة.',
            'location.min' => 'الموقع يجب ألا يقل عن حرفين.',
            'location.max' => 'الموقع يجب ألا يزيد عن 30 حرفاً.',
        ];
    }
}