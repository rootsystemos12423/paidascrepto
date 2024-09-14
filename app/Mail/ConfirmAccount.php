<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ConfirmAccount extends Mailable
{
    use Queueable, SerializesModels;

    public $token;
    public $cod;
    public $name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($token, $cod, $name)
    {
        $this->token = $token;
        $this->cod = $cod;
        $this->name = $name;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'CONFIRMAÇÃO DE CONTA - OSORNO CRYPTO',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        // Pass the data to the view using the 'with' method
        return new Content(
            markdown: 'mails.auth.confirmation-account',
            with: [
                'token' => $this->token,
                'cod' => $this->cod,
                'name' => $this->name,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
