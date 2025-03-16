<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Habits extends Model
{
    protected $fillable=['date','Tracked','UnTracked'];
    use HasFactory;

    public function nutritionHabit():HasMany
    {

        return $this->hasMany('habits_of_nutrition');
    }
    public function weightHabit():HasMany
    {

        return $this->hasMany('habits_of_weight');
    }




}


