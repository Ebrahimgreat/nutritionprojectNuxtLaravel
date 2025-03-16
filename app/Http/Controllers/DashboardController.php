<?php

namespace App\Http\Controllers;

use App\Models\goals;
use App\Models\workout;
use Carbon\Carbon;
use Filament\Tables\Columns\Summarizers\Sum;
use Illuminate\Http\Request;
use App\Models\Nutrients;
use App\Models\UserProfile;
use App\Models\Weight;
use App\Models\Steps;
use App\Models\user;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\LineChartWidget as LineChartWidgetAlias;
use Illuminate\Support\Facades\Cache;
use App\Models\expenditure;
use App\Models\Units;
class DashboardController extends Controller
{




    public function index()
    {
        $expenditure=Expenditure::orderBy('date','desc')->select('date','expenditure')->take(5)->get();

        $data=Weight::paginate(10,['*'],'weights');
        $data1=Nutrients::paginate(10,['*'],'nutrition');



        $weights=Weight::orderBY('date','DESC')->select('ScaleWeight','date','trendWeight','id')->paginate('10',['*'],'weights');
        $goals=goals::orderBy('date','DESC')->take(1)->get();
        $nutrients=Nutrients::selectRaw('date,sum(Calories) as Calories,sum(Protein) as Protein,sum(Carbs) as Carbs')->groupBy('date')->paginate('5',['*','weights']);
        $workout=workout::with('workoutDetail')->get();
        $units=Units::first();

        return response()->json([
            'Weight'=>$weights,
            'goals'=>$goals,
            'workout'=>$workout,
            'expenditure'=>$expenditure,
            'units'=>$units,
   
            'nutrients'=>$nutrients,
    

        ]);






    }
}



