<?php
namespace App\Mail;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Support\Facades\Log; 
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue; 

class OrderPlaced extends Mailable 
{
    use Queueable, SerializesModels;

    public Order $order; // Dữ liệu đơn hàng

    public function __construct(Order $order)
    
    {
        Log::info("Mailable OrderPlaced: Constructor called for Order ID: {$order->id}. Customer Email: {$order->customer_email}.");


        $this->order = $order;
        $this->order->loadMissing(['user', 'orderDetails.product']);
    }

    public function envelope(): Envelope
    {
        // Đọc From từ config (lấy từ .env)
        $fromAddress = config('mail.from.address', 'error@example.com');
        $fromName = config('mail.from.name', config('app.name'));

        return new Envelope(
            from: new Address($fromAddress, $fromName),
            subject: 'Xác nhận Đơn hàng #' . $this->order->code . ' tại ' . config('Mega Mart'),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.orders.placed', 
        );
    }

    public function attachments(): array { return []; }
}