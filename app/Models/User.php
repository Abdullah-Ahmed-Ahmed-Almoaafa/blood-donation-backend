<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'full_name', 'phone', 'email', 'password', 'blood_type',
        'gender', 'date_of_birth', 'location', 'latitude', 'longitude',
        'profile_image', 'role', 'is_active', 'is_available_for_donation',
        'donation_ineligibility_reason', 'last_donation_date',
        'last_requests_visit_at', 'terms_accepted_at',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'date_of_birth' => 'date',
        'last_donation_date' => 'datetime',
        'is_active' => 'boolean',
        'is_available_for_donation' => 'boolean',
        'last_requests_visit_at' => 'datetime',
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
    ];

    public function requests() { return $this->hasMany(BloodRequest::class, 'user_id'); }
    public function donations() { return $this->hasMany(Donation::class, 'donor_id'); }
    public function devices() { return $this->hasMany(Device::class); }

    // علاقة البصمات
    public function biometricTokens()
    {
        return $this->hasMany(BiometricToken::class);
    }
}