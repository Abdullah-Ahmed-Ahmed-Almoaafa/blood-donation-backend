<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CleanExpiredPersonalAccessTokens extends Command
{
    protected $signature = 'sanctum:clean-expired-tokens';
    protected $description = 'حذف توكنات Sanctum المنتهية الصلاحية';

    public function handle()
    {
        $deleted = DB::table('personal_access_tokens')
            ->where('expires_at', '<', now())
            ->delete();

        $this->info("تم حذف {$deleted} توكن منتهي الصلاحية.");
    }
}