<?php

namespace App\Notifications;

use App\Models\BloodRequest;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Channels\FcmChannel;

class DonationRequestAccepted extends Notification implements ShouldQueue
{
    use Queueable;

    protected BloodRequest $bloodRequest;
    protected User $donor;

    public function __construct(BloodRequest $bloodRequest, User $donor)
    {
        $this->bloodRequest = $bloodRequest;
        $this->donor = $donor;
    }

    public function via($notifiable)
    {
        return ['database', 'mail', FcmChannel::class];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('تم قبول طلب التبرع')
            ->line('قام المتبرع ' . $this->donor->full_name . ' بقبول طلب التبرع الخاص بك.')
            ->line('المريض: ' . $this->bloodRequest->patient_name)
            ->line('فصيلة الدم: ' . $this->bloodRequest->blood_type)
            ->action('عرض الطلب', route('api.requests.show', ['id' => $this->bloodRequest->id]))
            ->line('شكراً لاستخدامك منصة التبرع بالدم.');
    }

    public function toArray($notifiable)
    {
        return [
            'type' => 'donation_request_accepted',
            'request_id' => $this->bloodRequest->id,
            'donor_id' => $this->donor->id,
            'donor_name' => $this->donor->full_name,
            'message' => 'قام ' . $this->donor->full_name . ' بقبول طلب التبرع الخاص بك.',
        ];
    }

    public function toFcm($notifiable)
    {
        return [
            'title' => 'متبرع جديد',
            'body' => 'قام ' . $this->donor->full_name . ' بقبول طلب التبرع الخاص بك.',
            'data' => [
                'request_id' => (string) $this->bloodRequest->id,
                'type' => 'donation_request_accepted'
            ]
        ];
    }
}