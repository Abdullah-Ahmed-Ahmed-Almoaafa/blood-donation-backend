<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'full_name' => $this->full_name,
            'phone' => $this->phone,
            'email' => $this->email,
            'blood_type' => $this->blood_type,
            'gender' => $this->gender,
            'date_of_birth' => $this->date_of_birth?->format('Y-m-d'),
            'location' => $this->location,
            'profile_image' => $this->profile_image ? Storage::disk('public')->url($this->profile_image) : null,
            'role' => $this->role,
            'is_active' => $this->is_active,
            'is_available_for_donation' => $this->is_available_for_donation,
            'last_donation_date' => $this->last_donation_date?->format('Y-m-d'),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            
            // التعديل الاحترافي: التحقق من تفعيل البصمة لهذا الجهاز تحديداً
            'has_biometric' => $this->biometricTokens()
                ->where('device_uuid', $request->header('X-Device-UUID') ?? $request->device_uuid)
                ->exists(),

            'donations_count' => $this->whenCounted('donations'),
            'requests_count' => $this->whenCounted('requests'),
        ];
    }
}