<?php

namespace App\Mail;

use App\Models\User;
use App\Notifications\RefundRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class RefundRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    public int $id;
    public User $user;
    public string $approveUrl;
    public string $denyUrl;

    /**
     * Create a new message instance.
     */
    public function __construct(int $refundid, User $user)
    {
        $this->id = $refundid;
        $this->user = $user;

        // Gera a URL de aprovação assinada e com validade de 24 horas
        $this->approveUrl = URL::temporarySignedRoute(
            'dashboard.refund.approve',
            now()->addHours(24),
            ['id' => $this->id]
        );

        // Gera a URL de recusa assinada e com validade de 24 horas
        $this->denyUrl = URL::temporarySignedRoute(
            'dashboard.refund.deny',
            now()->addHours(24),
            ['id' => $this->id]
        );
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address((string)config('mail.from.address'), (string)config('mail.from.name')),
            to: $this->user->email,
            subject: 'Foi solicitado um reembolso'
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.auth.refund-request',
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
