<?php

namespace App\Models;

use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class weightTracking extends Model
{
    use HasFactory;

    protected $fillable = ['tracked','date','weights_id','streak'];







public function weight():BelongsTo
{


    return($this->belongsTo(weight::class,'weights_id','id'));


}

public function calculatingStreak()
{



    $weightTracking=weightTracking::all()->where('tracked',1)->sortByDesc('date')->toArray();



    //constraints.:1. if the streak gets broken in the middle
    // date not tracked

    $datesArray=[];

    foreach($weightTracking as $weight){
        $datesArray[]=$weight['date'];

    }



    $streak=[];



    $totalStreak=0;
    $count=0;

       $newDate=$datesArray[0];
       $totalStreak=1;



       array_splice($datesArray,0,1);


    foreach($datesArray as $date){


        if(Carbon::parse($date)->diffinDays(Carbon::parse($newDate))==1.0)
        {



            $totalStreak=$totalStreak+1;

        }
        else{
           break;
        }

        $newDate=$date;






    }

    return $totalStreak;






}
public  function  trackWeightUpdate()
{
    $weight=Weight::all();
    $weightTracking=[];
    foreach($weight as $weight){
        WeightTracking::create([
            'weights_id'=>$weight->id,
            'date'=>$weight->date,
            'tracked'=>1
        ]);


    }
}






}
