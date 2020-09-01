<?php

namespace App\Events;

use App\Models\Permission;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class PermissionEditedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $permission;
    public $message;
    public $objectType;
    public $objectId;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Permission $permission)
    {

        $this->permission = $permission;
        $this->message = 'edited';
        if ($permission->wasChanged('status')) {
            $status = $permission->status ? 'Enabled' : 'Disabled';
            $this->message = 'changed_status_to_' . $status;
        }
        $this->objectType = get_class($permission);
        $this->objectId = $permission->id;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
