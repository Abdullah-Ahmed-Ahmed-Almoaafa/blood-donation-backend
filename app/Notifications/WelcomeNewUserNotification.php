<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WelcomeNewUserNotification extends Notification
{
    use Queueable;

    protected $userName;

    public function __construct($userName)
    {
        $this->userName = $userName;
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('مرحباً بك في مجتمع متبرعي الدم 🩸')
            ->greeting('أهلاً يا ' . $this->userName . '!')
            ->line('شكرًا لانضمامك إلى تطبيقنا. أنت الآن جزء من شبكة تساهم في إنقاذ الأرواح.')
            ->action('ابدأ باستكشاف الطلبات القريبة', url('/'))
            ->line('إذا كان لديك أي استفسار، لا تتردد في مراسلتنا.')
            ->salutation('مع تحيات فريق إدارة "نظام تبرع الدم"');
    }
}