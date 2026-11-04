<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class PasswordResetLink extends Mailable
{
    public function __construct(
        public string $url,
        public string $fromAddress,
        public string $fromName,
    ) {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address($this->fromAddress, $this->fromName),
            subject: __('reset_password').' : '.$this->fromName,
        );
    }

    public function content(): Content
    {
        return new Content(view: 'emails.password-reset');
    }
}
