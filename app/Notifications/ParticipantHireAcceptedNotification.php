<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ParticipantHireAcceptedNotification extends Notification
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
            ->subject('Participant accepted')
            ->greeting("Hello, $notifiable->first_name")
            ->line('Great news! '.$this->participant->first_name. ' '.$this->participant->last_name.' has accepted to join your project:'. $this->projectName)
            ->line('Schedule a zoom meeting.')
            ->action('Schedule Meeting', 'https://zoom.us/join');
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
