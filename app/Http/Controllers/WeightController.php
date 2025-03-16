<?php

namespace App\Http\Controllers;

use App\Listeners\updateExpenditure;
use App\Models\User;
use App\Notifications\NewNotification;

use App\traits\authTrait;
use Database\Factories\WeightsFactory;
use Illuminate\Http\Request;
use App\Models\Weight;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use App\Models\nutrientsWeights;
use App\Events\weightLogged;
use Predis\Command\Traits\Weights;


class WeightController extends Controller
{
    use authTrait;




    public $weights;
    public $latestWeights = [];
    public $highestWeight;
    public $streak;
    public $pagenumber;


    public function index(Request $request)
    {
     $userid=auth('sanctum')->user();
     $userprofileId=$userid->profile()->first()->id;
    
        $weights=Weight::where('user_profile_id',$userprofileId)->orderBy('date','DESC')->select('id','ScaleWeight','date');
        $weights1=Weight::where('user_profile_id',$userprofileId)->orderBy('date','DESC')->select('id','ScaleWeight','date')->paginate(2);

  



       return response()->json([
        'weights'=>$weights,
        'weightPaginate'=>$weights1

       ]);



    }


    public function getCurrentWeight(Request $request)
    {
        $userid=auth('sanctum')->user();
        $userprofileId=$userid->profile()->first()->id;
        $weights=Weight::all()->where('user_profile_id',$userprofileId)->last()->ScaleWeight;
        return response()->json($weights);
    }


    public function store(Request $request)
    {

      

        $userid=auth('sanctum')->user();
        $userprofileId=$userid->profile()->first()->id;



             $newWeight=Weight::create([
                'date' => $request['date'],
                'ScaleWeight' =>$request['weight'],
                'trendWeight'=>$request['weight'],
                'user_profile_id'=>$userprofileId


            ]);

          

            return response()->json($newWeight);


        }


    public function destroy(Request $request)
    {
        $tokenArray=$request->header('token');
        $weightid=$request['weight'];

        $token=explode('|',$tokenArray);
        $tokenid=$token[0];

        $userid = DB::table('personal_access_tokens')->where('id', $tokenid)->value('tokenable_id');
        $user=User::all()->where('id',$userid)->first();
        $userProfile=$user->profile()->first();
        $weights=Weight::where('user_profile_id',$userProfile->id);

        $weightToBeDeleted=$weights->where('id',$weightid)->first();
        $weightToBeDeleted->delete();
        return response()->json(['deletion successful']);




    }

    public function update(Request $request)
    {
        return response()->json($request);
        $user=auth('sanctum')->user();
        $userid=$user->profile()->first()->id;
        $weightid=$request->id;
        $date=$request['date'];

        $weights=Weight::find($weightid);
        $weights->update([
            'ScaleWeight'=>$request->scaleWeight
        ]);

        return response()->json('weight has ben updated');


    }


    //
}
