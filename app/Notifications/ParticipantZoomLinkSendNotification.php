<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ParticipantZoomLinkSendNotification extends Notification
{
    use Queueable;
    public $project_name;
    public $meeting_id;
    public $passcode;
    public $schedule_date;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($project_name, $meeting_id, $passcode, $schedule_date)
    {
        $this->project_name = $project_name;
        $this->meeting_id = $meeting_id;
        $this->passcode = $passcode;
        $this->schedule_date = $schedule_date;
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
            ->subject('Project Zoom Meeting')
            ->greeting("Hello, $notifiable->first_name")
            ->line("You are invited to a Zoom meeting for the project: $this->project_name.")
            ->line("Meeting ID: $this->meeting_id")
            ->line("Passcode: $this->passcode")
            ->line("Scheduled Date: $this->schedule_date")
            ->action('Join Meeting', 'https://zoom.us/join');
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
