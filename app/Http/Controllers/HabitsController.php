<?php

namespace App\Http\Controllers;


use App\Models\Weight;
use App\Models\weightTracking;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use App\Models\Habits;
use App\Models\nutrients;
use App\Models\nutritionTracking;
use function Symfony\Component\String\s;


class HabitsController extends Controller
{
    public $dateHabits;
    public $information=[];
    public $newDates=[];
    public $dateIndex=0;
    public $streak;
    public function index()
    {

        $todayDate=Carbon::today();



        $weightTrackingInformation=weightTracking::where('tracked',1)->get();
        $weightTrackingDates=$weightTrackingInformation->pluck('date');
        $weightInformation=[];

        foreach($weightTrackingDates as $date){

            $scaleWeight=weightTracking::where('date',$date)->first()->weight()->first()->ScaleWeight;
            $trendWeight=weightTracking::where('date',$date)->first()->weight()->first()->trendWeight;
            $weightInformation[]=['date'=>$date,'scaleWeight'=>$scaleWeight,'trendWeight'=>$trendWeight];



        }









   return response()->json($weightInformation);
    }
    public function habitOfNutrition()
    {
        $todaysDate = Carbon::today()->format('Y-m-d');

        $trackedDays = nutritionTracking::all()->where('tracked', 1);
        $trackedDate=$trackedDays->pluck('date')->unique();



        $nutritionInformation=[];
        foreach($trackedDate as $date){
            $protein=nutritionTracking::where('date',$date)->first()->nutrition()->sum('protein');
            $carbs=nutritionTracking::where('date',$date)->first()->nutrition()->sum('carbs');
           $nutritionInformation[]=['date'=>$date,'protein'=>$protein,'carbs'=>$carbs];
        }






     return inertia::render('habits.nutrition',['date'=>$todaysDate,
         'nutritionInformation'=>$nutritionInformation
             ]);


}
public function weights(Request $request)
{

    $text='hello';




    $todaysDate=Carbon::today()->format('Y-m-d');

    $habitTracking=new weightTracking();
    $weightTrackingInformation=weightTracking::where('tracked',1)->pluck('date');
    $weightInformation=[];

    foreach($weightTrackingInformation as $date){
        $scaleWeight=weightTracking::where('date',$date)->first()->weight()->first()->ScaleWeight;
        $trendWeight=weightTracking::where('date',$date)->first()->weight()->first()->trendWeight;
        $weightInformation[]=['date'=>$date,'scaleWeight'=>$scaleWeight,'trendWeight'=>$trendWeight];

    }




    $url='/weight';



    return Inertia::render('habits.weight',[
        'weightInformation'=>$weightInformation,
        'date'=>$todaysDate,
    'url'=>$url]);
}

public function gettingrequest($variable,$type)
{
    if($type==1)
    {


        weightTracking::create([
            'date'=>$variable['date'],
            'tracked'=>1,
            'weights_id'=>$variable['id'],


        ]);


    }
    else if($type==2)
    {
        nutritionTracking::create([

            'date'=>$variable['date'],
            'tracked'=>1,
            'nutrientsId'=>$variable['id'],
        ]);
    }



}


    //
}
