<?php

namespace App\Listeners;

use App\Events\BenachrichtigungEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class BenachrichtigungListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  BenachrichtigungEvent  $event
     * @return void
     */
    public function handle(BenachrichtigungEvent $event)
    {
        print_r($event);
    }
}
