<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('donor_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('request_id')->constrained('blood_requests')->onDelete('cascade');
            
            $table->enum('status', ['pending_confirmation', 'donated', 'cancelled'])->default('pending_confirmation');
            $table->timestamp('donated_at')->nullable(); // تاريخ التبرع الفعلي
            $table->timestamp('eligibility_confirmed_at')->nullable();

            $table->unique(['donor_id', 'request_id'], 'donor_request_unique');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};