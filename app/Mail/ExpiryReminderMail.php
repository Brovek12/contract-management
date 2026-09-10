<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ExpiryReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $item;

    public function __construct($item)
    {
        $this->item = $item;
    }

    public function build()
    {
        return $this->subject('Alat Kesehatan Mendekati Kadaluarsa')
                    ->view('emails.expiry_reminder');
    }
}
