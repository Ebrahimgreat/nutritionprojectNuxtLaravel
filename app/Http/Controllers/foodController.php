<?php

namespace App\Http\Controllers;

use App\Models\foods;
use Illuminate\Http\Request;
use Inertia\Inertia;

class foodController extends Controller
{
    public function index()
    {
        $foods=foods::all();
        return inertia::render('food.add',
        ['foods'=>$foods]);
    }
    public function store()
    {
       $fooditem=foods::find(request()->all()['foodId']);
       dd($fooditem);
       $calories=$fooditem['Calories']*request()->all()['quantity']/$fooditem['quantity'];
       $protein=$fooditem['Protein']*request()->all()['quantity']/$fooditem['quantity'];
       $fat=$fooditem['Fat']*request()->all()['quantity']/$fooditem['quantity'];

       $nutrition= new nutritionController();
       $nutrition->store();


    }


    //
}
