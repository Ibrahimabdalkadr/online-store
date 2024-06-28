<?php

namespace App\Events;

use App\Models\Message;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SupportMessageSent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $user;
    public $message;

    public function __construct(User $user, Message $message)
    {
        $this->user = $user;
        $this->message = $message;
    }


    public function broadcastOn(): array
    {
//        if (userTypeIs($this->supportMessage->receiver, 'employee')) {
//
//            return [
//                new PrivateChannel('user.' . $this->supportMessage->receiver_id),
//                new PrivateChannel('user.' . $this->supportMessage->receiver->controlledAccount()->id),
//            ];
//        }
//        return [
//            new PrivateChannel('user.' . $this->supportMessage->receiver_id)
//        ];
        return [
            new PrivateChannel('chat'),
        ];
    }
}
