<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use React\Socket\UnixServer;
use function Pest\Laravel\get;

class UserProfile extends Model
{
    use HasFactory;
    public $bmr;
    protected $table='user_profiles';
    protected $fillable = ['name', 'height','Sex','activityLevel','weight','age','user_id','expenditure'];



    public function userFunction(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }
    public static function calculateEnergyExpenditure($data)
    {
        $height=$data[0]['height'];
        $Sex=$data[0]['Sex'];
        $activityLevel=(float)($data[0]['activityLevel']);
        $weight=$data[0]['weight'];
        $age=$data[0]['age'];



        if($Sex=="male")
        {
            $bmr=((10*$weight)+(6.25*$height)-(5*$age)+5)*$activityLevel;

        }
        else{
            ($bmr=(10*$weight)+(6.25*$height)-(5*$age)-16)*$activityLevel;


        }
        return $bmr;




    }
    public function index():View
    {
        return view('profile');
    }




    public function weights():HasMany
    {
        return $this->hasMany(Weight::class,'user_profile_id','id');
    }

    public function users():BelongsTo
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function goals():HasMany
    {
        return $this->hasMany(goals::class, 'user_profile_id', 'id');
    }
    public function nutrients():HasMany
    {
        return $this->hasMany(Nutrients::class, 'user_profile_id', 'id');


    }
    public function calculatenewMacros()
    {
        $latestUser=UserProfile::latest()->first();
        $goalID=$latestUser->goals()->latest()->first()['id'];
        $previousCheckinDate=$latestUser->goals()->latest()->first()->checkIns()->latest()->first()->date;



        //Current Trend Weight
        $latestTrendWeight=$latestUser->weights()->latest()->first()->trendWeight;
        $trendWeightWhenStarted=$latestUser->weights()->where('date',$previousCheckinDate)->first()->trendWeight;
       $difference=$trendWeightWhenStarted-$latestTrendWeight;
       $expenditure=($difference*7000)/7;
       $newExpenditure=expenditure::getLatestExpenditure()+$expenditure;
       return $newExpenditure;

    }
    public function calculateExpenditure()
    {

        $id=UserProfile::latest()->first()->id;
        dd($id);

        $trendWeight = UserProfile::latest()->first()->weights()->latest()->first()->toArray();

        $newTrendWeightValue = $trendWeight['trendWeight'];
        $newTrendWeight = UserProfile::latest()->first()->weights()->take(7)->get()->toArray();
        $oldTrendWeightValue = ($newTrendWeight[6]['trendWeight']);


        $difference = ($newTrendWeightValue - $oldTrendWeightValue);

        $currentExpenditure=UserProfile::find($id)->expenditure;
        $newExpenditureValue = $currentExpenditure -($difference*7000/7);

       expenditure:latest()->first()->update(['number'=>$newExpenditureValue]);
        return $newExpenditureValue;




    }

    public function getExpenditure():HasMany
    {
        return $this->hasMany(Expenditure::class,'user_profile_id','id');
    }

    public function initialExpenditure(){
        $weights=UserProfile::weights()->pluck('date');
        $currentExpenditure=UserProfile::getExpenditure()->latest()->first()['number'];
        $count=UserProfile::weights()->count();
        foreach($weights as $weight) {
            expenditure::create([
                'date' => $weight,
                'numberus' => $currentExpenditure,
            ]);
        }
    }

    public function updatingInitalExpenditure()
    {
        $userProfile = UserProfile::latest()->first();
        $latestExpenditure = $userProfile->getExpenditure()->latest()->first()->number;

        $totalRecords = $userProfile->getExpenditure()->count();

        $weights = $userProfile->weights()->orderBy('date', 'asc')->pluck('trendWeight');

        $weightDates = $userProfile->weights()->orderBy('date', 'asc')->pluck('date');
        $firstRecords = $weights->take(10);
        $firstDates = $weightDates->take(10);
        $expenditureArray = [];
            foreach ($firstDates as $record) {
                $expenditureArray[] = ['date' => $record, 'expenditure' => $latestExpenditure];
            }


            foreach ($expenditureArray as $expenditure) {
                expenditure::create([
                    'date' => $expenditure['date'],
                    'number' => $expenditure['expenditure'],
                    'user_profile_id' => $userProfile->id,
                ]);
            }

        }


    public function updateExpenditure()
    {



        $userProfile=userProfile::latest()->first();




        $expenditureData=$userProfile->getExpenditure()->latest()->first();
        $expenditureDate=$expenditureData->pluck('date')->first();
        $expenditureValue=$expenditureData->pluck('number')->first();

        $weightsCollection=$userProfile->weights()->orderBy('date','asc')->pluck('trendWeight');
        dd($weightsCollection);


        $weights=$userProfile->weights()->latest()->take(1)->pluck('trendWeight')->first();


        $weightBefore=$userProfile->weights()->where('date',$expenditureDate)->first()->trendWeight;
        $difference=$weights-$weightBefore;



        $newExpenditure=(($difference*7000)/7);
        if($newExpenditure>0)
        {
            $newExpenditure=$expenditureValue-$newExpenditure;
        }
        else{
            $newExpenditure=$expenditureValue+$newExpenditure;
        }



        return $newExpenditure;


    }




}


