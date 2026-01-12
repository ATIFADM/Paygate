<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Invoice;

class InvoiceCreated extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $invoice;
    public $senderUser;

    public function __construct(Invoice $invoice, $senderUser = null)
    {
        $this->invoice = $invoice;
        $this->senderUser = $senderUser;
    }

    public function envelope(): Envelope
    {
        $fromEmail = $this->senderUser ? $this->senderUser->email : config('mail.from.address');
        $fromName = $this->senderUser ? $this->senderUser->name : config('mail.from.name');

        return new Envelope(
            from: new \Illuminate\Mail\Mailables\Address($fromEmail, $fromName),
            replyTo: [
                new \Illuminate\Mail\Mailables\Address($fromEmail, $fromName),
            ],
            subject: 'New Invoice - ' . $this->invoice->invoice_number,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.invoice_new',
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
