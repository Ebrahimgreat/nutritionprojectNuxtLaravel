<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class workout extends Model
{
    use HasFactory;
    protected $fillable = ['date','user_profile_id'];
    public function workoutDetail():HasMany
    {
        return $this->hasMany(workoutDetail::class);
    }
    public function userProfile():BelongsTo
    {
        return($this->belongsTo(UserProfile::class,'user_profile_id'));

    }

    //
}
