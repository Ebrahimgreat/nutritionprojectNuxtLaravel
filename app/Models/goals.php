<?php

namespace App\Models;

use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Date;
use mysql_xdevapi\TableUpdate;
use function Laravel\Prompts\select;

class goals extends Model
{
    protected $table = 'goals';
    protected $fillable = ['targetCalories','CheckDay','goalRate','goalWeight','name','GoalStarted','user_profile_id','approach'

    ,'goalStatus'];
    use HasFactory;

public function nutrients():HasMany
{
    return($this->hasMany(nutrients::class,'goal_id','id'));

}
    public static function getLatestGoals(){
        $goals=goals::all()->sortByDesc('created_at')->take(1);
        return $goals;
    }


    public function weights():HasMany
    {
        return $this->hasMany(Weight::class,'goal_id','id');
    }

    public function users():BelongsTo
    {
        return $this->belongsTo(UserProfile::class,'user_profile_id','id');
    }

    public function getLatestTrendWeight()
    {
        $goals=goals::find(14);
       dd($goals->weights()->first()['ScaleWeight']);


    }


    public function checkIns():HasMany
    {
        return $this->hasMany(CheckIn::class,'goal_id','id');
    }


    public function getLatestGoal()
    {
        $goal=goals::all()->sortByDesc('created_at')->first();
        return $goal;

    }

    public function getDayofTheWeek($day)
    {
        if($day=='Sunday')
        {
            return 0;
        }
        else if($day=='Monday')
        {
            return 1;
        }
        else if($day=='Tuesday')
        {
            return 2;
        }
        else if($day=='Wednesday')
        {
            return 3;
        }
        else if($day=='Thursday'){
            return 4;
        }
        else if($day=='Friday'){
            return 5;
        }
        else if($day=='Saturday'){
            return 6;
        }

    }


public function getNextCheckDay($id)
{

    $day=goals::find($id)->checkIns()->latest()->first()->checkDay;


     $date=goals::find($id)->checkIns()->latest()->first()->date;

     $dateLoggedValue=Carbon::parse($date)->format('w');



    $nextDay = Carbon::now()->next($day)->format('Y-m-d');


    return $nextDay;



}

    public function calculateTargetCalories($id)
    {
        $goal=goals::find($id);
        $expenditure=$goal->users()->latest()->first()->getexpenditure()->latest()->first()->number;



        $targetCalories=($expenditure+(($goal->goalRate*7000)/7));
        //Around 100 calorie surplus

      return $targetCalories;
    }

    public function getNewTargetCalories($expenditure)
    {
        $goals=goals::latest()->first();

        $targetCalories=($expenditure+(($goals->goalRate*7000)/7));
        return $targetCalories;

    }

    public function calculatingCompliance($id)
    {
        $goals=goals::find($id);
        $goals=goals::latest()->first();
        $caloriesArray=[];
        $checkinDate=$goals->checkIns()->latest()->first()->date;
        $checkinDate=Carbon::parse($checkinDate);


        $checkinDay=Carbon::parse($checkinDate)->format('w');

        $checkDayDate=$goals->checkIns()->latest()->first()->checkDay;
        $nextCheckDay=Carbon::now()->next($checkDayDate)->format('Y-m-d');

        $difference=abs(Carbon::parse($nextCheckDay)->diffInDays($checkinDate));
       $datesArray=[];
       for($i=0;$i<=$difference;$i++){
           $datesArray[]=$checkinDate->copy()->addDays($i)->format('Y-m-d');


       }


$nutrients=[];

       foreach($datesArray as $date){
           $nutrients[]=["date"=>$date,"Calories"=>$goals->users()->latest()->first()->nutrients()->where('date',$date)->sum('Calories')
           ,'Protein'=>$goals->users()->latest()->first()->nutrients()->where('date',$date)->sum('Protein'),
               'Carbs'=>$goals->users()->latest()->first()->nutrients()->where('date',$date)->sum('Carbs'),
               'Fats'=>$goals->users()->latest()->first()->nutrients()->where('date',$date)->sum('Fats')];


       }


       $complianceCollection=collect($nutrients)->where('Calories', '>', 0)->count();

       $caloriesAverage=collect($nutrients)->where('Calories', '>', 0)->avg('Calories');
       $proteinAverage=collect($nutrients)->where('Calories', '>', 0)->avg('Protein');
       $carbsAverage=collect($nutrients)->where('Calories', '>', 0)->avg('Carbs');
       $fatsAverage=collect($nutrients)->where('Calories', '>', 0)->avg('Fats');


      $compliantPercentage=($complianceCollection/count($datesArray))*100;


      $weekCompl=0;
      $targetCalories=$goals->checkIns()->latest()->first()->targetCalories;
      $minTargetCalories=$targetCalories-(0.05)*$targetCalories;
      $maxTargetCalories=$targetCalories+(0.05)*($targetCalories);

      if($targetCalories>=$minTargetCalories && $targetCalories<$maxTargetCalories){
          $calCompliance=1;
      }
      else{
          $calCompliance=0;
      }
      if($compliantPercentage>0.70*100)
      {
          $weekCompl=1;

      }
      else{
          $weekCompl=0;
      }


        $weekCompliance[]=["calorieAverage"=>$caloriesAverage,
            'proteinAverage'=>$proteinAverage,'fatsAverage'=>$fatsAverage,'carbsAverage'=>$carbsAverage,"compliantPercentage"=>$compliantPercentage,"calorieCompliance"=>$calCompliance,"WeekCompliance"=>$weekCompl];




        return $weekCompliance;



















    }



    public function calculatenewtargetCalories($id)
    {
        $goals=goals::find($id);
        $targetMacros=[];


        $goalRate=$goals->goalRate;
        $checkDate=$goals->checkins()->latest()->first()->date;
        $checkDay=$goals->checkins()->latest()->first()->checkDay;

        $nextDay=Carbon::parse($checkDate)->next($checkDay);


        $difference=abs(Carbon::parse($nextDay)->diffInDays($checkDate));


        $datesArray=[];
        for($i=0; $i<=$difference;$i++){
            $datesArray[]=Carbon::parse($checkDate)->addDays($i)->format('Y-m-d');
        }


        $weights=[];


          $trendWeightBefore=$goals->users()->latest()->first()->weights()->where('date',Carbon::parse($checkDate)->format('Y-m-d'))->pluck('trendWeight');


          $trendWeightAfter=$goals->users()->latest()->first()->weights()->where('date',Carbon::parse($checkDate)->addDays($difference)->format('Y-m-d'))->pluck('trendWeight');

          $differenceInTrendWeight=$trendWeightAfter[0]-$trendWeightBefore[0];



      $latestExpenditure=$goals->users()->latest()->first()->getExpenditure()->latest()->first()->number;

      $newTargetCalories=0;

      $sD=($differenceInTrendWeight*7000)/$difference;
      $sD=$sD/(count($datesArray));




      if($sD<0)
      {
          $newTargetCalories=$latestExpenditure+$sD;

      }
      else{
          $newTargetCalories=$latestExpenditure-$sD;
      }

      $calories=$goals->getNewTargetCalories($newTargetCalories);

      $targetProtein=0;
      $targetCarbs=0;
      $targetFats=0;

     if($goals->approach=='High Carb')
     {
         $targetCarbs=((0.65)*$calories)/4;
         $targetProtein=((0.20)*$calories)/4;
         $targetFat=((0.15)*$calories)/9;


     }
     $targetMacros=["calories"=>$calories,'Fats'=>$targetFats,'Protein'=>$targetProtein,'Carbs'=>$targetCarbs];

     return $targetMacros;


    }







}
