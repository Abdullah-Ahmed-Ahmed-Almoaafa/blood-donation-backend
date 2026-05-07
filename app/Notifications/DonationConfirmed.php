<?php

namespace App\Notifications;

use App\Models\Donation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Channels\FcmChannel;

class DonationConfirmed extends Notification implements ShouldQueue
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
            ->subject('تم تأكيد تبرعك')
            ->line('لقد تم تأكيد تبرعك لصالح المريض: ' . $this->donation->request->patient_name)
            ->line('شكراً لك على مساهمتك.')
            ->action('عرض التفاصيل', route('api.donations.show', ['id' => $this->donation->id]));
    }

    public function toArray($notifiable)
    {
        return [
            'type' => 'donation_confirmed',
            'donation_id' => $this->donation->id,
            'request_id' => $this->donation->request_id,
            'message' => 'تم تأكيد تبرعك للمريض ' . $this->donation->request->patient_name,
        ];
    }

    public function toFcm($notifiable)
    {
        return [
            'title' => 'تم تأكيد تبرعك',
            'body' => 'شكراً لك! تم تأكيد تبرعك بنجاح لصالح المريض ' . $this->donation->request->patient_name,
            'data' => [
                'donation_id' => (string) $this->donation->id,
                'type' => 'donation_confirmed'
            ]
        ];
    }
}