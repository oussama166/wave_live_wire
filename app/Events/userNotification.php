<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class userNotification implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $userId;
    public $message;

    /**
     * Create a new event instance.
     */
    public function __construct($userId, $message)
    {
        $this->userId = $userId;
        $this->message = $message;
        Log::alert('message', ['id' => $userId, 'message' => $message]);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        Log::alert('id', ['userId' => $this->userId]);
        Log::alert('message', ['userId' => $this->message]);
        return [new Channel('App.Models.User.' . $this->userId)];
    }
}
