<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClassResource;
use App\Models\User;
use App\Models\Classes;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
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
        ]);

        if($validators->fails()){
            return response()->json([
                "success"=> false,
                "message" => $validators->getMessageBag()
            ],400);
        }

        $result = Classes::create([
            "name" => $credentials["name"],
            "banner_img" => Arr::random(["banner_img (2).jpg","banner_img (1).jpg","banner_img (3).jpg","banner_img (4).jpg","banner_img (5).jpg"]),
            "color_list" => Arr::random(["#db2777", "#4f46e5", "#eab308", "#dc2626", "#52525b"]),
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
        $user = JWTAuth::user();
    
        $classes = $user->class;
    
        $groupedClasses = $classes->groupBy('pivot.role');
        
        return response()->json([
            "success" => true,
            "menu" => $groupedClasses,
        ]);
    }

    public function getClass(){
        $class = User::find(JWTAuth::user()->id)->class;

        return ClassResource::collection($class);
    }

    public function getClassDetail($id)
    {
        $class = User::find(JWTAuth::user()->id)->class()->where("id",$id)->get();
        return response()->json([
            "class" => $class
        ]);
    }
}
