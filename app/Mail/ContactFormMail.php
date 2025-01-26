<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    public $details;

    /**
     * Create a new message instance.
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        $dateVariable = now();
        $formattedDate = \Carbon\Carbon::parse($dateVariable)->format('d-m-Y');
        return $this->subject('New Contact Form Submission - ' . $formattedDate)
                    ->view('emails.contact-form');
    }
}
