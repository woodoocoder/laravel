<?php

namespace App\Events\Like;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewLike implements ShouldBroadcast {

    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $userId;
    public $data;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($userId, $data) {
        $this->userId = $userId;
        $this->data = $data;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn() {
        return new PrivateChannel('likes.'.$this->userId);
    }

    public function broadcastAs() {
        return 'new-like';
    }

    public function broadcastWith() {
        return ['data' => $this->data];
    }
}
