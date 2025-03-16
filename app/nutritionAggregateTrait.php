<?php

namespace App;
use App\Models\nutrients;

trait nutrientstrait
{
    public function aggregatingNutrients()
    {
        $nutrients=nutrients::all()->groupBy('date');
        $nutrients=($nutrients->toArray());



        foreach($nutrients as $nutrient){
            $protein=0;
            $carbs=0;
            $calories=0;
            $fat=0;
            $goals=0;

            $newNutrient=new nutrients();
            foreach($nutrient as $nutrientItem){


                $protein=round($protein+$nutrientItem['Protein'],2);
                $carbs= round($carbs+$nutrientItem['Carbs'],2);
                $fat=round($fat+$nutrientItem['Fat'],2);
                $calories=round($calories+$nutrientItem['Calories'],2);
                $date=($nutrientItem['date']);
                $nutrientFind=nutrients::find($nutrientItem['id']);

                if($nutrientFind->profileGet()->latest()->first()->goals()->latest()->first()!=null) {
                    $targetCalories = $nutrientFind->profileGet()->latest()->first()->goals()->latest()->first()->checkIns()->first()->targetCalories;
                }

            }

            $this->newNutrients[]=['Protein'=>$protein,'Fat'=>$fat,'Carbs'=>$carbs,'Calories'=>$calories,'date'=>$date,'targetCalories'=>$targetCalories];

        }







    }




    //
}
class nutritionAggregateTrait{
    use nutrientstrait;
}
?>
