<?php

namespace App\Http\Controllers;


use App\Events\nutritionLogged;
use App\Models\foods;
use App\Models\Habits;
use App\models\nutrients;
use App\Models\User;
use App\Models\UserProfile;
use App\nutritionAggregateTrait;
use Carbon\Carbon;
use DateTime;
use http\Header;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

use App\Models\customFoods;
use Laravel\Sanctum\Sanctum;
use mysql_xdevapi\Session;
use PhpParser\Node\Expr\Cast\Object_;
use function Pest\Laravel\withMiddleware;
use function React\Promise\all;
use function Sodium\add;

use Illuminate\Support\Facades\Route;

class nutritionController extends Controller
{
    public $newNutrients = [];






    public function index()
    {
       

           
        $nutrients=Nutrients::selectRaw('date,sum(Calories) as Calories,sum(Protein) as Protein,sum(Carbs) as Carbs')->groupBy('date')->paginate(10);
           
        return response()->json($nutrients);

    }










    public function store(Request $request)


    {
        $user=auth('sanctum')->user();
        $userId=$user->profile()->first()->id;
    
        
        


        
    

        try {

            if ($request->foodName!=null) {
                $descriptionArray = explode("|", $request['description']);
                $description1 = explode("-", $descriptionArray[0]);


                $foods_id = $request['food_id'];

                $defaultCarbs = (float)filter_var($descriptionArray[2], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                $defaultProtein = (float)filter_var($descriptionArray[3], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                $defaultFat = (float)filter_var($descriptionArray[1], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                $defaultQuantity = (float)filter_var($description1[0], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                $defaultCalories = (float)filter_var($description1[1], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                $quantity=$request['quantity'];


                $Calories = ($defaultCalories * $quantity) / $defaultQuantity;
                $Protein = ($defaultProtein * $quantity) / $defaultQuantity;
                $Fats = ($defaultFat * $quantity) / $defaultQuantity;
                $carbs = ($defaultCarbs * $quantity) / $defaultQuantity;
                $date = Carbon::today()->format('Y-m-d');

                $newNutrient = nutrients::create([
                    'quantity' => $quantity,
                    'Calories' => (float)$Calories,
                    'Fat' => (float)$Fats,
                    'Protein' => (float)$Protein,
                    'Carbs' => (float)$carbs,
                    'date' => $date,
                    'food_name' => $request['foodName'],
                    'user_profile_id' => 1

                ]);
                event(new nutritionLogged($newNutrient));


               
            }
            else{                //Storing Manual Food
                $newNutrient=nutrients::create([
                    'date'=>$request->date,
                    'Calories'=>$request->calories,
                    'Protein'=>$request->protein,
                    'Carbs'=>$request->carbs,
                    'Fat'=>$request->fat,
                    'date'=>$request->date,
                    'user_profile_id'=>$userId
                ]);
            
             
            }
            $nutrientDate=Nutrients::where('date',$newNutrient->date)->get();
            if($nutrientDate!=null){
                $newNutrient=Nutrients::selectRaw('date,sum(Calories) as Calories,sum(Protein) as Protein',)->where('date',$newNutrient->date)->get();

                

            }
         

            
            return response()->json($newNutrient->first());
        }
    catch (\Exception $e) {
            return response()->json($e);
        }
    }


    public function show(Request $request)
    {
        $date=$request->query('date');



        $allnutrients=nutrients::where('date', $date)->get();


        foreach ($allnutrients as $nutrient) {
            $nutrient['Calories']=round($nutrient['Calories']);
            $nutrient['Protein']=round($nutrient['Protein']);
            $nutrient['Carbs']=round($nutrient['Carbs']);
            $nutrient['Protein']=round($nutrient['Protein']);
            $nutrient['Fat']=round($nutrient['Fat']);
            if($nutrient['time']<10){
                $nutrient['time']="0".$nutrient['time'];
            }


        }


        return  response()->json($allnutrients,200);




    }





    public function destroy()
    {
       $id=request()->input('id');





       foreach($id as $index=>$nutrient)
       {
           nutrients::find($nutrient)->delete();
       }

        return to_route('nutrition')->with('message', 'Record Deleted Successfully');


    }



   public function storeCustomFood(Request $request)
    {

        $protein=$request->protein;
        $carbs=$request->carbs;
        $fats=$request->fats;
        $foodName=$request->foodName;
        $calories=$request->calories;
        $quantity=$request->quantity;


        $newFood = customFoods::create([
            'name' => $foodName,
            'defaultCalories' => $calories,
            'defaultProtein' => $protein,
            'defaultQuantity' =>$quantity,
            'defaultFat' => $fats,
            'defaultCarbs' => $carbs,

        ]);
        return response()->json('Food Created Successfully');



    }

    public function showCustomFoods(Request $request)
    {
        $foods = customFoods::all();
        return response()->json($foods);


    }

    public function addCustomFood(Request $request)
    {

        $quantity=(float)($request->quantity);
        $foodid=$request->food;
       $food= customFoods::find($foodid);
       $protein=$food->defaultProtein;
       $time=$request['time'];

       $carbs=$food->defaultCarbs*$quantity;
       $fats=$food->defaultFats*$quantity;
       $calories=$food->defaultCalories*$quantity;
       nutrients::create([
           'quantity'=>$quantity,
        'Protein'=>$protein,
        'Carbs'=>$carbs,
        'Fat'=>$fats,
        'user_profile_id'=>1,
           'date'=>Carbon::now()->format('Y-m-d'),
       ]);



    }
    public function addManualFood(Request $request){
        $user=auth('sanctum')->user();
        $userid=$user->profile()->first()->id;
        $protein=$request->protein;
        $carbs=$request->carbs;
        $calories=$request->calories;
        $fat=$request->fat;
        $time=$request->time;
        $date=$request->date;

        nutrients::create([
            'Protein'=>$protein,
            'Carbs'=>$carbs,
            'Fat'=>$fat,
            'Calories'=>$calories,
            'user_profile_id'=>$userid,
            'quantity'=>100,
            'time'=>$time,
            'date'=>$date

        ]);

        return response()->json('record created');
    }





}



