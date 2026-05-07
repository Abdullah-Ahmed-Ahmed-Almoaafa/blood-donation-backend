<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rule;
use App\Http\Requests\RegisterRequest;
use App\Services\BiometricAuthService;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log; // لأنك استخدمت Log::warning
use App\Notifications\WelcomeNewUserNotification; // لإرسال الإيميل
use App\Http\Requests\LoginRequest;
use App\Http\Requests\EnableBiometricRequest;
use App\Http\Requests\BiometricLoginRequest;


class AuthController extends Controller
{
    // حقن الـ Service
    public function __construct(private BiometricAuthService $biometricAuthService)
    {
    }
    /**
     * إنشاء حساب جديد (Register)
     */
    public function register(RegisterRequest $request)
    {
        if (User::withTrashed()->where('email', $request->email)->whereNotNull('deleted_at')->exists()) {
            return response()->json(['message' => 'هذا البريد مرتبط بحساب محذوف. استخدم "نسيت كلمة المرور".'], 422);
        }

        if (User::withTrashed()->where('phone', $request->phone)->whereNotNull('deleted_at')->exists()) {
            return response()->json(['message' => 'رقم الهاتف مرتبط بحساب محذوف.'], 422);
        }

        $user = User::create([
            'full_name' => $request->full_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => $request->password,
            'blood_type' => $request->blood_type,
            'gender' => $request->gender,
            'date_of_birth' => $request->date_of_birth,
            'location' => $request->location,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'terms_accepted_at' => now(),
        ]);

        try {
            $user->notify(new WelcomeNewUserNotification($user->full_name));
        } catch (\Exception $e) {
            Log::error('فشل إرسال إيميل الترحيب: ' . $e->getMessage());
        }
            
        $token = $user->createToken('mobile-app-token')->plainTextToken;

        return response()->json([
            'message' => 'تم إنشاء الحساب بنجاح',
            'user' => new UserResource($user),
            'token' => $token,
        ], 201);
    }

    /**
     * تسجيل الدخول (Login)
     */
    public function login(LoginRequest $request)
    {
        $loginType = filter_var($request->identifier, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';
        $user = User::where($loginType, $request->identifier)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'بيانات الدخول غير صحيحة.'], 401);
        }

        if (!$user->is_active) {
            return response()->json(['message' => 'تم تعطيل حسابك. يرجى التواصل مع الإدارة.'], 403);
        }

        return response()->json([
            'message' => 'تم تسجيل الدخول بنجاح',
            'user' => new UserResource($user),
            'token' => $user->createToken('mobile-app-token')->plainTextToken,
        ]);
    }



public function enableBiometric(EnableBiometricRequest $request)
    {
        $biometricKey = $this->biometricAuthService->enableBiometric(
            $request->user(),
            $request->device_uuid
        );

        return response()->json([
            'status' => true,
            'message' => 'تم تفعيل البصمة بنجاح على هذا الجهاز.',
            // ينبه الموبايل: "احفظ هذا الـ Key بأمان في Keystore/Keychain ولا ترسله لأي سيرفر آخر"
            'biometric_key' => $biometricKey 
        ], 201);
    }

// 2. وظيفة تسجيل الدخول بالبصمة
public function loginWithBiometric(BiometricLoginRequest $request)
    {
        try {
            $result = $this->biometricAuthService->loginWithBiometric(
                $request->email,
                $request->device_uuid,
                $request->biometric_key
            );

            return response()->json([
                'status' => true,
                'message' => 'تم تسجيل الدخول بالبصمة بنجاح',
                'user' => new UserResource($result['user']),
                'token' => $result['token'],
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            // إعادة توجيه أخطاء الـ Validation بشكل موحد
            return response()->json([
                'message' => 'فشل التحقق',
                'errors' => $e->errors()
            ], 422);
        }
    }

    /**
     * إلغاء البصمة للجهاز الحالي
     */
    public function disableBiometric(Request $request)
    {
        $request->validate(['device_uuid' => 'required|string']);

        $this->biometricAuthService->revokeBiometric($request->user(), $request->device_uuid);

        return response()->json([
            'message' => 'تم إلغاء تفعيل البصمة على هذا الجهاز بنجاح.'
        ]);
    }
    /**
     * تسجيل الخروج (Logout)
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'تم تسجيل الخروج بنجاح'
        ], 200);
    }   
}