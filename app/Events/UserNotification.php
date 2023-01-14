<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserNotification implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $cred;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($cred)
    {
        $this->cred=$cred;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        // if authenticated
        // return new PrivateChannel('channel-name');
        // public
        return new Channel('popup-channel');
    }

    /**
     * Broadcast event User
     * @return void
     */
    public function broadcastAs()
    {
        return 'user-notify';
    }
}
