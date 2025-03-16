<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;



class Weight extends Model
{
    use HasFactory, Notifiable;

    public $totalWeight;
    public $averageWeight;
    public $weight;
    public $dates = [];
    public $streak;

    protected $fillable = ['ScaleWeight', 'date', 'trendWeight', 'user_profile_id'];


    public function getHighestWeight()
    {
        $maximumWeight = DB::table('weights')->max('ScaleWeight');
        return $maximumWeight;


    }

    public static function getLatestWeight()
    {
        $latestWeight = Weight::orderBy('id', 'desc')->limit(1)->first();
        if ($latestWeight != null) {
            return $latestWeight->toarray();
        }
    }

    public function resetTrendWeight()
    {
        $weights = Weight::all();
        foreach ($weights as $weight) {
            $weight['trendWeight'] = 0;
            $weight->save();

        }
    }

    public function calculateSevenDayAverage()
    {
        $weight = Weight::orderBy('date', 'Desc')->take(7)->get();
        $average = collect($weight)->avg('ScaleWeight');
        return $average;

    }


    public function getTrendWeight()
    {

        $weight = Weight::all()->sortBY('date');


        if ($weight->count() < 20) {
            $average = collect($weight)->avg('ScaleWeight');
            return $average;


        } else {


            $weight = Weight::all()->sortByDesc('date')->take(20);
            $average = collect($weight)->avg('ScaleWeight');
            return $average;

        }


    }

public function updateScale()
{
    $weights=Weight::all()->unique('date');
    foreach ($weights as $weight) {
        $weight->create([
            'ScaleWeight' => $weight->ScaleWeight,
            'date'=>$weight->date,
            'user_profile_id'=>$weight->user_profile_id,
        ]);


    }


}

    public function userProfile(): BelongsTo

    {
        return $this->belongsTo(UserProfile::class, 'user_profile_id', 'id');

    }


    public function updateTrendWeight()
    {
        $count = 0;
        $limit = 20;

        $trendWeight=0;
        $weights = Weight::all();
        $cumilativeSum = 0;
        foreach ($weights as $index => $weight) {
            if ($count < $limit) {
                $cumilativeSum += $weight->ScaleWeight;
                $trendWeight = $cumilativeSum / ($count + 1);


            } else {
                $cumilativeSum -= $weights[$index - $limit]->ScaleWeight;
                $trendWeight = $cumilativeSum / $limit;


            }


            $weight->trendWeight = $trendWeight;
            $weight->save();
            $count++;
        }
        return "Weights updated successfully";




}










    public function weightTracking():HasMany
    {
        return $this->hasMany(WeightTracking::class,'weights_id');
    }

    public function nutrients()
    {
        return $this->belongsToMany(nutrients::class);
    }
    public function via($notfiable)
    {
        return('new record created');
    }


































}


