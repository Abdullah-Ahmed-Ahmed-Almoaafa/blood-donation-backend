<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Events\DonationAccepted;
use App\Listeners\SendDonationAcceptedNotification;
use App\Observers\BloodRequestObserver;
use App\Models\BloodRequest;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        DonationAccepted::class => [
            SendDonationAcceptedNotification::class,
        ],
    ];

    public function boot(): void
    {
        BloodRequest::observe(BloodRequestObserver::class);
    }

}