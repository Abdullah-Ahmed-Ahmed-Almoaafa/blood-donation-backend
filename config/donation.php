<?php

return [
    /*
    |--------------------------------------------------------------------------
    | إعدادات التبرع
    |--------------------------------------------------------------------------
    */

    // المدة المطلوبة بين التبرعات بالأشهر حسب الجنس
    'waiting_period_months' => [
        'male' => env('DONATION_WAITING_MONTHS_MALE', 3),
        'female' => env('DONATION_WAITING_MONTHS_FEMALE', 4),
    ],

    // صلاحية الطلب بالأيام
    'request_expiry_days' => env('BLOOD_REQUEST_EXPIRY_DAYS', 7),

    // المهلة المسموحة لإلغاء التبرع بالساعات
    'donation_cancel_hours' => env('DONATION_CANCEL_HOURS', 24),
];