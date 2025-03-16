<?php

namespace App\Listeners;

use App\Events\newWorkout;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\WorkoutDetail;

class updateWorkoutDetails
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
    public function handle(newWorkout $event)
    {
       
        

        $workout=$event->workout;
        $workoutId=$event->id;
        foreach($workout as $newWorkout)
        {
            WorkoutDetail::create([
                'name'=>$newWorkout['name'],
                'reps'=>$newWorkout['reps'],
                'weight'=>$newWorkout['weight'],
                'set'=>$newWorkout['set'],
                'workout_id'=>$workoutId,
                'set'=>$newWorkout['set'],
                'rpe'=>$newWorkout['rpe']
            ]);
    

        }
       
        //
    }
}
