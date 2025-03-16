<?php

namespace App\Http\Controllers;

use App\Models\customExercise;
use Illuminate\Http\Request;

class customExerciseController extends Controller
{
    public function index()
    {
        $customExercises = CustomExercise::all();
        return response()->json($customExercises);

    }

    public function store(Request $request)
    {
        $name=$request->input('name');
        customExercise::create([
            'name' => $name,
        ]);



    }
    //
}
