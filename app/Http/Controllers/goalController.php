<?php

namespace App\Http\Controllers;

use App\Models\checkIn;
use App\Models\UserProfile;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use App\Models\goals;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;
use phpDocumentor\Reflection\Types\Object_;
use function Pest\Laravel\get;


class goalController extends Controller
{
    public $goals;

    public function index(Request $request)
    {
        return response()->json(goals::all());

    }

    public function create()
    {
        $currentWeight=auth()->user()->Profile()->latest()->first()->weights()->latest()->first()->trendWeight;



        $currentExpenditure=auth()->user()->Profile()->latest()->first()->getExpenditure()->latest()->first()->number;

        $goals = goals::latest()->first()?->users()->latest()->first();











        $date=Carbon::now();
        return inertia::render('goals.create',['date'=>$date,
            'currentWeight'=>$currentWeight,
            'currentExpenditure'=>$currentExpenditure,]);
    }

    public function edit()
    {
        dd(request());
    }
    public function store()
    {


        if(request()->all()['approach']=='Low Carb' ||request()->all()['approach']=='High Carb'){
            $protein=request()->all()['defaultProtein'];
            $carbs=request()->all()['defaultCarbs'];
            $fats=request()->all()['defaultFats'];
            $targetCalories=request()->all()['targetCalories'];
        }


        $date= new DateTime();
        $today=$date->format('Y-m-d');
        $goalRate=request()->all()['goalRate'];
        $goalRate=floatval($goalRate);
        $userProfileid=UserProfile::latest()->first()->id;



        $checkDay=request()->all()['checkDay'];
        $approach=request()->all()['approach'];



        goals::create([
            'name'=>request()->input()['goalName'],
            'goalRate' => $goalRate,
            'goalWeight'=>request()->all()['targetWeight'],
            'GoalStarted'=>$today,
            'user_profile_id'=>$userProfileid,
            'approach'=>$approach,
            'goalStatus'=>'active'



        ]);


        self::createCheckin($checkDay,$protein,$carbs,$fats,$targetCalories);
      return to_route('goals')->with('message','Goal created');


    }



    public function createCheckin($checkDay,$protein,$carbs,$fats,$targetCalories)
    {
        $goals=goals::latest()->first();
        checkIn::create([
            'goal_id'=>$goals->id,
            'checkDay'=>$checkDay,
            'targetProtein' => $protein,
            'targetCarbs'=>$carbs,
            'targetFats'=>$fats,
            'targetCalories'=>$targetCalories,

        ]);


    }
















    public function destroy()
    {


        $record=request()->all()['id'];
        goals::find($record)->delete();
        return to_route('goals')->with('success','Goal deleted successfully');




    }


    public function targetCalories($checkDay)
    {
        $checkDay=request()->all()['checkDay'];
        self::createCheckin($checkDay);


    }


    public function getNewTargetCalories(Request $request)
    {

        $goals=goals::find(request()->all()['goal']['id']);
        $goals=goals::latest()->first();

        $macros[]=$goals->calculateNewTargetCalories($goals->id);


          session()->put('targetCalories',$macros[0]['calories']);
        session()->put('targetFats', $macros[0]['Fats']);
        session()->put('targetProtein', $macros[0]['Protein']);
        session()->put('targetCarbs', $macros[0]['Carbs']);

        session()->put('goal', request()->all()['goal']['id']);
        return inertia::render('goals.show',['macros'=>$macros
        ,]);

    }

    public function updatedTarget()
    {



        $date=Carbon::today()->format('Y-m-d');
        $targetCalories=session('targetCalories');
        $targetProtein=session('targetProtein');
        $targetCarbs=session('targetCarbs');
        $targetFats=session('targetFats');



        $goals=goals::find(session('goal'));
        $checkin=$goals->checkIns()->latest()->first();
        $checkDay=$checkin->checkDay;


        $date=Carbon::today()->format('Y-m-d');




        $checkin->update([
            'goal_id'=>$goals->id,
            'actualCheckinDate'=>$date,

        ]);
       checkIn::create([
            'goal_id'=>$goals->id,
            'targetCalories'=>$targetCalories,
            'targetProtein'=>$targetProtein,
            'targetCarbs'=>$targetCarbs,
            'targetFats'=>$targetFats,
            'checkDay'=>$checkDay,
            'date'=>$date


        ]);
        return to_route('goals')->with('message','Goal target updated successfully');



    }

    public function editCheckIn()
    {

        $path=request()->path();
        $path=explode('/',$path);
        $id=$path[2];



        $goals=goals::find($id)->first();
        $latestCheckDay=$goals->latest()->first()->checkIns()->latest()->first()->checkDay;

        $goal[]=['name'=>$goals->pluck('name')->first(),"CheckDay"=>$latestCheckDay];



        return inertia::render('goals.edit',['goal'=>$goal]);

    }







    //
}
