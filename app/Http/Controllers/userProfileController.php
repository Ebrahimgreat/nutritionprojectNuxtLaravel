<?php

namespace App\Http\Controllers;

use App\Models\expenditure;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\UserProfile;
use Illuminate\Support\Facades\DB;

class userProfileController extends Controller
{

    public function index()
    {
        $userid=auth('sanctum')->user();
        return response()->json($userid);
        $userprofile=$userid->profile()->first();
        return response()->json($userprofile);


    }
    public function accountDetails()
    {
        $userProfile=UserProfile::latest()->first();
        return response()->json($userProfile);
    }


    public function latestExpenditure(Request $request)
    {
        $userid=auth('sanctum')->user();
        $userProfile=$userid->profile()->first()->id;
        $expenditure=expenditure::all()->where('user_profile_id',$userProfile)->last()->expenditure;
        return response()->json($expenditure);


    }
    public function expenditure()
    {
       $userid=auth('sanctum')->user();
     
       $userProfile=$userid->profile()->first()->id;
 
       $expenditure=expenditure::where('user_profile_id',$userProfile)->select('date','expenditure')->get();
       return response()->json(
           $expenditure);
    }

    public function storeExpenditure()
    {

        $data[]=['weight'=>request()->all()['weight'],'height'=>request()->all()['height'],'activityLevel'=>request()->all()['activityLevel'],'age'=>request()->all()['age'],'Sex'=>request()->all()['sex']];
        $expenditure=UserProfile::calculateEnergyExpenditure($data);



        $userProfile=UserProfile::latest()->first();
        $userProfile->getExpenditure()->create([
            'date'=>Carbon::today()->format('Y-m-d'),
            'number'=>$expenditure,
            'user_profile_id'=>$userProfile->id,
        ]);

        return to_route('expenditure')->with('message','expenditure added successfully');



    }

    public function update(Request $request)
    {
      $user=auth('sanctum')->user();
      $userProfile=$user->profile()->first();
        $userProfile->update([
            'Sex'=>$request->sex,
            'activityLevel'=>$request->activityLevel,
            'age'=>$request->age


        ]);

     return response()->json('Updated Information');
    }


    public function store()
    {


          $id=UserProfile::all()->latest()->first()->id;
         $currentExpenditure=UserProfile::all()->latest()->first()->expenditure;

    }

    public function newMacros()
    {
        $user=UserProfile::latest()->first();
        $macros=$user->calculatenewMacros();
        $user->update([
            'expenditure'=>$macros
        ]);




        return response()->json([
            'data'=>$macros,
        ]);





    //
}


}
