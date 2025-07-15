<?php

namespace App\Notifications;

use App\Mail\RefundRequestMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RefundRequest extends Notification implements ShouldQueue
{
    use Queueable;

    public $user;
    public int $refundId;

    /**
     * Create a new notification instance.
     */
    public function __construct($refundId, $user)
    {
        $this->user = $user;
        $this->refundId = $refundId;
        $this->onQueue('email');
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
    public function toMail(object $notifiable): RefundRequestMail
    {
        return new RefundRequestMail($this->refundId, $this->user);
    }

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
}
