<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationResource; // ✅ استيراد الـ Resource
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * جلب جميع الإشعارات (غير المقروءة والمقروءة)
     */
    public function index(Request $request)
    {
        // نجلب الإشعارات مقسمة إلى صفحات
        $notifications = $request->user()
            ->notifications()
            ->latest()
            ->paginate(15);

        // ✅ استخدام Resource Collection للحفاظ على تناسق شكل البيانات
        return NotificationResource::collection($notifications)->additional([
            'meta' => [
                'current_page' => $notifications->currentPage(),
                'last_page' => $notifications->lastPage(),
                'per_page' => $notifications->perPage(),
                'total' => $notifications->total(),
            ]
        ]);
    }

    /**
     * تحديد إشعار كمقروء
     */
    public function markAsRead(Request $request, $id)
    {
        $notification = $request->user()
            ->notifications()
            ->where('id', $id)
            ->first();

        if (!$notification) {
            return response()->json(['message' => 'الإشعار غير موجود'], 404);
        }

        $notification->markAsRead();

        return response()->json(['message' => 'تم تحديد الإشعار كمقروء']);
    }

    /**
     * تحديد جميع الإشعارات كمقروءة
     */
    public function markAllRead(Request $request)
    {
        $request->user()->unreadNotifications->markAsRead();

        return response()->json(['message' => 'تم تحديد جميع الإشعارات كمقروءة']);
    }
}