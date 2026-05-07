<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BloodRequestResource;
use App\Models\BloodRequest;
use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Notifications\DonationConfirmed;
use App\Notifications\DonationRejected;
use App\Services\BloodRequestService;
use App\Http\Requests\StoreBloodRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class BloodRequestController extends Controller
{
    use AuthorizesRequests;

    // ✅ حقن الخدمة الشاملة
    public function __construct(private BloodRequestService $bloodRequestService)
    {
    }

    /**
     * 1. إنشاء طلب تبرع جديد (لم يتغير)
     */
    public function store(StoreBloodRequest $request)
    {
        $user = $request->user();

        if (!$user->phone) {
            return response()->json(['message' => 'لا يمكنك إنشاء طلب قبل إضافة رقم هاتف في ملفك الشخصي.'], 422);
        }

        $patientName = $request->is_for_self ? $user->full_name : $request->patient_name;
        $bloodType = $request->is_for_self ? $user->blood_type : $request->blood_type;

        $expiryDays = config('donation.request_expiry_days', 7);

        $bloodRequest = BloodRequest::create([
            'user_id' => $user->id,
            'patient_name' => $patientName,
            'blood_type' => $bloodType,
            'units_required' => $request->units_required,
            'location' => $request->location,
            'urgency' => $request->urgency,
            'status' => 'open',
            'expires_at' => now()->addDays($expiryDays),
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        $bloodRequest->load('user');

        return response()->json([
            'message' => 'تم إرسال طلبك بنجاح',
            'data' => new BloodRequestResource($bloodRequest),
        ], 201);
    }

    /**
     * 2. عرض الطلبات العامة (✅ تم تعديله لاستخدام الخدمة)
     */
    public function index(Request $request)
    {
        $result = $this->bloodRequestService->getGeneralRequests($request->user(), [
            'page' => $request->input('page', 1),
            'urgency' => $request->input('urgency', 'all'),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
        ]);

        return BloodRequestResource::collection($result['requests'])->additional([
            'meta' => [
                'compatible_blood_types' => $result['compatible_types'],
            ]
        ]);
    }

    /**
     * 3. طلباتي الخاصة (لم يتغير)
     */
    public function myRequests(Request $request)
    {
        $requests = BloodRequest::with('user')
            ->with('donations')
            ->where('user_id', $request->user()->id)
            ->latest()
            ->paginate(10);

        return BloodRequestResource::collection($requests)->additional([
            'meta' => [
                'current_page' => $requests->currentPage(),
                'last_page' => $requests->lastPage(),
                'per_page' => $requests->perPage(),
                'total' => $requests->total(),
            ]
        ]);
    }

    /**
     * 4. تحديث طلب (لم يتغير)
     */
    public function update(Request $request, $id)
    {
        $bloodRequest = BloodRequest::findOrFail($id);
        $this->authorize('update', $bloodRequest);

        $request->validate([
            'patient_name' => 'sometimes|required|string',
            'blood_type' => 'sometimes|required|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'units_required' => 'sometimes|required|integer|min:1|max:5',
            'location' => 'sometimes|required|string',
            'urgency' => 'sometimes|required|in:normal,high,critical',
        ], [
            'units_required.min' => 'عدد الوحدات يجب أن يكون 1 على الأقل.',
            'units_required.max' => 'لا يمكن طلب أكثر من 5 وحدات.',
            'blood_type.in' => 'فصيلة الدم غير صالحة.',
            'urgency.in' => 'درجة الاستعجال غير صالحة.',
        ]);

        $bloodRequest->update($request->only([
            'patient_name', 'blood_type', 'units_required', 'location', 'urgency'
        ]));

        $bloodRequest->load('user');

        return response()->json([
            'message' => 'تم تحديث الطلب بنجاح',
            'data' => new BloodRequestResource($bloodRequest),
        ]);
    }

    /**
     * 5. حذف طلب (لم يتغير)
     */
    public function destroy(Request $request, $id)
    {
        $bloodRequest = BloodRequest::findOrFail($id);
        $this->authorize('delete', $bloodRequest);
        $bloodRequest->delete();

        return response()->json(['message' => 'تم حذف الطلب بنجاح']);
    }

    /**
     * 6. عرض تفاصيل طلب (لم يتغير)
     */
    public function show(Request $request, $id)
    {
        $bloodRequest = BloodRequest::with(['user', 'donations' => function ($q) use ($request) {
            $q->where('donor_id', $request->user()->id);
        }])->findOrFail($id);

        if ($bloodRequest->user_id !== $request->user()->id && $bloodRequest->status !== 'open') {
            return response()->json(['message' => 'غير مصرح'], 403);
        }

        return new BloodRequestResource($bloodRequest);
    }

    /**
     * 7. قبول طلب التبرع (✅ تم تعديله لاستخدام الخدمة)
     */
    public function acceptRequest(Request $request, $id)
    {
        $result = $this->bloodRequestService->acceptRequest($request->user(), (int) $id);

        if ($result['status'] === 'error') {
            return response()->json(['message' => $result['message']], $result['code']);
        }

        return response()->json([
            'message' => 'شكراً لك! تم تسجيل استجابتك بنجاح. سيتم إشعار صاحب الطلب بذلك.',
            'request' => new BloodRequestResource($result['data']),
        ]);
    }

    /**
     * 8. قائمة المتبرعين لطلب معين (لم يتغير)
     */
    public function getRequestDonations(Request $request, $requestId)
    {
        $user = $request->user();

        $bloodRequest = BloodRequest::where('id', $requestId)
            ->where('user_id', $user->id)
            ->first();

        if (!$bloodRequest) {
            return response()->json(['message' => 'الطلب غير موجود أو لا يخصك'], 404);
        }

        $donations = Donation::with('donor')
            ->where('request_id', $requestId)
            ->latest()
            ->get();

        return response()->json([
            'message' => 'تم جلب قائمة المتبرعين بنجاح',
            'donations' => $donations->map(function ($donation) {
                return [
                    'donation_id' => $donation->id,
                    'status' => $donation->status,
                    'donor' => [
                        'id' => $donation->donor->id,
                        'name' => $donation->donor->full_name,
                        'location' => $donation->donor->location,
                        'profile_image' => $donation->donor->profile_image,
                        'phone' => $donation->donor->phone,
                    ],
                    'created_at' => $donation->created_at->format('Y-m-d H:i:s'),
                    'donated_at' => $donation->donated_at?->format('Y-m-d H:i:s'),
                ];
            }),
        ]);
    }

    /**
     * 9. تأكيد التبرع (لم يتغير، لكنه يستخدم eligibilityService من الخدمة المحقونة)
     */
    public function confirmDonation(Request $request, $requestId, $donationId)
    {
        $user = $request->user();

        return DB::transaction(function () use ($user, $requestId, $donationId) {
            $bloodRequest = BloodRequest::where('id', $requestId)
                ->where('user_id', $user->id)
                ->first();

            if (!$bloodRequest) {
                return response()->json(['message' => 'الطلب غير موجود أو لا يخصك'], 404);
            }

            if ($bloodRequest->status !== 'pending') {
                return response()->json(['message' => 'لا يمكن تأكيد التبرع في هذه الحالة'], 400);
            }

            $donation = Donation::where('id', $donationId)
                ->where('request_id', $requestId)
                ->where('status', 'pending_confirmation')
                ->first();

            if (!$donation) {
                return response()->json(['message' => 'التبرع غير موجود أو تم التعامل معه مسبقاً'], 404);
            }

            $donor = $donation->donor;

            $donation->update([
                'status' => 'donated',
                'donated_at' => now(),
            ]);

            $bloodRequest->update(['status' => 'donated']);

            // ✅ هنا نستخدم الخدمة المحقونة لتحديث الأهلية
            $this->bloodRequestService->markDonorAsDonated($donor);
            $donor->notify(new DonationConfirmed($donation));

            return response()->json(['message' => 'تم تأكيد التبرع بنجاح. شكراً لكما!']);
        });
    }

    /**
     * 10. رفض تبرع (لم يتغير)
     */
    public function rejectDonation(Request $request, $requestId, $donationId)
    {
        $user = $request->user();

        return DB::transaction(function () use ($user, $requestId, $donationId) {
            $bloodRequest = BloodRequest::where('id', $requestId)
                ->where('user_id', $user->id)
                ->first();

            if (!$bloodRequest) {
                return response()->json(['message' => 'الطلب غير موجود أو لا يخصك'], 404);
            }

            if ($bloodRequest->status !== 'pending') {
                return response()->json(['message' => 'لا يمكن رفض التبرع في هذه الحالة'], 400);
            }

            $donation = Donation::where('id', $donationId)
                ->where('request_id', $requestId)
                ->where('status', 'pending_confirmation')
                ->first();

            if (!$donation) {
                return response()->json(['message' => 'التبرع غير موجود أو تم التعامل معه مسبقاً'], 404);
            }

            $donation->update(['status' => 'cancelled']);
            $bloodRequest->update(['status' => 'open']);
            $donation->donor->notify(new DonationRejected($donation));

            return response()->json(['message' => 'تم رفض التبرع. الطلب الآن مفتوح لمتبرعين آخرين.']);
        });
    }
}