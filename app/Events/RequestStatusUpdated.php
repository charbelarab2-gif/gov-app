<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RequestStatusUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function broadcastOn(): array
    {
        return [
            new Channel('requests.' . $this->request->id),
        ];
    }

    public function broadcastWith(): array
    {
        return [
            'status' => $this->request->status,
            'id'     => $this->request->id,
        ];
    }
}