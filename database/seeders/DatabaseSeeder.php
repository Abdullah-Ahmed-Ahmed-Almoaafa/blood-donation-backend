<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\BloodRequest;
use App\Models\Donation;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // إنشاء 10 مستخدمين
        User::factory(10)->create();

        // إنشاء 20 طلب تبرع
        BloodRequest::factory(20)->create();

        // إنشاء 10 تبرعات
        Donation::factory(10)->create();
    }
}
