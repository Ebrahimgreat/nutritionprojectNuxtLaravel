<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\userprofile;

class accountController extends Controller
{
    public function index()
    {
        return view('account',
        ['userProfile'=>userprofile::all()]);
    }
    public function configure()
    {

    }
    //
}
