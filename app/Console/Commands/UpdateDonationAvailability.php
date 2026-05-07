<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Carbon\Carbon;

class UpdateDonationAvailability extends Command
{
    /**
     * اسم وسيطات الأمر
     *
     * @var string
     */
    protected $signature = 'donation:update-availability';

    /**
     * وصف الأمر
     *
     * @var string
     */
    protected $description = 'تحديث حالة أهلية المستخدمين للتبرع بناءً على تاريخ آخر تبرع';

    /**
     * تنفيذ الأمر
     *
     * @return int
     */
    public function handle()
    {
        $this->info('بدء تحديث أهلية التبرع...');
        
        $updatedCount = 0;
        $totalUsers = 0;

        // استخدام chunk لتجنب مشاكل الذاكرة مع البيانات الكبيرة
        User::where('is_available_for_donation', false)
            ->chunk(100, function ($users) use (&$updatedCount, &$totalUsers) {
                foreach ($users as $user) {
                    $totalUsers++;
                    
                    if ($user->last_donation_date) {
                        $lastDonation = Carbon::parse($user->last_donation_date);
                        $monthsPassed = $lastDonation->diffInMonths(now());
                        
                        // تحديد المدة المطلوبة حسب الجنس
                        $requiredMonths = config('donation.waiting_period_months.' . $user->gender, 3);

                        if ($monthsPassed >= $requiredMonths) {
                            $user->update([
                                'is_available_for_donation' => true,
                                 'donation_ineligibility_reason' => null
                            ]);
                            $updatedCount++;
                            
                            // عرض تقدم العملية (كل 10 مستخدمين)
                            if ($updatedCount % 10 === 0) {
                                $this->line("تم تحديث {$updatedCount} مستخدم حتى الآن...");
                            }
                        }
                    }
                }
            });

        // عرض الملخص النهائي
        $this->newLine();
        $this->info('ملخص التحديث:');
        $this->table(
            ['البيان', 'العدد'],
            [
                ['إجمالي المستخدمين الذين تم فحصهم', $totalUsers],
                ['المستخدمين الذين تم تحديثهم', $updatedCount],
                ['المستخدمين غير المؤهلين', $totalUsers - $updatedCount],
            ]
        );

        $this->newLine();
        $this->info('تم الانتهاء من تحديث الأهلية بنجاح');
        
        return 0; // 0 يعني نجاح
    }
}
