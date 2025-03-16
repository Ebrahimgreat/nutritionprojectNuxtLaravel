<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customFoods extends Model
{
    protected $fillable = ['name','defaultProtein','defaultQuantity','defaultFat','defaultCarbs','defaultCalories'];
    use HasFactory;
}
