<?php

namespace App\Policies;

use App\Models\BloodRequest;
use App\Models\User;
use Illuminate\Auth\Access\Response; // مهم لاستخدام الرسائل المخصصة

class BloodRequestPolicy
{
    public function update(User $user, BloodRequest $bloodRequest): Response
    {
        // التحقق من الملكية
        if ($user->id !== $bloodRequest->user_id) {
            return Response::deny('غير مصرح لك بتعديل هذا الطلب', 403);
        }

        // التحقق من الحالة
        if ($bloodRequest->status !== 'open') {
            return Response::deny('لا يمكن تعديل طلب تم حجزه أو اكتماله', 400);
        }

        return Response::allow();
    }

    public function delete(User $user, BloodRequest $bloodRequest): Response
    {
        if ($user->id !== $bloodRequest->user_id) {
            return Response::deny('غير مصرح لك بحذف هذا الطلب', 403);
        }

        if ($bloodRequest->status !== 'open') {
            return Response::deny('لا يمكن حذف طلب تم حجزه أو اكتماله', 400);
        }

        return Response::allow();
    }
}
