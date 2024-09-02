<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PaymentSucess implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $checkout;
    /**
     * Create a new event instance.
     */
    public function __construct($checkout)
    {
        $this->checkout = $checkout;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */

     public function broadcastWith()
     {
         return ['checkoutId' => $this->checkout->id];
     }
     

    public function broadcastOn(): array
    {
        return [new Channel('payment')];
    }


    public function broadcastAs(){
        return 'sucess';
    }
}
