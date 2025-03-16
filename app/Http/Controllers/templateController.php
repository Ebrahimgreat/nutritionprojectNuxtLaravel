<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\template;
use App\Models\templateDetails;


class templateController extends Controller
{
    public function index()
    {

     $template=template::with(['templateDetails.exercise'])->get();
     return response()->json($template);



    }
    //
}
