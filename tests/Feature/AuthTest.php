<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_register()
    {
        $response = $this->postJson(route('api.register'), [
            'full_name' => 'أحمد محمد',
            'phone' => '01234567890',
            'email' => 'ahmed@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'blood_type' => 'A+',
            'gender' => 'male',
            'date_of_birth' => '1990-01-01',
            'location' => 'صنعاء',
        ]);

        $response->assertStatus(201)
                 ->assertJsonStructure(['message', 'user', 'token']);
    }

    public function test_user_can_login()
    {
        // إنشاء مستخدم باستخدام Factory (الآن يتضمن full_name, phone, ...)
        $user = User::factory()->create([
            'email' => 'ahmed@example.com',
            'password' => bcrypt('password123'),
        ]);

        $response = $this->postJson(route('api.login'), [
            'identifier' => 'ahmed@example.com',
            'password' => 'password123',
        ]);

        $response->assertStatus(200)
                 ->assertJsonStructure(['message', 'user', 'token']);
    }
}