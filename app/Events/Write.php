<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Write implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $write;
    public $write_contact;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($a,$b)
    {
        $this->write = $a;
        $this->write_contact = $b;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('write.'.$this->write);
    }

    public function broadcastWith(){
        return ['write' => $this->write_contact];
    }
}
