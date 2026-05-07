<?php

namespace App\Listeners;

use App\Events\DonationAccepted;
use App\Notifications\DonationRequestAccepted;

class SendDonationAcceptedNotification
{
    public function handle(DonationAccepted $event): void
    {
        $donation = $event->donation;
        $donation->request->user->notify(new DonationRequestAccepted($donation->request, $donation->donor));
    }
}