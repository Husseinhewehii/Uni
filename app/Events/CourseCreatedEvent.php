<?php

namespace App\Events;

use App\Models\Course;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class CourseCreatedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public $course;
    public $message;
    public $objectType;
    public $objectId;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Course $course)
    {
        $this->course = $course;
        $this->message = 'created';
        $this->objectType = get_class($course);
        $this->objectId = $course->id;
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
