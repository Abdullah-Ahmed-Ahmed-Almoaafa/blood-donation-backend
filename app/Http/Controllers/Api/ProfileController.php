<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use App\Http\Requests\UpdateProfileRequest;

class ProfileController extends Controller
{
    // 1. عرض الملف الشخصي
    public function show(Request $request)
    {
        $user = $request->user()->loadCount(['donations', 'requests']);
        
        return response()->json([
            'message' => 'تم جلب البيانات بنجاح',
            'user' => new UserResource($user),
        ], 200);
    }

    // 2. تحديث البيانات (اسم، هاتف، ايميل، موقع...)

    public function update(UpdateProfileRequest $request)
    {
        $user = $request->user();
        $user->update($request->only([
            'full_name', 'phone', 'email', 'blood_type', 'gender', 'date_of_birth', 'location'
        ]));

        return response()->json([
            'message' => 'تم تحديث البيانات بنجاح',
            'user' => new UserResource($user),
        ], 200);
    }

    // 3. تغيير كلمة المرور
// app/Http/Controllers/Api/ProfileController.php

public function updatePassword(Request $request)
{
    $user = $request->user();

    $request->validate([
        'current_password' => 'required|string',
        'new_password' => 'required|string|min:8|max:30|confirmed',
    ], [
        'current_password.required' => 'كلمة المرور الحالية مطلوبة.',
        'new_password.required' => 'كلمة المرور الجديدة مطلوبة.',
        'new_password.min' => 'كلمة المرور الجديدة يجب أن تتكون من 8 أحرف على الأقل.',
        'new_password.max' => 'كلمة المرور الجديدة يجب ألا تزيد عن 30 حرفاً.',
        'new_password.confirmed' => 'تأكيد كلمة المرور الجديدة غير متطابق.',
    ]);

    if (!Hash::check($request->current_password, $user->password)) {
        return response()->json(['message' => 'كلمة المرور الحالية غير صحيحة.'], 422);
    }

    // 1. تحديث كلمة المرور
    $user->update(['password' => $request->new_password]);

    // 2. إبطال جميع التوكنات (سياسة أمنية)
    $user->tokens()->delete();

    // 3. إصدار توكن جديد للجلسة الحالية
    $newToken = $user->createToken('mobile-app-token')->plainTextToken;

    return response()->json([
        'message' => 'تم تغيير كلمة المرور بنجاح. تم تسجيل الخروج من جميع الأجهزة الأخرى.',
        'token' => $newToken,
    ], 200);
}



    // 4. رفع الصورة الشخصية (بعد التحديث)
        public function uploadImage(Request $request)
        {
            $request->validate([
                'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
            ], [
                'profile_image.required' => 'الصورة الشخصية مطلوبة.',
                'profile_image.image' => 'الملف المرفق يجب أن يكون صورة.',
                'profile_image.mimes' => 'الصورة يجب أن تكون من نوع: jpeg, png, jpg, gif.',
                'profile_image.max' => 'حجم الصورة يجب ألا يتجاوز 5 ميجابايت.',
            ]);

            $user = $request->user();

            // حذف الصورة القديمة
            if ($user->profile_image && Storage::disk('public')->exists($user->profile_image)) {
                Storage::disk('public')->delete($user->profile_image);
            }

            // تجهيز مكتبة الضغط
            $manager = new ImageManager(new Driver());
            $image = $manager->read($request->file('profile_image'));
            $image->scale(width: 500);
            
            $filename = 'profile_images/' . uniqid() . '.webp';

            try {
                $encodedImage = $image->toWebp(quality: 75);
                $success = Storage::disk('public')->put($filename, $encodedImage);

                if (!$success) {
                    throw new \Exception('فشل حفظ الصورة على الخادم.');
                }

                $user->update(['profile_image' => $filename]);

                return response()->json([
                    'message' => 'تم رفع الصورة بنجاح',
                    'profile_image_url' => Storage::url($filename),
                ], 200);

            } catch (\Exception $e) {
                \Log::error('فشل رفع الصورة: ' . $e->getMessage(), [
                    'user_id' => $user->id
                ]);

                return response()->json([
                    'message' => 'حدث خطأ أثناء معالجة الصورة، يرجى المحاولة لاحقاً.'
                ], 500);
            }
        }


    // 5. تحديث الموقع فقط (سريع)
           public function updateLocation(Request $request)
{
    $request->validate([
        'location' => 'required|string|min:2|max:30',
        'latitude' => 'required|numeric',
        'longitude' => 'required|numeric',
    ], [
        'location.required' => 'الموقع مطلوب.',
        'location.min' => 'الموقع يجب ألا يقل عن حرفين.',
        'location.max' => 'الموقع يجب ألا يزيد عن 30 حرفاً.',
        'latitude.required' => 'خط العرض مطلوب.',
        'longitude.required' => 'خط الطول مطلوب.',
    ]);

    $request->user()->update([
        'location' => $request->location,
        'latitude' => $request->latitude,
        'longitude' => $request->longitude,
    ]);

    return response()->json([
        'message' => 'تم تحديث الموقع بنجاح',
        'location' => $request->location
    ], 200);
}



    // 6. تحديث وقت آخر زيارة (للإشعارات) - ميزة مهمة جداً
    public function updateLastVisit(Request $request)
    {
        $request->user()->update(['last_requests_visit_at' => now()]);
        return response()->json(['message' => 'تم تحديث وقت الزيارة'], 200);
    }

    // 7. حذف الحساب
    public function destroy(Request $request)
    {
        $request->user()->delete();
        return response()->json(['message' => 'تم حذف الحساب بنجاح'], 200);
    }
}