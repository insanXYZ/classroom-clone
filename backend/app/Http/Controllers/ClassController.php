<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClassDetailResource;
use App\Http\Resources\ClassResource;
use App\Models\announcement;
use App\Models\User;
use App\Models\Classes;
use App\Models\File;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;

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
        if($class->isNotEmpty()){
            return new ClassDetailResource($class[0]);
        } else {
            return response()->json([
                "success"=> false
            ],400);
        }
    }

    public function storeAnnouncement(Request $request){
        $credentials = $request->only(["input","id"]);
        $validate = Validator::make($credentials,[
            "id" => "required",
            "input" => "required"
        ]);

        if($validate->fails()){
            return response()->json([
                "success" => false,
                "message" => $validate->getMessageBag()
            ], 400);
        }

        $announcement = announcement::create([
            "class_id" => $credentials["id"],
            "desc" => $credentials["input"]
        ]);

        if($request->hasFile("file")){
            Log::info("aya");
            foreach ($request->file("file") as $value) {
                File::create([
                    "announcement_id" => $announcement->id,
                    "filename" => $value->store("test")
                ]);
            }
        }

        return response()->json([
            "success" => true
        ]);

    }
}
