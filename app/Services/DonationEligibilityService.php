<?php

namespace App\Services;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Config;

class DonationEligibilityService
{
    /**
     * التحقق الشامل من الأهلية
     */
    public function checkEligibility(User $user): array
    {
        // 1. التحقق من الحساب النشط
        if (!$user->is_active) {
            return [
                'eligible' => false,
                'reason' => 'حسابك غير نشط. يرجى التواصل مع الإدارة.'
            ];
        }

        // 2. التحقق من العمر
        if ($user->date_of_birth) {
            $age = Carbon::parse($user->date_of_birth)->age;
            if ($age > 65) {
                return [
                    'eligible' => false,
                    'reason' => 'عذراً، لا يمكن التبرع لمن تجاوز 65 عاماً.'
                ];
            }
        }

        // 3. التحقق من المنع اليدوي
        if (!$user->is_available_for_donation && !empty($user->donation_ineligibility_reason)) {
            return [
                'eligible' => false,
                'reason' => $user->donation_ineligibility_reason
            ];
        }

        // 4. التحقق اللحظي من تاريخ آخر تبرع
        if ($user->last_donation_date) {
            $requiredMonths = Config::get('donation.waiting_period_months.' . $user->gender, 3);
            
            // ✅ استخدام copy() لتجنب تعديل الكائن الأصلي ولحساب دقيق
            $lastDonation = Carbon::parse($user->last_donation_date);
            $nextEligibleDate = $lastDonation->copy()->addMonths($requiredMonths);

            if (now()->lt($nextEligibleDate)) {
                // حساب الأيام المتبقية لتحسين تجربة المستخدم
                $daysLeft = now()->diffInDays($nextEligibleDate, false);
                
                return [
                    'eligible' => false,
                    'reason' => "يجب الانتظار حتى تاريخ {$nextEligibleDate->format('Y-m-d')} للتبرع مجدداً (متبقي {$daysLeft} يوم تقريباً)."
                ];
            }
        }

        // 5. التحقق من وجود تبرع معلق
        $hasPendingDonation = $user->donations()
            ->where('status', 'pending_confirmation')
            ->exists();

        if ($hasPendingDonation) {
            return [
                'eligible' => false,
                'reason' => 'لديك طلب تبرع معلق بالفعل. يرجى تأكيده أو إلغاؤه قبل التبرع مجدداً.'
            ];
        }

        return [
            'eligible' => true,
            'reason' => null
        ];
    }

    /**
     * حساب موعد الأهلية القادم
     */
    public function nextEligibleDate(User $user): ?Carbon
    {
        if (!$user->last_donation_date) {
            return now();
        }

        $requiredMonths = Config::get('donation.waiting_period_months.' . $user->gender, 3);
        return Carbon::parse($user->last_donation_date)->addMonths($requiredMonths);
    }

    // داخل DonationEligibilityService.php
/**
 * تحديث حالة المستخدم بعد إتمام التبرع.
 */
        public function markUserAsDonated(User $user): void
        {
            $user->update([
                'last_donation_date' => now(),
                'is_available_for_donation' => false,
                'donation_ineligibility_reason' => 'قام بالتبرع مؤخرًا. سيكون متاحًا للتبرع مرة أخرى بعد انتهاء فترة الانتظار.'
            ]);
        }
}