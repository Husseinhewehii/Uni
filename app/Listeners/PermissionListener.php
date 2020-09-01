<?php

namespace App\Listeners;

use App\Events\PermissionEditedEvent;
use App\Http\Services\LogsService;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class PermissionListener
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
     * @param  object  $event
     * @return void
     */
    public function handleEditedPermission(PermissionEditedEvent $event)
    {
        $this->logsService->fillLog($event->objectId, $event->objectType, $event->message);
    }
}
