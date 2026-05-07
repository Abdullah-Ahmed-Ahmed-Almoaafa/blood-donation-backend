<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Donation extends Model
{
    use HasFactory;
    
    protected $fillable = ['donor_id', 'request_id', 'status', 'donated_at','eligibility_confirmed_at'];

    protected $casts = [
        'donated_at' => 'datetime','eligibility_confirmed_at' => 'datetime',
    ];

    public function donor()
    {
        return $this->belongsTo(User::class, 'donor_id');
    }

    public function request()
    {
        return $this->belongsTo(BloodRequest::class, 'request_id');
    }
}