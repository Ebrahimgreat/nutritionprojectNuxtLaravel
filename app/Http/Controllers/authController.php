<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class authController extends Controller
{
    public function logout(Request $request)
    {
        $user=auth('sanctum')->user();
        $user->tokens()->delete();
    }
    public function register(Request $request)
    {

       $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',

        ]);
        $user=User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]);
    }
    public function login(Request $request)
    {


        $request->validate([

            'email' => 'required|email',
            'password' => 'required',
        ]);
        $user=User::where('email',$request->email)->first();
        if(!$user || !Hash::check($request->password, $user->password)){
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $token = $user->createToken($user->id)->plainTextToken;

        $name=$user->name;
        $email=$user->email;

        return response()->json(['token'=>$token,'name'=>$name,'email'=>$email]);
    }

    //
}
