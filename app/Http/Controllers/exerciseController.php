<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\exercise;

class exerciseController extends Controller
{
    public function index()
    {
        $exercises = exercise::all();
        return response()->json($exercises);
    }

    //
}
