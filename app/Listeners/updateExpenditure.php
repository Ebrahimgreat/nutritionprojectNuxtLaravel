<?php

namespace App\Listeners;

use App\Events\weightLogged;
use App\Models\Weight;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use App\Models\expenditure;

class updateExpenditure
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
        $weight=Weight::latest()->first();
        if(!$weight){
            return;
        }
        $user=$weight->userProfile()->first();
        if(!$user){
            return;
        }

        $expenditure=expenditure::latest()->first();
        if(!$expenditure){
           $age=$user->age;
           $height=$user->height;
           $sex=$user->Sex;
           $activityLevel=$user->activityLevel;
           $tdee=0;
           if($sex=='male'){
               $tdee=(10*$weight->ScaleWeight)+(6.25*$height)-(5*$age)+5*$activityLevel;


           }
           else if($sex='female'){
               $tdee=(10*$weight)+(6.25*$height)-(5*$age)-161;
           }
           expenditure::create([
               'expenditure'=>$tdee,
               'date'=>$event['weight']['date'],
               'user_profile_id'=>$user->id
           ]);
        }
        $userProfile=$expenditure->profileUser()->latest()->first()->id;
        $latestExpenditure=$expenditure->expenditure;
        $counter=$expenditure->profileUser()->latest()->first()->weights()->count();
     $event=collect($event);

     $weight=$event->toArray();

    if($counter<=20){
        expenditure::create([
            'expenditure'=>$latestExpenditure,
            'date'=>$weight['weight']['date'],
            'user_profile_id'=>$userProfile,


        ]);
    }
    else{
        $latestTrendWeight=$expenditure->profileUser()->latest()->first()->weights()->latest()->orderBY('date','desc')->skip(1)->first()->trendWeight;
        $newLatestTrendWeight=$expenditure->profileUser()->latest()->first()->weights()->latest()->first()->trendWeight;

        $averageExpenditure=expenditure::all()->sortByDesc('date')->take(20)->avg('expenditure');
        $averageTrendWeight=$expenditure->profileUser()->latest()->first()->weights()->take(20)->avg('trendWeight');
        $difference=$latestTrendWeight-$newLatestTrendWeight;
        $surplusOrDeficit=($difference*7000)/20;
        if($surplusOrDeficit<0)
        {
            $latestExpenditure=$expenditure->expenditure-$surplusOrDeficit;

        }
        else{
            $latestExpenditure=$expenditure->expenditure;
        }



        expenditure::create([
            'expenditure'=>$latestExpenditure,
            'date'=>$weight['weight']['date'],
            'user_profile_id'=>$userProfile,
        ]);






    }

        //
    }
}
