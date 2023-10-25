<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ParticipantRejectedNotification extends Notification
{
    use Queueable;
    public $projectName;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($projectName)
    {
        $this->projectName = $projectName;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Project rejection')
            ->greeting("Hello, $notifiable->first_name")
            ->line('Your submission on '.$this->projectName.' has been rejected. To join a new project:')
            ->action('Click Here', url('/dashboard'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
