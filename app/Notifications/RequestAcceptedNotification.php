<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use App\Channels\FcmChannel; // <--- استيراد القناة

class RequestAcceptedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $donorName;
    protected $bloodRequestId;
    protected $bloodType;

    public function __construct($donorName, $bloodRequestId, $bloodType)
    {
        $this->donorName = $donorName;
        $this->bloodRequestId = $bloodRequestId;
        $this->bloodType = $bloodType;
    }

    public function via(object $notifiable): array
    {
        return ['database', FcmChannel::class];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'تم العثور على متبرع!',
            'message' => "المتبرع ({$this->donorName}) قام بقبول طلبك لفصيلة دم ({$this->bloodType}).",
            'request_id' => $this->bloodRequestId,
            'type' => 'request_accepted',
            'icon' => 'heroicon-o-check-badge',
        ];
    }


    public function toFcm(object $notifiable): array
    {
        return [
            'title' => 'تم العثور على متبرع!',
            'body' => "المتبرع ({$this->donorName}) قام بقبول طلبك.",
            'data' => [
                'request_id' => (string) $this->bloodRequestId,
                'type' => 'request_accepted',
                'click_action' => 'FLUTTER_NOTIFICATION_CLICK'
            ]
        ];
    }
}