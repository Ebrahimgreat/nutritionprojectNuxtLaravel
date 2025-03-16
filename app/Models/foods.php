<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class foods extends Model
{
    protected $fillable = ['id','defaultQuantity', 'defaultProtein', 'defaultCarbs', 'defaultCalories', 'defaultFat','name'];
    use HasFactory;

    public function foods(): HasMany
    {
        return ($this->hasMany(nutrients::class, 'foods_id'));
    }


    public function calculateCalories($foodName,$quantity)


    {
        $foodSearch=foods::where('name', 'LIKE', $foodName)->first();
       $calories=$foodSearch['Calories']*$quantity/($foodSearch['quantity']);
       $carbs=$foodSearch['Carbs']*$quantity/($foodSearch['quantity']);
       $protein=$foodSearch['Protein']*$quantity/($foodSearch['quantity']);
       $fats=$foodSearch['Fat']*$quantity/($foodSearch['quantity']);
       $array=[$calories,$protein,$calories,$fats];

       return $array;





    }
    public function nutrients(): HasMany
    {
        return ($this->hasMany(nutrients::class, 'foods_id'));
    }
}
