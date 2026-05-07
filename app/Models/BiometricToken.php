<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Hash;

class BiometricToken extends Model
{
    // لا نحتاج لـ created_at و updated_at هنا لتبسيط الجدول الأمني (اختياري)
    // public $timestamps = false; 

    protected $fillable = [
        'user_id',
        'device_uuid',
        'token_hash',
        'last_used_at',
    ];

    protected $casts = [
        'last_used_at' => 'datetime',
    ];

    // إخفاء الـ Hash من أي تسريب عرضي عبر API
    protected $hidden = ['token_hash'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * التحقق من صحة الـ Key المرسل من الموبايل مقابل الـ Hash المحفوظ
     */
    public function verifyKey(string $plainKey): bool
    {
        return Hash::check($plainKey, $this->token_hash);
    }
}