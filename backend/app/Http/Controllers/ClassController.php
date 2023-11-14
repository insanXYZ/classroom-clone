<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\User;
use App\Models\Classes;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Models\announcement;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\ClassResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ClassDetailResource;

class ClassController extends Controller
{
    public function store(Request $request)
    {

        if($request->query("join")){
            $class = Classes::where("code",$request->code)->first();

            if(is_null($class)){
                return response()->json([
                    "success"=>false
                ],400);
            }

            $user = User::find($request->id);

            if(is_null($user)){
                return response()->json([
                    "success"=>false
                ],400);
            }

            $user->class()->attach($class->id);

            return response()->json([
                "success" => true
            ]);
        }

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
        $class = User::with('class.announcement.file')->find(JWTAuth::user()->id)->class()->where("id",$id)->get();

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
            "user_id" => JWTAuth::user()->id,
            "desc" => $credentials["input"]
        ]);

        if($request->hasFile("file")){
            foreach ($request->file("file") as $value) {
                $filename = $value->getClientOriginalName();
                File::create([
                    "announcement_id" => $announcement->id,
                    "filename" => $value->storeAs("class_".$credentials["id"], $filename)
                ]);
            }
        }

        return response()->json([
            "success" => true
        ]);

    }

    public function updateAnnouncement($id , Request $request){

        $announcement = announcement::find($id);

        if(is_null($announcement)){
            return response()->json([
                "success"=> false,
                "message" => "Announcement not found" 
            ],400);
        }

        if($announcement->user_id != JWTAuth::user()->id){
            return response()->json([
                "success" => false,
                "message" => "havent access"
            ], 400);
        }

        $announcement->update([
            "desc" => $request->desc
        ]);

        if($request->hasFile("file")){
            foreach ($request->file("file") as $file) {
                $filename = $file->getClientOriginalName();
                File::create([
                    "announcement_id" => $announcement->id,
                    "filename" => $file->storeAs("class_".$announcement->class_id , $filename)
                ]);
            }
        }

        return response()->json([
            "success" => true,
        ]);
    }

        
    

    public function destroyFile($id){
        $file = File::with('announcement')->find($id);
        if(is_null($file)){
            return response()->json([
                "success" => false,
                "message" => "file not find"
            ],400);
        }

        $announcement = $file->announcement;

        if($announcement->user_id != JWTAuth::user()->id){
            return response()->json([
                "success"=> false,
                "message" => "havent Access"
            ],400);
        }

        Storage::disk("public")->delete($file->filename);

        $file->delete();

        return response()->json([
            "success" => true,
        ]);
    }
}
