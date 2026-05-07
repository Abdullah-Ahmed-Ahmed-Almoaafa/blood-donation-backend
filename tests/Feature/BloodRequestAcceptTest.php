<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\BloodRequest;
use App\Models\Donation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BloodRequestAcceptTest extends TestCase
{
    use RefreshDatabase;

    public function test_donor_can_accept_open_request()
    {
        // إنشاء مستخدمين
        $requester = User::factory()->create();
        $donor = User::factory()->create([
            'blood_type' => 'O+',
            'is_available_for_donation' => true,
        ]);

        // إنشاء طلب
        $request = BloodRequest::factory()->create([
            'user_id' => $requester->id,
            'blood_type' => 'A+', // O+ يمكنه التبرع لـ A+
            'status' => 'open',
            'expires_at' => now()->addDays(7),
        ]);

        // تسجيل الدخول كمتبرع (لا نرسل eligibility_confirmed)
        $response = $this->actingAs($donor)
        ->postJson(route('api.requests.accept', ['id' => $request->id]));

        $response->assertStatus(200)
            ->assertJson(['message' => 'شكراً لك! تم تسجيل استجابتك بنجاح. سيتم إشعار صاحب الطلب بذلك.']);

        // التحقق من إنشاء التبرع
        $this->assertDatabaseHas('donations', [
            'donor_id' => $donor->id,
            'request_id' => $request->id,
            'status' => 'pending_confirmation',
        ]);

        // التحقق من تسجيل وقت الموافقة
        $donation = Donation::where('donor_id', $donor->id)
            ->where('request_id', $request->id)
            ->first();
        $this->assertNotNull($donation->eligibility_confirmed_at);

        // التحقق من تحديث حالة الطلب
        $this->assertDatabaseHas('blood_requests', [
            'id' => $request->id,
            'status' => 'pending',
        ]);
    }

    public function test_donor_cannot_accept_two_requests_simultaneously()
    {
        // إنشاء مستخدمين وطلبات
        $requester1 = User::factory()->create();
        $requester2 = User::factory()->create();
        $donor = User::factory()->create([
            'blood_type' => 'O+',
            'is_available_for_donation' => true,
        ]);

        $request1 = BloodRequest::factory()->create([
            'user_id' => $requester1->id,
            'blood_type' => 'A+',
            'status' => 'open',
        ]);

        $request2 = BloodRequest::factory()->create([
            'user_id' => $requester2->id,
            'blood_type' => 'B+',
            'status' => 'open',
        ]);

        // قبول الطلب الأول
        $this->actingAs($donor)
            ->postJson(route('api.requests.accept', ['id' => $request1->id]))
            ->assertStatus(200);

        // محاولة قبول الطلب الثاني
        $response = $this->actingAs($donor)
            ->postJson(route('api.requests.accept',['id' => $request2->id]));

        $response->assertStatus(403)
            ->assertJson(['message' => 'لديك طلب تبرع معلق بالفعل. يرجى تأكيده أو إلغاؤه قبل التبرع مجدداً.']);
    }
}