<?php

namespace App\Observers;

use App\Models\BloodRequest;
use Illuminate\Support\Facades\Cache;

class BloodRequestObserver
{
    /**
     * دالة مساعدة لمسح الكاش
     */
    protected function clearRequestCache()
    {
        \Log::info('=== CLEARING CACHE ===');
        Cache::tags(['blood_requests_list'])->flush();
        \Log::info('=== CACHE CLEARED ===');
    }

    /**
     * عند إنشاء طلب جديد
     */
    public function created(BloodRequest $bloodRequest): void
    {
        \Log::info('=== OBSERVER CALLED ===', [
            'request_id' => $bloodRequest->id,
            'patient_name' => $bloodRequest->patient_name
        ]);
        $this->clearRequestCache();
    }

    /**
     * عند تعديل طلب
     */
    public function updated(BloodRequest $bloodRequest): void
    {
        // نمسح الكاش فقط إذا تغيرت حقول تؤثر على القائمة (الحالة، الموقع، الاستعجال...)
        if ($bloodRequest->isDirty(['status', 'blood_type', 'location', 'urgency', 'expires_at'])) {
            $this->clearRequestCache();
        }
    }

    /**
     * عند حذف طلب
     */
    public function deleted(BloodRequest $bloodRequest): void
    {
        $this->clearRequestCache();
    }
}