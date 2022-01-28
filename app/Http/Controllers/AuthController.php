<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller{

    public function __construct(){
        $this->middleware('auth:api', ['except' => ['login', 'refresh', 'logout']]);
    }

    public function login(Request $request){
        $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);
        
        $credentials = $request->only(['email', 'password']);

        if($token = Auth::attempt($credentials)){
            return $this->respondWithToken($token);
        }else{
            return response()->json(['message' => 'Your credentials is wrong'], 401);
        }
    }

    public function logged(){
        return response()->json(auth()->user());
    }

    public function logout(){
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh(){
        return $this->respondWithToken(auth()->refresh());
    }

    public function respondWithToken($token){
        return response()->json([
            'token' => $token,
            'type' => 'bearer',
            'user' => auth()->user(),
            'expires_in' => auth()->factory()->getTTL() * 60 * 24
        ]);
    }
}