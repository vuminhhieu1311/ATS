<?php

namespace App\Notifications;

use App\Mail\SendNotificationMail;
use App\Models\Interview;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Notifications\Notification;

class AddInterviewSchedule extends Notification implements ShouldQueue
{
    use Queueable;

    protected Interview $interview;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Interview $interview)
    {
        $this->interview = $interview;
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
     * @return Mailable
     */
    public function toMail($notifiable)
    {
        return (new SendNotificationMail($this->interview->mail_title, $this->interview->mail_content))
            ->to(optional($this->interview->candidateJob->candidate->user)->email);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [];
    }
}
