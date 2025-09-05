<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\User;

class ShortlistReceived extends Notification
{
    use Queueable;

    public $fromUser;

    /**
     * Create a new notification instance.
     */
    public function __construct(User $fromUser)
    {
        $this->fromUser = $fromUser;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('You have been added to a shortlist!')
            ->greeting('Hello ' . $notifiable->first_name . ',')
            ->line($this->fromUser->first_name . ' ' . substr($this->fromUser->last_name,0,1) . ' has added you to their shortlist.')
            ->action('View Profile', url('/profile/' . $this->fromUser->user_id))
            ->line('Thank you for using our application!');
    }

    /**
     * Store notification in the database.
     */
    public function toArray(object $notifiable): array
    {
        return [
            'from_user_id' => $this->fromUser->user_id,
            'from_user_name' => $this->fromUser->first_name . ' ' . substr($this->fromUser->last_name,0,1) . '.',
            'message' => $this->fromUser->first_name . ' added you to their shortlist.'
        ];
    }
}
