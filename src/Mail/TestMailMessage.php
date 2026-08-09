<?php

namespace Mca\Smtp\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TestMailMessage extends Mailable
{
    use Queueable, SerializesModels;

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: mca_smtp_t('mail.test_subject'),
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'mca-smtp::mail.test',
        );
    }
}
