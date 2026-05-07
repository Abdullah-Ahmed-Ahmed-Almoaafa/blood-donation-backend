<?php

namespace App\Services;

use App\Models\User;
use App\Models\BiometricToken;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class BiometricAuthService
{
    /**
     * تفعيل البصمة لجهاز محدد
     * يُرجع الـ Key الصريح لمرة واحدة فقط ليتم حفظه في Keychain/Keystore في الموبايل
     */
    public function enableBiometric(User $user, string $deviceUuid): string
    {
        // توليد Key عشوائي وقوي جداً
        $plainKey = Str::random(64);

        // استخدام updateOrCreate: إذا كان الجهاز مفعلاً مسبقاً، نحدث الـ Key، وإلا ننشئ سجل جديد
        BiometricToken::updateOrCreate(
            [
                'user_id' => $user->id, 
                'device_uuid' => $deviceUuid
            ],
            [
                'token_hash' => Hash::make($plainKey),
                'last_used_at' => null, // إعادة ضبط آخر استخدام
            ]
        );

        return $plainKey; // يُرسل للموبايل مرة واحدة فقط مشفر بين الطرفين (TLS)
    }

    /**
     * تسجيل الدخول بالبصمة
     */
    public function loginWithBiometric(string $email, string $deviceUuid, string $providedKey): array
    {
        $user = User::where('email', $email)->first();

        if (!$user || !$user->is_active) {
            throw ValidationException::withMessages(['email' => ['بيانات الدخول غير صحيحة أو الحساب معطل.']]);
        }

        // البحث عن البصمة الخاصة "بهذا الجهاز بالذات" لهذا المستخدم
        $biometricRecord = BiometricToken::where('user_id', $user->id)
            ->where('device_uuid', $deviceUuid)
            ->first();

        if (!$biometricRecord || !$biometricRecord->verifyKey($providedKey)) {
            throw ValidationException::withMessages(['biometric_key' => ['فشل التحقق من البصمة. تأكد من صلاحية الجهاز.']]); // رسالة عامة لأسباب أمنية
        }

        // تحديث وقت آخر استخدام
        $biometricRecord->touch('last_used_at');

        // إصدار توكن Sanctum للـ API
        $apiToken = $user->createToken('biometric_auth')->plainTextToken;

        return [
            'user' => $user,
            'token' => $apiToken
        ];
    }

    /**
     * إلغاء تفعيل البصمة لجهاز محدد (عند تسجيل الخروج من الجهاز)
     */
    public function revokeBiometric(User $user, string $deviceUuid): void
    {
        BiometricToken::where('user_id', $user->id)
            ->where('device_uuid', $deviceUuid)
            ->delete();
    }

    /**
     * إلغاء تفعيل البصمة لجميع الأجهزة (ميزة أمنية إضافية في الملف الشخصي)
     */
    public function revokeAllBiometrics(User $user): void
    {
        BiometricToken::where('user_id', $user->id)->delete();
    }
}