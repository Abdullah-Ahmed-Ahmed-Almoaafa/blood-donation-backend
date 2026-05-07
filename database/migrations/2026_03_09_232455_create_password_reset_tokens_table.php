<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique()->index(); // ضمان سجل واحد فقط
            $table->string('otp_hash')->nullable();
            // ✅ إضافة index للأداء
            $table->timestamp('otp_expires_at')->nullable()->index(); 
            $table->string('reset_token_hash')->nullable();
            // ✅ إضافة index للأداء
            $table->timestamp('reset_expires_at')->nullable()->index(); 
            $table->unsignedTinyInteger('attempts')->default(0);
            $table->timestamp('verified_at')->nullable();
            $table->timestamp('used_at')->nullable();

            $table->timestamps();
             // ✅ Index مركب لتسريع البحث عن السجلات غير المستخدمة
            $table->index(['email', 'used_at']);

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('password_reset_tokens');
    }
};