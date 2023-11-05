<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function register(Request $request){

        $credentials = $request->only(["name","password","email"]);

        $validator = Validator::make( $credentials ,[
            "name" => "required",
            "password" => ["required","min:8"],
            "email" => ["required","email","unique:users,email"]
        ]);

        if($validator->fails()){
            return response()->json([
                "success" => false,
                "message" => $validator->getMessageBag()
            ], 400);
        };

        User::create([
            "name" => $credentials["name"],
            "email" => $credentials["email"],
            "password" => Hash::make($credentials["password"])
        ]);

        return response()->json([
            "success" => true,
        ]);
    }

    public function login(Request $request){
        $credentials = $request->only(["email","password"]);

        $validators = Validator::make($credentials , [
            "email" => ["required" , "email"],
            "password" => ["required" , "min:8"],
        ]);

        if($validators->fails()){
            return response()->json([
                "success" => false,
                "message" => $validators->getMessageBag()
            ],400);
        }

        if($token = JWTAuth::attempt($credentials)){
            return response()->json([
                "success" => true,
                "token" => $token,
            ]);
        }

        return response()->json([
            "success"=> false,
            "message" => "Unauthorized"
        ],401);
    }

    public function refresh(){
        $token = JWTAuth::refresh();
        return response()->json([
            "success" => true,
            "token" => $token,
        ]);
    }
}
