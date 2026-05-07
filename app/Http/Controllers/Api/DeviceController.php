<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Device;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    /**
     * تسجيل جهاز جديد أو تحديث التوكن
     */
    public function register(Request $request)
    {
        $request->validate([
            'device_token' => 'required|string',
            'device_type' => 'nullable|string|in:android,ios,web',
        ]);

        $user = $request->user();

        // حذف أي توكن سابق لهذا الجهاز (إذا كان موجوداً بنفس التوكن)
        Device::where('device_token', $request->device_token)->delete();

        // إضافة التوكن الجديد للمستخدم
        $device = Device::updateOrCreate(
        ['user_id' => $user->id, 'device_token' => $request->device_token],
        [
            'device_type' => $request->device_type,
            'is_active' => true,          // ✅ تفعيل الجهاز عند التسجيل
            'last_used_at' => now()       // ✅ تحديث آخر استخدام
        ]
    );

        return response()->json([
            'message' => 'تم تسجيل الجهاز بنجاح',
            'device' => $device
        ]);
    }

    /**
     * إلغاء تسجيل جهاز (عند تسجيل الخروج)
     */
    public function unregister(Request $request)
    {
        $request->validate(['device_token' => 'required|string']);

        Device::where('device_token', $request->device_token)
            ->where('user_id', $request->user()->id)
            ->delete();

        return response()->json(['message' => 'تم إلغاء تسجيل الجهاز']);
    }
}