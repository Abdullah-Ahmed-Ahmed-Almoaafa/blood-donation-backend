<?php

namespace App\Channels;

use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;
use Kreait\Laravel\Firebase\Facades\Firebase;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification as FcmNotification;

class FcmChannel
{
    /**
     * إرسال الإشعار عبر Firebase Cloud Messaging.
     *
     * @param object $notifiable المستخدم الذي سيستقبل الإشعار
     * @param Notification $notification كائن الإشعار
     */
    public function send(object $notifiable, Notification $notification): void
    {
        if (!method_exists($notifiable, 'devices') || $notifiable->devices->isEmpty()) {
            return;
        }

        $tokens = $notifiable->devices()
        ->where('is_active', true)
        ->pluck('device_token')
        ->filter()
        ->unique()
        ->values()
        ->all();

        if (empty($tokens)) {
            return;
        }

        $fcmData = method_exists($notification, 'toFcm')
            ? $notification->toFcm($notifiable)
            : ['title' => 'إشعار جديد', 'body' => 'لديك إشعار جديد', 'data' => []];

        $message = CloudMessage::new()
            ->withNotification(FcmNotification::create($fcmData['title'], $fcmData['body']))
            ->withData($fcmData['data'] ?? []);

        try {
            $report = Firebase::messaging()->sendMulticast($message, $tokens);

            if ($report->hasFailures()) {
                foreach ($report->failures() as $failure) {
                    $failedToken = $failure->target()->value();
                    $error = $failure->error()->messages()[0] ?? 'Unknown error';

         if (str_contains($error, 'UNREGISTERED') || str_contains($error, 'INVALID')) {
             $notifiable->devices()->where('device_token', $failedToken)->update(['is_active' => false]);

                        Log::info("Deleted invalid FCM token: {$failedToken}");
                    }
                }
            }

        } catch (\Exception $e) {
            Log::error('FCM Channel Critical Error: ' . $e->getMessage(), [
                'user_id' => $notifiable->id ?? null,
                'tokens' => $tokens
            ]);
        }
    }
}