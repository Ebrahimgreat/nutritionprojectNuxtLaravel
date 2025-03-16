<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Inertia\Inertia;
use function Pest\Laravel\json;

class apiController extends Controller
{

    public $search;
    public function search(Request $request)
    {





          $search_expression=$request->header('search');



        $clientId = '34c4fd1f3b5248e1b16c31de3f119379';
        $clientSecret = '87b3be69a28a49f8abe9cedb60659d5a';

        // Request the access token using correct parameters
        $tokenResponse = Http::asForm()->post('https://oauth.fatsecret.com/connect/token', [
            'grant_type' => 'client_credentials',
            'client_id' => $clientId,         // Correct parameter name
            'client_secret' => $clientSecret, // Correct parameter name
        ]);


        // Check if the request was successful
        if ($tokenResponse->successful()) {
            $accessToken = $tokenResponse->json()['access_token'];
        } else {
            // Print out the full response for debugging
            dd($tokenResponse->status(), $tokenResponse->body());
        }





        $responseGet = Http::withToken($accessToken)->asForm()->post('https://platform.fatsecret.com/rest/server.api', [
            'method' => 'foods.search',
            'search_expression' => $search_expression,
            'include_sub_categories' => 'true',
            'serving_description' => '500g',

            'format' => 'json',          // Response format
        ]);
        return response()->json($responseGet->json());








        if($responseGet!=NULL)
        {



           $totalRecords=($responseGet->json()['foods']["max_results"]);

           $totalResults=0;

           for($i=0; $i<$totalRecords; $i++)
           {
              $totalResults=(($responseGet->json()['foods']['food'][$i]['food_description']));

           }




            $parts = explode("|", $responseGet['foods']['food'][0]['food_description']);

           if($search_expression!=null) {
               $searches = ($responseGet->json()['foods']['food']);
               $names=[];
               $descriptions=[];
               $foodsArray=[];

               foreach ($searches as $search)
               {

                   $foodsArray[]=['food_name'=>$search['food_name'],'description'=>$search['food_description'],
                       'food_id'=>$search['food_id']];



               }
               return response()->json($foodsArray);

           }






        }




    }



    public static function calculateCalories($defaultServing, $quantity,$defaultCalories,$fats,$carbs,$protein)
    {

        $calorie=($quantity*$defaultCalories)/$defaultServing;

        $fat=($quantity*$fats)/$defaultServing;
        $proteins=($quantity*$protein)/$defaultServing;
        $carb=($quantity*$carbs)/$defaultServing;
        return array($calorie,$fats,$proteins,$carb);





    }







// Check if the request was successfu



}
