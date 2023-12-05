<?php

namespace App\Listeners;

use App\Events\AlertsEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\Models\Alerts;

class SendAlertsNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(AlertsEvent $event): void
    {
        broadcast(new AlertsEvent($event->message))->toOthers();
       
    }
}



