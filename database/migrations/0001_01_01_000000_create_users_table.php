<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            
            $table->string('full_name');
            $table->string('phone')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable(); 
            $table->string('password');
            
            $table->enum('blood_type', ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'])->nullable();
            $table->enum('gender', ['male', 'female'])->default('male');
            $table->date('date_of_birth')->nullable();
            $table->string('location')->nullable();
             $table->decimal('latitude', 10, 7)->nullable(); // خط العرض
            $table->decimal('longitude', 10, 7)->nullable(); // خط الطول
            $table->string('profile_image')->nullable();
            
            $table->enum('role', ['user', 'admin'])->default('user');
            $table->boolean('is_active')->default(true);
            $table->boolean('is_available_for_donation')->default(true);
            $table->timestamp('last_donation_date')->nullable();

            $table->timestamp('last_requests_visit_at')->nullable();
            $table->text('donation_ineligibility_reason')
                  ->nullable()
                  ->comment('سبب عدم أهلية التبرع');
            $table->timestamp('terms_accepted_at')->nullable();
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};