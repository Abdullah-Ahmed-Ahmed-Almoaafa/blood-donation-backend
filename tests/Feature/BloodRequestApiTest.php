<?php

namespace Tests\Feature;

use App\Models\BloodRequest;
use App\Models\Donation;
use App\Models\User;
use App\Notifications\RequestAcceptedNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class BloodRequestApiTest extends TestCase
{
    use RefreshDatabase; // إعادة تعيين قاعدة البيانات بعد كل اختبار

    /** @test */
    public function guest_cannot_create_blood_request()
    {
        $response = $this->postJson(route('api.requests.create'), [
            'patient_name' => 'Test Patient',
            'blood_type' => 'A+',
            'units_required' => 1,
            'location' => 'Test Location',
            'urgency' => 'normal',
        ]);

        $response->assertStatus(401); // Unauthorized
    }

    /** @test */
    public function user_can_create_blood_request()
    {
        $user = User::factory()->create(['phone' => '123456789']);

        $response = $this->actingAs($user)->postJson(route('api.requests.create'), [
            'patient_name' => 'Test Patient',
            'blood_type' => 'A+',
            'units_required' => 1,
            'location' => 'Test Location',
            'urgency' => 'normal',
        ]);

        $response->assertStatus(201)
                 ->assertJson(['message' => 'تم إرسال طلبك بنجاح']);

        $this->assertDatabaseHas('blood_requests', [
            'patient_name' => 'Test Patient',
            'user_id' => $user->id,
            'status' => 'open',
        ]);
    }

    /** @test */
    public function user_cannot_accept_own_request()
    {
        $user = User::factory()->create(['blood_type' => 'A+']);
        $request = BloodRequest::factory()->create(['user_id' => $user->id, 'status' => 'open']);

        $response = $this->actingAs($user)->postJson(route("api.requests.accept", ['id' => $request->id]));

        $response->assertStatus(400)
                 ->assertJson(['message' => 'لا يمكنك التبرع لطلب خاص بك']);
    }

    /** @test */
    public function user_cannot_accept_request_if_has_pending_donation()
    {
        // إعداد: مستخدم لديه تبرع معلق بالفعل
        $donor = User::factory()->create(['blood_type' => 'A+']);
        $oldRequest = BloodRequest::factory()->create(['status' => 'pending']);
        Donation::create([
            'donor_id' => $donor->id,
            'request_id' => $oldRequest->id,
            'status' => 'pending_confirmation'
        ]);

        // هدف: طلب جديد
        $newRequest = BloodRequest::factory()->create(['status' => 'open', 'blood_type' => 'A+']);

        // تنفيذ
        $response = $this->actingAs($donor)->postJson(route("api.requests.accept", ['id' => $newRequest->id]));

        // تحقق: يجب أن يرفض بسبب وجود تبرع معلق
        $response->assertStatus(403); 
        $response->assertJsonFragment(['message' => 'لديك طلب تبرع معلق بالفعل. يرجى تأكيده أو إلغاؤه قبل التبرع مجدداً.']);
    }

    /** @test */
    public function user_can_accept_valid_request_and_notification_is_sent()
    {
        // تهيئة Faker للإشعارات (لا نرسل إشعارات حقيقية)
        Notification::fake();

        // إعداد: صاحب طلب ومتبرع
        $owner = User::factory()->create();
        $donor = User::factory()->create(['blood_type' => 'A+']); // متوافق
        
        $bloodRequest = BloodRequest::factory()->create([
            'user_id' => $owner->id,
            'status' => 'open',
            'blood_type' => 'A+'
        ]);

        // تنفيذ
        $response = $this->actingAs($donor)->postJson(route("api.requests.accept", ['id' => $bloodRequest->id]));

        // تحقق 1: نجاح العملية
        $response->assertStatus(200);
        
        // تحقق 2: تغير حالة الطلب
        $this->assertEquals('pending', $bloodRequest->fresh()->status);
        
        // تحقق 3: إنشاء سجل التبرع
        $this->assertDatabaseHas('donations', [
            'donor_id' => $donor->id,
            'request_id' => $bloodRequest->id,
            'status' => 'pending_confirmation'
        ]);

        // تحقق 4: إرسال إشعار لصاحب الطلب
        Notification::assertSentTo(
            $owner,
            RequestAcceptedNotification::class
        );
    }

    /** @test */
    public function policy_prevents_updating_non_owned_request()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        
        $request = BloodRequest::factory()->create(['user_id' => $user1->id, 'status' => 'open']);

        // محاولة تعديل طلب لا يملكه المستخدم 2
        $response = $this->actingAs($user2)->putJson(route("api.requests.update", ['id' => $request->id]), [
            'location' => 'New Location'
        ]);

        $response->assertStatus(403); // Forbidden by Policy
    }

    /** @test */
    public function cache_is_cleared_when_request_is_created()
    {
        $creator = User::factory()->create(['blood_type' => 'A+']);
        $viewer = User::factory()->create(['blood_type' => 'A+']);
        
        // طلب أول (تخزين الكاش)
        $firstResponse = $this->actingAs($viewer)->getJson(route('api.requests.general'));
        $this->assertEquals(0, count($firstResponse->json('data') ?? []));
        
        // إنشاء طلب جديد
        $createResponse = $this->actingAs($creator)->postJson(route('api.requests.create'), [
            'patient_name' => 'New Cache Test',
            'blood_type' => 'A+',
            'units_required' => 1,
            'location' => 'Loc',
            'urgency' => 'normal',
        ]);
        $createResponse->assertStatus(201);
        
        // طلب ثاني (بعد الإنشاء)
        $secondResponse = $this->actingAs($viewer)->getJson(route('api.requests.general'));
        
        // التحقق من وجود الطلب الجديد في القائمة
        $secondResponse->assertJsonFragment(['patient_name' => 'New Cache Test']);
    }

}