<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('biometric_tokens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // إذا حذف المستخدم، تمحى بصماته
            
            $table->string('device_uuid'); 
            
            $table->string('token_hash'); // الـ Key المشفر (لا نحفظ النص الصريح أبداً)
            
            $table->timestamp('last_used_at')->nullable(); // لتتبع آخر استخدام
            $table->timestamps();

            // Index مركب لسرعة البحث عند محاولة تسجيل الدخول
            $table->unique(['user_id', 'device_uuid'], 'user_device_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('biometric_tokens');
    }
};