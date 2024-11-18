<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailable;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmailNotification extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $details;

    public function __construct($details)
    {
        $this->details = $details;
    }

    public function build()
    {
        return $this->subject($this->details['subject'])
                    ->view('emails.send-email-users')
                    ->with([
                        'details' => $this->details
                    ]);
    }
}

