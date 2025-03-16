<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;



class nutrients extends Model
{
    protected $fillable=['time','Calories','Protein','Carbs','Fat','Fiber','Water','date','food_name','foods_id','goals_id','user_profile_id'
        ,'time'
    ,'quantity'];
    use HasFactory;
    public static function getLatestNutrients()
    {

        $latestDate = nutrients::orderBy('date', 'DESC')->first()->date;




        $latestNutrient=nutrients::all()->where('date',$latestDate);

        return $latestNutrient;



    }

    public function nutritionTracking()
    {
        return $this->hasMany(nutritionTracking::class,"nutrientsId");
    }

    public function foods():BelongsTo
    {
        return $this->belongsTo(foods::class,'foods_id','id');
    }

    public function weights()
    {
        return $this->belongsToMany(Weight::class);

    }
    public function profileGet():BelongsTo
    {
        return $this->belongsTo(Userprofile::class,'user_profile_id');
    }











}
