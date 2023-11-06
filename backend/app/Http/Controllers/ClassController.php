<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Classes;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Js;

class ClassController extends Controller
{
    public function store(Request $request)
    {
        $credentials = $request->only(["name","section","subject","room"]);

        $validators = Validator::make($credentials,[
            "name" => "required",
            "section" => "min:2",
            "subject" => "min:2",
            "room" => "min:2"
        ]);

        if($validators->fails()){
            return response()->json([
                "success"=> false,
                "message" => $validators->getMessageBag()
            ],400);
        }

        $result = Classes::create([
            "name" => $credentials["name"],
            "section" => $credentials["section"],
            "subject" => $credentials["subject"],
            "room" => $credentials["room"],
            "code" => Str::random(7)
        ]);

        $user = User::find(JWTAuth::user()->id);

        $user->class()->attach($result->id, ["role" => 1]);

        return response()->json([
            "success" => true,
        ]);
    }

    public function getClassMenu(){
        $result = DB::table('users_join_classes')
        ->where('user_id', JWTAuth::user()->id)
        ->get();

        $data = collect($result);

        $class = [];

        foreach ($item as $result) {
            $class[] = $item;
        }

        return response()->json([
            "success" => true,
            "menu" => $data->groupBy("role"),
            "class" => $class
        ]);
    } 
}
