<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificationEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $details;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($message)
    {
        $this->details = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if ($this->details['typeEmail'] == 'assign') {
            return $this->subject('Pemberitahuan')
                ->view('components.emails.assignedAsUser');
        }
        else if($this->details['typeEmail'] == 'remove') {
            return $this->subject('Pemberitahuan')
                ->view('components.emails.removedAsUser');
        }
    }
}
