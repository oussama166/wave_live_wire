<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserCreated extends Notification
{
    use Queueable;

    public $user;
    /**
     * Create a new notification instance.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        // the subject of the email is notifing the user that the account is ready to use into our application and give him the email and password
        $subject = 'Account Created';
        $introduction = 'Your account has been successfully created and is now ready to use.';
        $email = 'Email: ' . $this->user->email ;
        $password = 'Password: password12345';
        $actionUrl = url('http://localhost:8000' .'/');
        $thankYouMessage = 'Thank you for using our application!';
        return (new MailMessage)
            ->subject($subject)
            ->line($introduction)
            ->line($email)
            ->line($password)
            ->line('You can now login to your account and start using our application.')
            ->action('Login', $actionUrl)
            ->line($thankYouMessage);

    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
