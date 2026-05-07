<?php

namespace App\Console\Commands;

use App\Models\BloodRequest;
use Illuminate\Console\Command;

class ExpireBloodRequests extends Command
{
    protected $signature = 'blood-requests:expire';
    protected $description = 'تحديث الطلبات منتهية الصلاحية إلى حالة cancelled';

    public function handle()
    {
        $count = BloodRequest::where('status', 'open')
            ->where('expires_at', '<', now())
            ->update(['status' => 'cancelled']);

        $this->info("تم إنهاء {$count} طلب منتهي الصلاحية.");
    }
}