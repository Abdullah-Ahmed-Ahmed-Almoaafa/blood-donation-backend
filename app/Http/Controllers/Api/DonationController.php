<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Notifications\DonationCancelledByDonor;
use Illuminate\Support\Facades\Config;
use App\Http\Resources\DonationResource; // ✅ استيراد Resource

class DonationController extends Controller
{
    /**
     * عرض تبرعاتي (كمتبرع)
     */
    public function index(Request $request)
    {
        $donations = Donation::with(['request.user'])
            ->where('donor_id', $request->user()->id)
            ->latest()
            ->paginate(10);

        // ✅ استخدام DonationResource للحفاظ على تناسق شكل البيانات
        return DonationResource::collection($donations)->additional([
            'meta' => [
                'current_page' => $donations->currentPage(),
                'last_page' => $donations->lastPage(),
                'per_page' => $donations->perPage(),
                'total' => $donations->total(),
            ]
        ]);
    }

    /**
     * إلغاء التبرع من قبل المتبرع (قبل أن يؤكده صاحب الطلب)
     */
        public function cancel(Request $request, $id)
        {
            $donation = Donation::where('id', $id)
                ->where('donor_id', $request->user()->id)
                ->where('status', 'pending_confirmation')
                ->first();

            if (!$donation) {
                return response()->json(['message' => 'طلب تبرع غير صالح'], 404);
            }

            $cancelHours = Config::get('donation.donation_cancel_hours', 24);

            if ($donation->created_at->diffInHours(now()) > $cancelHours) {
                return response()->json([
                    'message' => "لا يمكن إلغاء التبرع بعد مرور {$cancelHours} ساعة على الحجز"
                ], 400);
            }

        return DB::transaction(function () use ($donation) {
            $donation->update(['status' => 'cancelled']);

            $bloodRequest = $donation->request;
            if ($bloodRequest->status === 'pending') {
                $bloodRequest->update(['status' => 'open']);
            }
                
            $donation->request->user->notify(new DonationCancelledByDonor($donation));

            return response()->json(['message' => 'تم إلغاء استجابتك للطلب']);
        });
    }

   public function show(Request $request, $id)
    {
        $donation = Donation::with(['donor', 'request.user'])->findOrFail($id);
    
        $user = $request->user();
        if ($donation->donor_id !== $user->id && $donation->request->user_id !== $user->id) {
            return response()->json(['message' => 'غير مصرح لك بمشاهدة هذا التبرع'], 403);
        }
    
        return new DonationResource($donation);
    }
}