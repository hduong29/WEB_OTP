<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TwoFactorCode extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
    public function toMail(object $notifiable): MailMessage
{
    return (new MailMessage)
        ->subject('Thông báo')
        ->line('Mã OTP của bạn là: ' . $notifiable->code)
        ->action('Xác nhận qua đây', route('verify.index'))
        ->line('Cảm ơn bạn đã sử dụng ứng dụng của chúng tôi!');
}

}
