<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;


class BenachrichtigungEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
//    public $notficationData ;
//    public $notificationsCount;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
//        $this->notficationData="";
//        $this->notificationsCount='';
//        $notification = $user->notifications()->latest()->first();
//        if($notification){
//            $this->notficationData= $notification['data'];
//            $this->notificationsCount = $user->notifications()->count();
//        }

    }

    public function broadcastOn()
    {
        return new Channel('navigation');
    }

    public function broadcastWith()
    {
        $notification = $this->user->notifications()->latest()->first();
        $notification_data = $notification['data'];
        $notifications_count =  $this->user->notifications()->count();

        return [
            'data' => $notification_data,
            'notifications_count' => $notifications_count
        ];
    }

}
