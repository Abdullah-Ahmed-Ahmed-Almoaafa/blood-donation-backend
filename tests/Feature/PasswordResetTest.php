<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PasswordResetTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_request_otp()
    {
        // إنشاء مستخدم كامل بالـ Factory المعدل
        $user = User::factory()->create([
            'email' => 'user@example.com',
        ]);

        $response = $this->postJson(route('api.password.forgot'), [
            'email' => 'user@example.com',
        ]);

        $response->assertStatus(200)
                 ->assertJson(['message' => 'إذا كان البريد الإلكتروني مسجلاً، سيتم إرسال رمز التحقق إليه.']);
    }

    // يمكنك إضافة اختبارات أخرى مثل verifyOtp و resetPassword
}