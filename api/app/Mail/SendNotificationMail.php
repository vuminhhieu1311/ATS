<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendNotificationMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected $mailSubject;
    protected $mailContent;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mailSubject, $mailContent)
    {
        $this->mailSubject = $mailSubject;
        $this->mailContent = $mailContent;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->mailSubject)
            ->html($this->mailContent);
    }
}
