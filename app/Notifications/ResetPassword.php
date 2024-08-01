<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPassword extends Notification
{
    use Queueable;

    private string $fullname;
    public $token;

    /**
     * Create a new notification instance.
     */
    public function __construct(string $fullname, $token)
    {
        $this->fullname = $fullname;
        $this->token = $token;
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
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage())
            ->subject('Reset Password')
            ->line('Hello ' . $this->fullname)
            ->line('This email from the wave rh app to reset your password.')
            ->line(
                'If you did not request this password reset, please ignore this email.'
            )
            ->action(
                'Click on this link to reset password',
                url(
                    'http://localhost:8000' .
                        route(
                            'Auth.ResetPassword',
                            [
                                'token' => $this->token,
                                'email' => $notifiable->email,
                                'name' =>
                                    $notifiable->name .
                                    ' ' .
                                    $notifiable->lastName,
                            ],
                            false
                        )
                )
            )
            ->line('Thank you for using our application!');
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
