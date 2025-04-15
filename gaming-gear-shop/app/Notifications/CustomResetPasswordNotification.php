<?php
namespace App\Notifications;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use App\Mail\PasswordResetMail; 
use Illuminate\Support\Facades\URL; 

class CustomResetPasswordNotification extends Notification 
{
    use Queueable;
    public string $token;

    public function __construct(string $token) { $this->token = $token; }
    public function via(object $notifiable): array { return ['mail']; }

  
    public function toMail(object $notifiable): PasswordResetMail 
    {
        $resetUrl = URL::route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ]);

        return (new PasswordResetMail($notifiable->name, $resetUrl)) 
                ->to($notifiable->getEmailForPasswordReset()); 
    }
}