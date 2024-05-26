<?php

namespace App\Notifications;

use App\Models\Client;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class newNotify extends Notification
{
    use Queueable;
    protected $data;

    /**
     * Create a new notification instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
        // return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    // public function toMail(object $notifiable): MailMessage
    // {
    //     return (new MailMessage)
    //                 ->line('The introduction to the notification.')
    //                 ->action('Notification Action', url('/'))
    //                 ->line('Thank you for using our application!');
    // }

    public function toDatabase(object $notifiable)
    {
        if (isset($this->data['image'])) {
            return [
                'message' => $this->data['message'],
                'image' => $this->data['image'],
                'url' => $this->data['url'],
            ];
        } elseif (isset($this->data['url'])) {
            return [
                'message' => $this->data['message'],
                'url' => $this->data['url'],
            ];
        } else {
            return [
                'message' => $this->data['message'],
            ];
        }
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
