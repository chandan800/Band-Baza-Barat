<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\User;

class InterestReceived extends Notification
{
    use Queueable;

    protected $sender; // this must match what you use inside

    public function __construct(User $sender)
    {
        $this->sender = $sender; // set the property correctly
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('New Interest Received')
                    ->greeting('Hello ' . $notifiable->first_name)
                    ->line($this->sender->first_name . ' has shown interest in your profile.') // use $this->sender
                    ->action('View Profile', url('/profile/' . $this->sender->user_id))
                    ->line('Thank you for using our platform!');
    }

    public function toArray($notifiable)
    {
        return [
            'sender_id' => $this->sender->user_id,
            'sender_name' => $this->sender->first_name,
        ];
    }
}
