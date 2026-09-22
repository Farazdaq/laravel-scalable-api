<?php

namespace App\Mail;

use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class VerifyEmailMail extends BaseMailable
{
    public string $verificationUrl;

    public string $userName;

    public function __construct(
        string $verificationUrl,
        string $userName
    ) {
        $this->verificationUrl = $verificationUrl;
        $this->userName = $userName;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Verify your email address'
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.verification'
        );
    }

    public function attachments(): array
    {
        return [];
    }
}