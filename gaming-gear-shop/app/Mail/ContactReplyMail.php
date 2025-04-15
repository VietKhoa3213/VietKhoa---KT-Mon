<?php
namespace App\Mail;
use App\Models\Contact; // <<< Import Contact
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class ContactReplyMail extends Mailable 
{
    use Queueable, SerializesModels;

    public Contact $originalContact; 
    public string $replySubject;    
    public string $replyMessage;     

    public function __construct(Contact $originalContact, string $replySubject, string $replyMessage)
    {
        $this->originalContact = $originalContact;
        $this->replySubject = $replySubject;
        $this->replyMessage = $replyMessage;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address(config('mail.from.address'), config('mail.from.name')),
            replyTo: [ new Address($this->originalContact->email, $this->originalContact->name) ],
            subject: $this->replySubject, 
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.contact.reply', 
            with: [
                'originalSubject' => $this->originalContact->subject,
                'originalMessage' => $this->originalContact->message,
                'replyMessageContent' => $this->replyMessage, 
            ],
        );
    }
    public function attachments(): array { return []; }
}