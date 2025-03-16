<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class checkIn extends Model
{
    protected $table = 'check_in';
    use HasFactory;
    protected $fillable = ['checkDay','targetCalories','goal_id','date','complianceDays','complianceCalories','actualCheckInDate'
    ,'targetCarbs','targetFats','targetProtein'];

    public function goals():BelongsTo
    {
        return $this->belongsTo(goals::class, 'goal_id');
    }

    public function getTargetCalories($goalid)
    {
        $checkin=checkIn::where('goal_id','=',$goalid)->latest()->first();






        $checkin=checkIn::latest()->first()->id;
        $goalRate=checkin::latest()->first()->goals()->latest()->first()->goalRate;
       $expenditure=checkIn::latest()->first()->goals()->latest()->first()->users->latest()->first()->expenditure;
       $targetCalories=$expenditure+(($goalRate*3500)/7);
       return $targetCalories;




    }



    public function calculatingCompliance()
    {

        $checkin=checkIn::latest()->first();
        $checkDayDate=$checkin->checkDay;
        $goalid=$checkin->goal_id;
        $nextCheckDay=checkin::latest()->first()->goals()->latest()->first()->getNextCheckDay($goalid);
        $trackedDays=0;

        $found=false;
        $targetCalories=$checkin->targetCalories;
        $date=$checkin->date;


        $difference=Carbon::parse($date)->diffInDays($nextCheckDay);

        $totalCompliance=[];







         for($i=0;$i<$difference;$i++)
         {
             $checkDayDateArray[]=Carbon::parse($date)->addDays($i)->format('Y-m-d');

         }

        $updatedRecords=checkIn::latest()->first()->goals()->latest()->first()->users->latest()->first()->nutrients()->orderBY('date','Desc')->whereBetween('date',[$date,$checkDayDate[$difference-1]])->get()->toArray();

        $averageCalories=0;

        foreach($updatedRecords as $updatedRecord)
        {
          $averageCalories+=$updatedRecord['Calories'];
        }


        $trackedDays = count($updatedRecords);








        $compliance[]=["calories"=>$averageCalories,'daysTracked'=>$trackedDays];


        return $compliance;






    }




}
