<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function local()
    {
        return response()->json(['user' => auth()->user()]);
    }

    public function oauth()
    {
        return response()->json(auth()->user());
    }

    public function register(Request $request, $email){
        $user = User::where('email', $email)->exists();
        if($user){
            return response()->json($user);
        }
        else{
            return User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
            // return response()->json('not found');
        }
        
    }
    
}
