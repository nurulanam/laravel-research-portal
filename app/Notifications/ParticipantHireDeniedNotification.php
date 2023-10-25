<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ParticipantHireDeniedNotification extends Notification
{
    use Queueable;

    public $projectName;
    public $participant;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($projectName, $participant)
    {
        $this->projectName = $projectName;
        $this->participant = $participant;
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
            ->subject('Participant Denied')
            ->greeting("Hello, $notifiable->first_name")
            ->line('Sorry! '.$this->participant->first_name. ' '.$this->participant->last_name.' has denied to join your project:'. $this->projectName)
            ->line('Want to chat with other participants?')
            ->action('Click Here', url('/dashboard/messages'));
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
