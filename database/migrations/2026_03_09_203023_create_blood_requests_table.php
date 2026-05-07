<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('blood_requests', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            
            $table->string('patient_name');
            $table->enum('blood_type', ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-']);
            $table->integer('units_required')->default(1);
            $table->string('location')->nullable();;
            $table->decimal('latitude', 10, 7)->nullable(); // خط العرض
            $table->decimal('longitude', 10, 7)->nullable(); // خط الطول
            
            $table->enum('urgency', ['normal', 'high', 'critical'])->default('normal');
            // تحديث: حالات الطلب الجديدة (open, pending, donated, cancelled)
            $table->enum('status', ['open', 'pending', 'donated', 'cancelled'])->default('open');
            
            $table->timestamp('expires_at')->nullable()->index(); // صلاحية الطلب (7 أيام)
            
            $table->softDeletes();
            $table->timestamps();

            // إضافة index لتحسين الأداء
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blood_requests');
    }
};