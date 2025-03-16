<?php

use App\Http\Controllers\apiController;
use App\Http\Controllers\authController;
use App\Http\Controllers\customExerciseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\exerciseController;
use App\Http\Controllers\goalController;
use App\Http\Controllers\HabitsController;
use App\Http\Controllers\nutritionController;
use App\Http\Controllers\templateController;
use App\Http\Controllers\userProfileController;
use App\Http\Controllers\WeightController;
use App\Http\Controllers\workoutController;
use Illuminate\Http\Request;
use App\Http\Controllers\unitController;
use Illuminate\Support\Facades\Route;
Route::get('/',function(){
    echo "Hello World";
});
Route::get('/weights',[WeightController::class,'index']);
Route::post('/destroyweight',[WeightController::class,'destroy']);
Route::post('/updateWeight',[WeightController::class,'update']);
Route::get('/userProfile',[userProfileController::class,'index']);
Route::get('/nutrients',[NutritionController::class,'index']);
Route::get('/nutritionRecords',[NutritionController::class,'show']);
Route::post('/storeFood',[NutritionController::class,'store']);
Route::get('/addNewFood',[apiController::class,'search']);
Route::get('/dashboard',[dashboardController::class,'index']);
Route::post('/editWeight',[weightController::class,'update']);
Route::post('/storeweight',[weightController::class,'store']);

Route::post('/login',[authController::class,'login']);
Route::post('/logout',[authController::class,'logout']);
Route::post('/register',[authController::class,'register']);

Route::post('/createCustomFood',[nutritionController::class,'storeCustomFood']);
Route::get('/customFoods',[nutritionController::class,'showCustomFoods']);
Route::post('/addCustomFood',[nutritionController::class,'addCustomFood']);
Route::get('/expenditure',[userProfileController::class,'expenditure']);
Route::get('/habits',[HabitsController::class,'index']);
Route::get('/goals',[goalController::class,'index']);
Route::post('/addManualFood',[nutritionController::class,'addManualFood']);
Route::get('/getCurrentWeight',[weightController::class,'getCurrentWeight']);
Route::get('/latestExpenditure',[userProfileController::class,'latestExpenditure']);
Route::get('/exercises',[exerciseController::class,'index']);
Route::get('/customExercises',[customExerciseController::class,'index']);
Route::post('/storeCustomExercise',[customExerciseController::class,'store']);
Route::post('/storeWorkout',[workoutController::class,'store']);
Route::get('/myTemplate',[templateController::class,'index']);
Route::get('/workout',[workoutController::class,'index']);
Route::get('/workoutDetails',[workoutController::class,'show']);
Route::get('/units',[unitController::class,'index']);
Route::get('/getAccountDetails',[userProfileController::class,'accountDetails']);
Route::post('/updateAccountInformation',[userProfileController::class,'update']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
