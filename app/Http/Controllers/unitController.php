<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Units;

class unitController extends Controller
{
    public function index()
    {
        $units=Units::first();
        return response()->json($units);


    }
    //
}
