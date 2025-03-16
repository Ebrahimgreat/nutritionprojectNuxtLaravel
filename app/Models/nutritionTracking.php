<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class nutritionTracking extends Model
{
    use HasFactory;
    protected $table = "nutrition_tracking";

    protected $fillable = ['date','nutrientsId','tracked','streak'
    ];

    public function nutrition()
    {
        return($this->belongsTo(nutrients::class,'nutrientsId'));
    }





}
