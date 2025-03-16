<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Redis;


class expenditure extends Model
{
    protected $table = 'expenditures';
    protected $fillable = ['date', 'expenditure', 'user_profile_id'];

    use HasFactory;

    public function profileUser(): BelongsTo
    {
        return $this->belongsTo(UserProfile::class, 'user_profile_id');

    }


    public static function getLatestExpenditure()
    {
        $expenditure = expenditure::latest()->first();
        return $expenditure->number;

    }
    public function updateExpenditure()
    {
        $cumilativesum=0;
        $limit=20;
        $count=0;
        $number=0;
        $expenditure=Expenditure::all();
        foreach($expenditure as $index=> $expenditure){
            if($count<$limit){
                $cumilativesum+=$expenditure->expenditure;
            }
            else{
                $cumilativesum-=$expenditure[$index-$limit]->expenditure;

            }
            $count++;
        }
        $expenditure->expenditure=$number;
        $expenditure->save();


    }

}

