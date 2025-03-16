<?php

namespace App\Http\Controllers;

use App\Models\workout;
use App\Models\workoutDetail;
use App\traits\authTrait;
use Illuminate\Http\Request;
use App\Events\newWorkout;



class workoutController extends Controller
{
    use authTrait;
    public function index(Request $request)
    {
      
       $workout=Workout::with(['workoutDetail'=>function($query){
        $query->select('id','workout_id','name','reps','weight','set')->get();

       }])->where('user_profile_id',1)->paginate(5);
       
        if(!$workout)
        {
            return response()->json('No workout Found');
        }
        else{
        return response()->json($workout);
        }
    }
    public function show(Request $request){
        $date=$request->query('date');
        $workout=workout::with('workoutDetail')->where('date',$date)->get();
        return response()->json($workout);

    }
    public function store(Request $request)
    {
       
        $user=auth('sanctum')->user();
      
        $userProfile=$user->profile()->first()->id;
     
  
       
        $workoutArray=$request->workoutDetail;

        $workout=Workout::where('date',$request->date)->get();
        
  
        if($workout->isEmpty()){
          
        $newWorkout=Workout::create([
            'user_profile_id'=>$userProfile,
            'date'=>$request->date

        ]);

        event(new newWorkout($workoutArray,$newWorkout->id));
        
        }
        else{
            event(new newWorkout($workoutArray,$workout->first()->id));

           
        }
       




    }
    //
}
