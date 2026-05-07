<?php

namespace App\Repositories;

use App\Models\BloodRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class BloodRequestRepository
{
    /**
     * جلب الطلبات العامة المتوافقة مع فصيلة المتبرع (مع تحسين الأداء)
     * تم استخدام تقنية Bounding Box لتحسين أداء حساب المسافة بدلاً من Full Table Scan
     */
    public function getCompatibleRequests(
        int $userId,
        array $compatibleTypes,
        ?float $lat,
        ?float $long,
        string $urgency,
        int $perPage
    ): LengthAwarePaginator {
        $query = BloodRequest::with(['user' => fn($q) => $q->select('id', 'full_name', 'profile_image', 'phone')])
            ->active()
            ->where('user_id', '!=', $userId)
            ->whereIn('blood_type', $compatibleTypes);

        // فلترة الاستعجال
        if ($urgency !== 'all' && in_array($urgency, ['normal', 'high', 'critical'])) {
            $query->where('urgency', $urgency);
        }

        // تحسين الأداء: استخدام Bounding Box قبل الـ Haversine لتقليل حجم البيانات المحسوبة
        if ($lat && $long) {
            $radiusKm = 50; // نطاق البحث الافتراضي 50 كم
            $latDiff = $radiusKm / 111.0; // تقريب درجات خط العرض
            $longDiff = $radiusKm / (111.0 * cos(deg2rad($lat))); // تقريب درجات خط الطول بناءً على خط العرض

            $query->whereBetween('latitude', [$lat - $latDiff, $lat + $latDiff])
                  ->whereBetween('longitude', [$long - $longDiff, $long + $longDiff])
                  ->select('*')
                  ->selectRaw("
                      ( 6371 * acos( cos( radians(?) ) * cos( radians( latitude ) ) * 
                      cos( radians( longitude ) - radians(?) ) + 
                      sin( radians(?) ) * sin( radians( latitude ) ) ) ) AS distance
                  ", [$lat, $long, $lat])
                  ->orderBy('distance', 'asc');
        } else {
            $query->orderByRaw("CASE urgency WHEN 'critical' THEN 1 WHEN 'high' THEN 2 WHEN 'normal' THEN 3 ELSE 4 END")
                  ->latest();
        }

        return $query->paginate($perPage);
    }
}