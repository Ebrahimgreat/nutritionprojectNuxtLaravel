<?php

namespace App\Listeners;

use App\Events\weightLogged;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\WeightTracking;

class weightListen
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
    public function handle(weightLogged $event): void
    {
        $event=collect($event);
        $event=$event->toArray();
        WeightTracking::create([
            'date'=>$event['weight']['date'],
            'tracked'=>1,
            'weights_id'=>$event['weight']['id'],
        ]);



        //
    }
}
