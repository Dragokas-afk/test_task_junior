<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\Notification;

class UsersNotifications extends Notification
{
    use Queueable;
    use Notifiable;

    public function __construct($message)
    {
        $this->message = $message;
    }

    public function via(object $notifiable): array
    {
        return ['database', 'mail'];
    }
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line($this->message);
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'message' => $this->message,
        ];
    }
}
