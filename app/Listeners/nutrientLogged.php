<?php

namespace App\Listeners;

use App\Events\nutritionLogged;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\nutritionTracking;

class nutrientLogged
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
    public function handle(nutritionLogged $event): void
    {
        $event=collect($event);
        $event=$event->toArray();




        nutritionTracking::create([
            'date'=>$event['nutrient']['date'],
            'tracked'=>1,
            'nutrientsId'=>$event['nutrient']['id'],
        ]);
        //
    }
}
