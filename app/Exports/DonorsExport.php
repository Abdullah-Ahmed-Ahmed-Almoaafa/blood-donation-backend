<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class DonorsExport implements FromQuery, WithHeadings, WithMapping
{
    /**
     * جلب البيانات (نستخدم Query للكفاءة مع البيانات الكبيرة)
     */
    public function query()
    {
        return User::query()
            ->where('role', 'user') // تصدير المتبرعين فقط
            ->orderBy('created_at', 'desc');
    }

    /**
     * تسمية الأعمدة (العناوين في الملف)
     */
    public function headings(): array
    {
        return [
            '#ID',
            'الاسم الكامل',
            'البريد الإلكتروني',
            'رقم الهاتف',
            'فصيلة الدم',
            'الجنس',
            'الموقع',
            'تاريخ آخر تبرع',
            'متاح للتبرع',
            'تاريخ التسجيل',
        ];
    }

    /**
     * تنسيق البيانات لكل صف (Map the data)
     */
    public function map($user): array
    {
        return [
            $user->id,
            $user->full_name,
            $user->email,
            $user->phone,
            $user->blood_type,
            $user->gender == 'male' ? 'ذكر' : 'أنثى',
            $user->location,
            $user->last_donation_date ? $user->last_donation_date->format('Y-m-d') : 'لم يتبرع بعد',
            $user->is_available_for_donation ? 'نعم' : 'لا',
            $user->created_at->format('Y-m-d'),
        ];
    }
}