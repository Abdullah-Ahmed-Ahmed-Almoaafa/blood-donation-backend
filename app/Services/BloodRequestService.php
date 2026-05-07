<?php

namespace App\Services;

use App\Repositories\BloodRequestRepository;
use App\Models\BloodRequest;
use App\Models\Donation;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use App\Events\DonationAccepted;

class BloodRequestService
{
    public function __construct(
        private BloodRequestRepository $repository,
        private DonationEligibilityService $eligibilityService
    ) {}


    public function getGeneralRequests(User $user, array $filters): array
    {
        $compatibleTypes = $this->getCompatibleBloodTypes($user->blood_type);
        
        $locationKey = ($filters['latitude'] && $filters['longitude']) 
            ? floor($filters['latitude']) . '_' . floor($filters['longitude']) 
            : 'global';
            
        $cacheKey = "blood_requests.user.{$user->id}.page.{$filters['page']}.urgency.{$filters['urgency']}.loc.{$locationKey}";

        $requests = Cache::tags(['blood_requests_list'])->remember($cacheKey, now()->addMinutes(2), function () use ($user, $compatibleTypes, $filters) {
            
            $query = $this->repository->getCompatibleRequests(
                userId: $user->id,
                compatibleTypes: $compatibleTypes,
                lat: $filters['latitude'],
                long: $filters['longitude'],
                urgency: $filters['urgency'],
                perPage: 10
            );

            $query->load(['donations' => function ($q) use ($user) {
                $q->where('donor_id', $user->id)
                  ->where('status', 'pending_confirmation')
                  ->select('id', 'request_id', 'donor_id', 'status');
            }]);

            return $query;
        });

        $user->update(['last_requests_visit_at' => now()]);

        return [
            'requests' => $requests,
            'compatible_types' => $compatibleTypes 
        ];
    }

 
    public function acceptRequest(User $user, int $requestId): array
    {
        $eligibility = $this->eligibilityService->checkEligibility($user);
        if (!$eligibility['eligible']) {
            return ['status' => 'error', 'code' => 403, 'message' => $eligibility['reason']];
        }

        return DB::transaction(function () use ($user, $requestId) {
            $bloodRequest = BloodRequest::where('id', $requestId)
                ->where('status', 'open')
                ->where('expires_at', '>', now())
                ->lockForUpdate()
                ->first();

            if (!$bloodRequest) {
                return ['status' => 'error', 'code' => 404, 'message' => 'الطلب غير متاح أو منتهي الصلاحية'];
            }

            if ($bloodRequest->user_id === $user->id) {
                return ['status' => 'error', 'code' => 400, 'message' => 'لا يمكنك التبرع لطلب خاص بك'];
            }

            if (!$this->isBloodTypeCompatible($user->blood_type, $bloodRequest->blood_type)) {
                return ['status' => 'error', 'code' => 400, 'message' => "فصيلة دمك ({$user->blood_type}) غير متوافقة مع الطلب ({$bloodRequest->blood_type})"];
            }

            if (Donation::where('donor_id', $user->id)->where('request_id', $bloodRequest->id)->exists()) {
                return ['status' => 'error', 'code' => 400, 'message' => 'لقد استجبت لهذا الطلب مسبقاً'];
            }

            $donation = Donation::create([
                'donor_id' => $user->id,
                'request_id' => $bloodRequest->id,
                'status' => 'pending_confirmation',
                'eligibility_confirmed_at' => now(),
            ]);

            event(new DonationAccepted($donation));
            $bloodRequest->update(['status' => 'pending']);
            $bloodRequest->load('user');

            return ['status' => 'success', 'data' => $bloodRequest];
        });
    }

   
    private function isBloodTypeCompatible(string $donorType, string $recipientType): bool
    {
        $compatibility = [
            'O-' => ['O-', 'O+', 'A-', 'A+', 'B-', 'B+', 'AB-', 'AB+'],
            'O+' => ['O+', 'A+', 'B+', 'AB+'],
            'A-' => ['A-', 'A+', 'AB-', 'AB+'],
            'A+' => ['A+', 'AB+'],
            'B-' => ['B-', 'B+', 'AB-', 'AB+'],
            'B+' => ['B+', 'AB+'],
            'AB-' => ['AB-', 'AB+'],
            'AB+' => ['AB+'],
        ];
        
        return in_array($recipientType, $compatibility[$donorType] ?? []);
    }

    private function getCompatibleBloodTypes(string $donorType): array
    {
        return Cache::remember('blood_compatibility_' . $donorType, 86400, function () use ($donorType) {
            $compatibility = [
                'O-' => ['O-', 'O+', 'A-', 'A+', 'B-', 'B+', 'AB-', 'AB+'],
                'O+' => ['O+', 'A+', 'B+', 'AB+'],
                'A-' => ['A-', 'A+', 'AB-', 'AB+'],
                'A+' => ['A+', 'AB+'],
                'B-' => ['B-', 'B+', 'AB-', 'AB+'],
                'B+' => ['B+', 'AB+'],
                'AB-' => ['AB-', 'AB+'],
                'AB+' => ['AB+'],
            ];
            return $compatibility[$donorType] ?? [];
        });
    }

        public function markDonorAsDonated(User $donor): void
    {
        $this->eligibilityService->markUserAsDonated($donor);
    }
}