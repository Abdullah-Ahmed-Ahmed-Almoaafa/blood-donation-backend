<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DonationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'status' => $this->status,
            'donated_at' => $this->donated_at?->format('Y-m-d H:i:s'),
            'eligibility_confirmed_at' => $this->eligibility_confirmed_at?->format('Y-m-d H:i:s'),
            'donor' => new UserResource($this->whenLoaded('donor')),
            'request' => new BloodRequestResource($this->whenLoaded('request')),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}