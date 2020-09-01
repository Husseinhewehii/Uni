<?php

namespace App\Listeners;

use App\Events\CourseCreatedEvent;
use App\Events\CourseDeletedEvent;
use App\Http\Services\LogsService;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CourseListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */

    private $logsService;

    public function __construct(LogsService $logsService)
    {
        $this->logsService = $logsService;
    }

    /**
     * Handle the event.
     *
     * @param  CourseDeletedEvent  $event
     * @return void
     */
    public function handleDeletedCourse(CourseDeletedEvent $event)
    {
        $this->logsService->fillLog($event->objectId, $event->objectType, $event->message);
    }

    public function handleCreatedCourse(CourseCreatedEvent $event)
    {
        $this->logsService->fillLog($event->objectId, $event->objectType, $event->message);
    }
}
