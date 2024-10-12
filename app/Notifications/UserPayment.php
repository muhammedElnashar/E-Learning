<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserPayment extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct($username ,$userImage,$courseTitle,$created_at)
    {
        $this->username = $username;
        $this->userImage = $userImage;
        $this->courseTitle = $courseTitle;
        $this->created_at = $created_at;

    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            "message" => "Congrats $this->username enroll in $this->courseTitle ",
            "userImage"=>  $this->userImage,
            "created_at" => $this->created_at,
            ];
    }
}
