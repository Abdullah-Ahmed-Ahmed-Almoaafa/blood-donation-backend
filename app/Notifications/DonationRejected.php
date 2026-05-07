<?php

namespace App\Notifications;

use App\Models\Donation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Channels\FcmChannel;

class DonationRejected extends Notification implements ShouldQueue
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
            ->subject('تم رفض تبرعك')
            ->line('نأسف لإبلاغك أن صاحب الطلب قام برفض تبرعك للمريض: ' . $this->donation->request->patient_name)
            ->line('نأمل أن تجد فرصة أخرى للمساعدة.')
            ->action('عرض التفاصيل', route('api.donations.show', ['id' => $this->donation->id]));
    }

    public function toArray($notifiable)
    {
        return [
            'type' => 'donation_rejected',
            'donation_id' => $this->donation->id,
            'request_id' => $this->donation->request_id,
            'message' => 'تم رفض تبرعك للمريض ' . $this->donation->request->patient_name,
        ];
    }

    public function toFcm($notifiable)
    {
        return [
            'title' => 'تحديث بخصوص طلب التبرع',
            'body' => 'تم اعتذار صاحب الطلب عن تبرعك للمريض ' . $this->donation->request->patient_name,
            'data' => [
                'donation_id' => (string) $this->donation->id,
                'type' => 'donation_rejected'
            ]
        ];
    }
}
