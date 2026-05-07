<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\DonationResource;

class BloodRequestResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $user = $request->user();
        
        // جلب قيمة الـ Flag التي أضفناها في الـ Controller (إذا لم توجد نفترض false)
        $canShowPhone = $this->show_phone_flag ?? $this->shouldShowPhone($user);

        return [
            'id' => $this->id,
            'patient_name' => $this->patient_name,
            'blood_type' => $this->blood_type,
            'units_required' => $this->units_required,
            'location' => $this->location,
            'urgency' => $this->urgency,
            'status' => $this->status,
            'distance' => $this->whenHas('distance', function() {
                 return round($this->distance, 1); // تقريب المسافة لرقم عشري واحد
            }),
            
            'expires_at' => $this->expires_at?->format('Y-m-d H:i:s'),
            'created_at' => $this->created_at->diffForHumans(),
            
            // ✅ استخدام الـ Flag المحسوب مسبقاً
            'contact_phone' => $this->when($canShowPhone, function() {
                return $this->user->phone;
            }),
            
            'requester' => $this->whenLoaded('user', fn() => [
                'id' => $this->user->id,
                'name' => $this->user->full_name,
                'image' => $this->user->profile_image ? Storage::url($this->user->profile_image) : null,
            ]),

            // ✅ إضافة قائمة التبرعات المرتبطة بالطلب
            'donations' => DonationResource::collection($this->whenLoaded('donations')),
            
            'actions' => [
                'can_edit' => $user?->id === $this->user_id && $this->status === 'open',
                'can_delete' => $user?->id === $this->user_id && $this->status === 'open',
                'can_accept' => $user?->id !== $this->user_id && $this->status === 'open' && $this->expires_at > now(),
                'can_view_donors' => $user?->id === $this->user_id && in_array($this->status, ['pending', 'donated']),
                // أضفنا هذا الحقل لتسهيل التعامل مع الواجهة الأمامية
                'is_accepted_by_me' => (bool)($this->show_phone_flag ?? false),
            ],
        ];
    }
    
    /**
     * منطق احتياطي في حال تم استدعاء الـ Resource من مكان آخر غير الـ index
     */
    protected function shouldShowPhone($currentUser): bool
    {
        if (!$currentUser) {
            return false;
        }
        if ($this->user_id === $currentUser->id) {
            return true;
        }
        
        if ($this->relationLoaded('donations')) {
            return $this->donations->contains(function ($donation) use ($currentUser) {
                return $donation->donor_id === $currentUser->id 
                    && $donation->status === 'pending_confirmation';
            });
        }

        return false;
    }
}