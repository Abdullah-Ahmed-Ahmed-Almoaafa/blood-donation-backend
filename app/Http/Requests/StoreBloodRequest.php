<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBloodRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $isForSelf = $this->input('is_for_self', false);

        return [
            'is_for_self' => 'sometimes|boolean',
            'patient_name' => $isForSelf ? 'nullable' : 'required|string|max:255',
            'blood_type' => $isForSelf ? 'nullable' : 'required|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'units_required' => 'required|integer|min:1|max:5',
            'location' => 'required|string|max:255',
            'urgency' => 'required|in:normal,high,critical',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ];
    }

    public function messages(): array
    {
        return [
            'patient_name.required' => 'اسم المريض مطلوب.',
            'blood_type.required' => 'فصيلة الدم مطلوبة.',
            'blood_type.in' => 'فصيلة الدم غير صالحة.',
            'units_required.required' => 'عدد الوحدات مطلوب.',
            'units_required.min' => 'يجب أن يكون عدد الوحدات 1 على الأقل.',
            'units_required.max' => 'لا يمكن طلب أكثر من 5 وحدات دم في المرة الواحدة.',
            'location.required' => 'الموقع مطلوب.',
            'urgency.required' => 'درجة الاستعجال مطلوبة.',
            'urgency.in' => 'درجة الاستعجال غير صالحة.',
        ];
    }
}
