<?php
namespace App\Mail;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue; 
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

use Illuminate\Support\Facades\Log;

class OrderStatusUpdated extends Mailable
{
    use Queueable, SerializesModels;

    public Order $order;
    public string $newStatusText; 

    public function __construct(Order $order)
    {
        Log::info("Mailable OrderStatusUpdated: Constructor called for Order ID: {$order->id}. Customer Email: {$order->customer_email}. New Status: {$order->status_text}");

        $this->order = $order;
        $this->newStatusText = $order->status_text; 
    }

    public function envelope(): Envelope
    {
        $fromAddress = config('mail.from.address', 'error@example.com');
        $fromName = config('mail.from.name', config('app.name'));
        $subject = "Cập nhật trạng thái Đơn hàng #{$this->order->code}: {$this->newStatusText}";

        return new Envelope(
            from: new Address($fromAddress, $fromName),
            subject: $subject,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.orders.status_updated', 
        );
    }

    public function attachments(): array { return []; }
}