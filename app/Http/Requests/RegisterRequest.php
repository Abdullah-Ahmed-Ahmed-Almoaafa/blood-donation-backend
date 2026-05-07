<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'full_name' => 'required|string|min:2|max:60',
            'phone' => [
                'required',
                'string',
                'regex:/^(77|78|73|71)\d{7}$/',
                Rule::unique('users')->whereNull('deleted_at')
            ],
            'email' => [
                'required',
                'string',
                'email',
                'ends_with:@gmail.com',
                'regex:/^[a-zA-Z]/', 
                Rule::unique('users')->whereNull('deleted_at')
            ],
            'password' => 'required|string|min:8|max:30|confirmed',
            'blood_type' => 'required|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'gender' => 'required|in:male,female',
            'date_of_birth' => [
                'required',
                'date',
                'before_or_equal:' . now()->subYears(18)->format('Y-m-d'),
                'after_or_equal:' . now()->subYears(65)->format('Y-m-d'),
            ],
            'location' => 'required|string|min:2|max:30',
        ];
    }

    public function messages(): array
    {
        return [
            'full_name.required' => 'الاسم الكامل مطلوب.',
            'full_name.min' => 'الاسم الكامل يجب ألا يقل عن حرفين.',
            'full_name.max' => 'الاسم الكامل يجب ألا يزيد عن 60 حرفاً.',
            'phone.required' => 'رقم الهاتف مطلوب.',
            'phone.regex' => 'رقم الهاتف يجب أن يكون 9 أرقام ويبدأ بـ 77 أو 78 أو 73 أو 71.',
            'phone.unique' => 'رقم الهاتف مستخدم بالفعل.',
            'email.required' => 'البريد الإلكتروني مطلوب.',
            'email.email' => 'صيغة البريد الإلكتروني غير صحيحة.',
            'email.ends_with' => 'البريد الإلكتروني يجب أن ينتهي بـ @gmail.com.',
            'email.regex' => 'البريد الإلكتروني يجب أن يبدأ بحرف إنجليزي (وليس برقم).',
            'email.unique' => 'البريد الإلكتروني مستخدم بالفعل.',
            'password.required' => 'كلمة المرور مطلوبة.',
            'password.min' => 'كلمة المرور يجب أن تكون 8 أحرف على الأقل.',
            'password.max' => 'كلمة المرور يجب ألا تزيد عن 30 حرفاً.',
            'password.confirmed' => 'تأكيد كلمة المرور غير متطابق.',
            'blood_type.required' => 'فصيلة الدم مطلوبة.',
            'blood_type.in' => 'فصيلة الدم غير صالحة.',
            'gender.required' => 'الجنس مطلوب.',
            'gender.in' => 'الجنس غير صالح.',
            'date_of_birth.required' => 'تاريخ الميلاد مطلوب.',
            'date_of_birth.date' => 'تاريخ الميلاد غير صحيح.',
            'date_of_birth.before_or_equal' => 'يجب أن يكون عمرك 18 سنة على الأقل.',
            'date_of_birth.after_or_equal' => 'لا يمكن أن يتجاوز العمر 65 سنة.',
            'location.required' => 'الموقع مطلوب.',
            'location.min' => 'الموقع يجب ألا يقل عن حرفين.',
            'location.max' => 'الموقع يجب ألا يزيد عن 30 حرفاً.',
        ];
    }
}