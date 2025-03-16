<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class workoutDetail extends Model
{
    use HasFactory;
    protected $fillable = ['reps','weight','set','workout_id','volume','rpe','name'];
    public function workout():BelongsTo{
        return $this->belongsTo(Workout::class);

    }
    public function exercise():BelongsTo{
        return $this->belongsTo(Exercise::class);
    }
    //
}
