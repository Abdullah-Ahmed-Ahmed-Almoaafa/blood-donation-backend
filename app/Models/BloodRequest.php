<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BloodRequest extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id', 'patient_name', 'blood_type', 'units_required', 
        'location', 'longitude', 'latitude', 'urgency', 'status', 'expires_at'
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
    ];

    public function scopeActive($query)
{
    return $query->where('status', 'open')
                 ->where('expires_at', '>', now());
}

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function donations()
    {
        return $this->hasMany(Donation::class, 'request_id');
    }
}