<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\ForgotPasswordOtp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules\Password;

class PasswordResetController extends Controller
{
    private int $maxAttempts = 5;

    /**
     * 1️⃣ إرسال OTP (لأول مرة أو إعادة إرسال)
     */
    public function sendOtp(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        // Cache Cooldown (منع التكرار)
        $cooldownKey = 'otp_cooldown_' . $request->email;
        if (Cache::has($cooldownKey)) {
            return response()->json(['message' => 'يرجى الانتظار دقيقة قبل طلب رمز جديد.'], 429);
        }

        $user = User::withTrashed()->where('email', $request->email)->first();

        // حماية Enumeration: نفس الرسالة للموجود وغير الموجود
        if (!$user) {
            return response()->json(['message' => 'إذا كان البريد الإلكتروني مسجلاً، سيتم إرسال رمز التحقق إليه.']);
        }

        $otp = random_int(100000, 999999);

        // ✅ استخدام updateOrInsert لحل مشكلة Unique Constraint
        // هذا الأمر يحدث السجل إذا كان موجوداً (مستخدم أو لا) أو ينشئ جديداً
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email], // الشرط (البحث بالإيميل)
            [
                'otp_hash' => Hash::make($otp),
                'otp_expires_at' => now()->addMinutes(5),
                'reset_token_hash' => null,
                'reset_expires_at' => null,
                'attempts' => 0,
                'verified_at' => null,
                'used_at' => null, // تصفير الحالة لبدء عملية جديدة
                'created_at' => now(), // تحديث وقت الإنشاء
                'updated_at' => now(),
            ]
        );

        try {
            Mail::to($request->email)->send(new ForgotPasswordOtp($otp));
            Cache::put($cooldownKey, true, 90);
        } catch (\Exception $e) {
            Log::error('فشل إرسال OTP', ['email' => $request->email, 'error' => $e->getMessage()]);
            return response()->json(['message' => 'فشل إرسال رمز التحقق، يرجى المحاولة لاحقاً'], 500);
        }

        return response()->json(['message' => 'إذا كان البريد الإلكتروني مسجلاً، سيتم إرسال رمز التحقق إليه.']);
    }

    /**
     * 2️⃣ إعادة إرسال OTP (مع الحفاظ على المحاولات)
     */
    public function resendOtp(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $cooldownKey = 'otp_cooldown_' . $request->email;
        if (Cache::has($cooldownKey)) {
            return response()->json(['message' => 'يرجئ الانتظار دقيقة ونصف قبل طلب رمز جديد'], 429);
        }

        $user = User::withTrashed()->where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['message' => 'إذا كان البريد الإلكتروني مسجلاً، سيتم إرسال رمز التحقق إليه.']);
        }

        // نتحقق من وجود طلب نشط بالفعل (غير مستخدم)
        $record = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->whereNull('used_at')
            ->first();

        if (!$record) {
            return response()->json(['message' => 'لا يوجد طلب إعادة تعيين نشط لهذا البريد.'], 400);
        }

        if ($record->attempts >= $this->maxAttempts) {
            return response()->json(['message' => 'لقد استنفدت عدد المحاولات المسموح بها. يرجى طلب رمز جديد لاحقاً.'], 429);
        }

        $otp = random_int(100000, 999999);

        DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->update([
                'otp_hash' => Hash::make($otp),
                'otp_expires_at' => now()->addMinutes(5),
                'verified_at' => null,
                'reset_token_hash' => null,
                'reset_expires_at' => null,
                'attempts' => $record->attempts + 1,
                'updated_at' => now(),
            ]);

        try {
            Mail::to($request->email)->send(new ForgotPasswordOtp($otp));
            Cache::put($cooldownKey, true, 60);
        } catch (\Exception $e) {
            Log::error('فشل إرسال OTP', ['email' => $request->email, 'error' => $e->getMessage()]);
            return response()->json(['message' => 'فشل إرسال رمز التحقق، يرجى المحاولة لاحقاً'], 500);
        }

        return response()->json(['message' => 'تم إرسال رمز جديد.']);
    }

    /**
     * 3️⃣ التحقق من OTP
     */
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|digits:6'
        ]);

        return DB::transaction(function () use ($request) {
            $record = DB::table('password_reset_tokens')
                ->where('email', $request->email)
                ->whereNull('used_at')
                ->lockForUpdate()
                ->first();

            if (!$record) {
                return response()->json(['message' => 'طلب غير صالح'], 400);
            }

            if ($record->verified_at) {
                return response()->json(['message' => 'تم التحقق من هذا الرمز مسبقاً'], 400);
            }

            if (!$record->otp_expires_at || now()->gt($record->otp_expires_at)) {
                return response()->json(['message' => 'انتهت صلاحية الرمز'], 400);
            }

            if ($record->attempts >= $this->maxAttempts) {
                return response()->json(['message' => 'تم حظر المحاولات، يرجى طلب رمز جديد'], 403);
            }

            if (!Hash::check($request->otp, $record->otp_hash)) {
                DB::table('password_reset_tokens')
                    ->where('email', $request->email)
                    ->increment('attempts');

                $freshRecord = DB::table('password_reset_tokens')
                    ->where('email', $request->email)
                    ->first();

                $remaining = max(0, $this->maxAttempts - $freshRecord->attempts);
                return response()->json([
                    'message' => "رمز التحقق غير صحيح. لديك {$remaining} محاولات متبقية."
                ], 400);
            }

            $resetToken = bin2hex(random_bytes(32));

            DB::table('password_reset_tokens')
                ->where('email', $request->email)
                ->update([
                    'verified_at' => now(),
                    'otp_hash' => null,
                    'reset_token_hash' => Hash::make($resetToken),
                    'reset_expires_at' => now()->addMinutes(15),
                    'attempts' => 0
                ]);

            return response()->json([
                'message' => 'تم التحقق بنجاح',
                'reset_token' => $resetToken
            ]);
        });
    }

    /**
     * 4️⃣ إعادة تعيين كلمة المرور
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'reset_token' => 'required|string',
            'password' => ['required', 'confirmed', Password::min(8)->letters()->numbers()],
        ]);

        return DB::transaction(function () use ($request) {
            $record = DB::table('password_reset_tokens')
                ->where('email', $request->email)
                ->whereNull('used_at')
                ->lockForUpdate()
                ->first();

            if (!$record || !$record->verified_at) {
                return response()->json(['message' => 'العملية غير صالحة'], 400);
            }

            if (!$record->reset_expires_at || now()->gt($record->reset_expires_at)) {
                return response()->json(['message' => 'انتهت صلاحية العملية'], 400);
            }

            if (!Hash::check($request->reset_token, $record->reset_token_hash)) {
                return response()->json(['message' => 'رمز إعادة التعيين غير صحيح'], 400);
            }

            $user = User::withTrashed()->where('email', $request->email)->first();

            if (!$user) {
                Log::warning('محاولة تعيين كلمة مرور لمستخدم غير موجود', ['email' => $request->email]);
                return response()->json(['message' => 'المستخدم غير موجود'], 404);
            }

            $user->update(['password' => Hash::make($request->password)]);

            if ($user->trashed()) {
                $user->restore();
                if (!$user->is_active) {
                    $user->update(['is_active' => true]);
                }
            }

            $user->tokens()->delete();

            DB::table('password_reset_tokens')
                ->where('email', $request->email)
                ->update([
                    'used_at' => now(),
                    'otp_hash' => null,
                    'reset_token_hash' => null,
                    'attempts' => 0
                ]);

            return response()->json(['message' => 'تم تغيير كلمة المرور بنجاح. سيتم تسجيل الخروج من جميع الأجهزة.']);
        });
    }
}