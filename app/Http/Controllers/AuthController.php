<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AuthController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function signup(Request $request){
        $user = new User();

        $user->username =  $request->username;
        $user->email =  $request->email;
        $user->password =  $request->password;

        $user->save();
    }

    public function login(Request $request){
        $credentials = $request->only(['username', 'password']);
        
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            $token = $user->createToken('auth-token')->plainTextToken;

            return response()->json(['auth-token' => $token, 'is_admin' => $user->is_admin('admin')], 200);
        }else{
            return response()->json(['message' => "Invalid credentials."], 401);
        }
    }

    public function logout(){
        $user = Auth::user();

        $user->tokens('auth-token')->delete();
        return response()->json(['message' => 'Logout successful.'], 200);
    }
}
