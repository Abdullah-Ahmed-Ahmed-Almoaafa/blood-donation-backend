<?php

namespace App\Notifications;

use App\Models\Donation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Channels\FcmChannel;

class DonationCancelledByDonor extends Notification implements ShouldQueue
{
    use Queueable;

    protected Donation $donation;

    public function __construct(Donation $donation)
    {
        $this->donation = $donation;
    }

    public function via($notifiable)
    {
        return ['database', 'mail', FcmChannel::class];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('إلغاء تبرع من متبرع')
            ->line('قام المتبرع ' . $this->donation->donor->full_name . ' بإلغاء تبرعه لطلبك الخاص بالمريض: ' . $this->donation->request->patient_name)
            ->line('سيتم إعادة فتح الطلب لمتبرعين آخرين.')
            ->action('عرض الطلب', route('api.requests.show', ['id' => $this->donation->request_id]));
    }

    public function toArray($notifiable)
    {
        return [
            'type' => 'donation_cancelled_by_donor',
            'donation_id' => $this->donation->id,
            'request_id' => $this->donation->request_id,
            'donor_name' => $this->donation->donor->full_name,
            'message' => 'قام ' . $this->donation->donor->full_name . ' بإلغاء تبرعه.',
        ];
    }

    public function toFcm($notifiable)
    {
        return [
            'title' => 'إلغاء التبرع',
            'body' => 'قام المتبرع ' . $this->donation->donor->full_name . ' بإلغاء تبرعه لطلبك.',
            'data' => [
                'request_id' => (string) $this->donation->request_id,
                'type' => 'donation_cancelled'
            ]
        ];
    }
}