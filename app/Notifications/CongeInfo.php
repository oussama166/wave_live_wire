<?php

namespace App\Notifications;

use App\Models\Leaves;
use App\Models\LeaveStatus;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CongeInfo extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    private $leaves;
    private $typeTrans;

    public function __construct($typeTrans, $leaves, private $type)
    {
        $this->leaves = $leaves;
        $this->typeTrans = $typeTrans;

    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        \Log::info("Info from the email : ",[
            "leaves : " =>$this->leaves ,
            "typeTrans" => $this->typeTrans,
        ]);
        if ($this->type == "Pending") {
            $subject = 'Vacation Request: Pending Approval';
            $introduction = 'Your vacation request has been successfully submitted and is now pending approval.';
            $leavePeriod = 'Leave Period: ' . $this->leaves["start_at"] . ' to ' . $this->leaves["end_at"];
            $actionUrl = url('http://localhost:8000' . '/vacationRequest/list');
            $thankYouMessage = 'Thank you for using our application!';
            return (new MailMessage)
                ->subject($subject)
                ->line($introduction)
                ->line($leavePeriod)
                ->line('You will receive an email once your request is reviewed by the HR.')
                ->action('View Your Leave Requests', $actionUrl)
                ->line($thankYouMessage);
        }
        elseif ($this->type == "Approved") {
            $subject = 'Vacation Request: Your vacation was approved by the HR';
            $introduction = 'Your vacation request has been successfully approved by the HR.';
            $leavePeriod = 'Leave Period: ' . $this->leaves["start_at"] . ' to ' . $this->leaves["end_at"];
            $actionUrl = url('http://localhost:8000' . '/vacationRequest/list');
            $thankYouMessage = 'Thank you for using our application!';
            return (new MailMessage)
                ->subject($subject)
                ->line($introduction)
                ->line($leavePeriod)
                ->action('View Your Leave Requests', $actionUrl)
                ->line($thankYouMessage);
        }
        $subject = 'Vacation Request: Your vacation was rejected by the HR';
        $introduction = 'Your vacation request has been rejected  by the HR.';
        $leavePeriod = 'Leave Period: ' . $this->leaves["start_at"] . ' to ' . $this->leaves["end_at"];
        $actionUrl = url('http://localhost:8000' . '/vacationRequest/list');
        $thankYouMessage = 'Thank you for using our application!';
        return (new MailMessage)
            ->subject($subject)
            ->line($introduction)
            ->line($leavePeriod)
            ->action('View Your Leave Requests', $actionUrl)
            ->line($thankYouMessage);


    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {$statusMessage = '';

        if ($this->type == "Pending") {
            $statusMessage = 'Your vacation request is pending approval.';
        } elseif ($this->type == "Approved") {
            $statusMessage = 'Your vacation request has been approved.';
        } else {
            $statusMessage = 'Your vacation request has been rejected.';
        }

        return [
            'typeTrans' => $this->typeTrans,
            'status' => $this->type,
            'message' => $statusMessage,
            'leavePeriod' => $this->leaves["start_at"] . ' to ' . $this->leaves["end_at"],
            'userId' => $notifiable->id, // Assuming the notifiable is a user
            'leavesId' => $this->leaves["id"], // Assuming the leave has an ID
        ];
    }
}
